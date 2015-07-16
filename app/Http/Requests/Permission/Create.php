<?php namespace App\Http\Requests\Permission;

use App\Http\Requests\Validator;

class Create extends Validator
{

    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:permission,slug'
        ];
    }
}
