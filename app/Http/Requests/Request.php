<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'body' => 'required|max:140',
        ];
    }

    public function messages()
    {
        return [
            'body.required'  => 'لطفا متنی را وارد کنید ',
        ];
    }
}
