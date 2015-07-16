<?php namespace App\Http\Requests\User;

use App\Http\Requests\Validator;

class Create extends Validator
{

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6|max:20',
        ];
    }
}
