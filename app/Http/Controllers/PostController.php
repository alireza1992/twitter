<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Http\Controllers\Controller;


class PostController extends Controller
{

    protected function formatValidationErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }

    public function index(Request $request, Post $post)
    {
        $allPosts= $post->whereIn(
          'user_id',
          $request->user()->following()->lists('users.id')->push($request->user()->id)
        )->with('user');
        $posts= $allPosts->orderBy('created_at','desc')
            ->take($request->get('limit',20))
            ->get();


        return response()->json([
            'posts'=>$posts,
            'total'=> $allPosts->count(),
        ]);
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request, Post $post)
    {
        $this->validate($request,[
            'body'=> 'required|max:140',

        ]);

        $createdPost= $request->user()->posts()->create([
            'body'=>$request->body,

        ]);


        /**
         * process TAGS
         */

        $tags= explode('#',$request->input(['tags']));
        $formatedTags=[];

        foreach($tags as $tag)
        {
            if(trim($tag))
            {
                $formatedTags[] = strtolower(trim($tag));
            }
        }

        $allTagsIds=[];

        foreach($formatedTags as $tags)
        {
            $theTag= Tag::create(['name'=>$tags]);
            $allTagsIds[]=$theTag->id;
        }

//        $createdPost->tags()->attach($allTagsIds);



        return response()->json($post->with('user')->find($createdPost->id));

    }
}
