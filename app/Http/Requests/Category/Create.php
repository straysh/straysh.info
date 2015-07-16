<?php namespace App\Http\Requests\Category;

use App\Http\Requests\Validator;

class Create extends Validator
{

    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:category,slug',
        ];
    }
}
