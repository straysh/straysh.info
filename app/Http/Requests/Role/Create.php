<?php namespace App\Http\Requests\Role;

use App\Http\Requests\Validator;

class Create extends Validator
{

    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:role,slug'
        ];
    }
}
