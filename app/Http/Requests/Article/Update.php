<?php namespace App\Http\Requests\Article;

use App\Http\Requests\Validator;
use Illuminate\Support\Facades\Request;

class Update extends Validator
{

    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => 'required|unique:article,slug,' . Request::segment(2),
            'body' => 'required',
        ];
    }
}
