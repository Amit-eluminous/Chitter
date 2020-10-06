<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostChitRequest extends FormRequest 
{
    public function authorize()
    {
        return true;
    }

    public function rules() 
    {
            return [
                'post'            => 'required|max:150',
            ]; 

    }

    public function messages()
    {
            return [
                        'post.required'     => 'Post field is required.',
                        'post.max'          => "Post field can not be more than 150 characters.",
                    ];
        
    }
}
