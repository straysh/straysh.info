<?php namespace App\Http\Requests\Category;

use App\Http\Requests\Validator;
use Illuminate\Support\Facades\Request;

class Update extends Validator
{

    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:category,slug,'. Request::segment(3),
        ];
    }
}
