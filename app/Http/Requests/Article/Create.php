<?php namespace App\Http\Requests\Article;

use App\Http\Requests\Validator;

class Create extends Validator
{

    protected $rules = [
        'title' => 'required',
        'slug' => 'required|unique:article,slug',
        'body' => 'required',
        'image' => 'required|image',
    ];

    public function rules()
    {
        if (isOnPages()) {
            unset($this->rules['image']);
        }

        return $this->rules;
    }
}
