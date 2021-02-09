<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{

    public function rules()
    {
        return [
            'search.search'=>'required|string|max:100'
        ];
    }
}
