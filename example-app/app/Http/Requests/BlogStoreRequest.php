<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class BlogStoreRequest extends FormRequest
{
    public function rules()
    {
        $blog_id = $this->blog->id ?? null; // L'indentifiant de l'utilisateur
        return [
            'title' => 'required',
            'body' => 'required',
            'category' => 'require'
        ];
    }
}
