<?php namespace App\Http\Requests\User;

use App\Http\Requests\Validator;
use Illuminate\Support\Facades\Request;

class Update extends Validator
{

    public function rules()
    {
        $id = Request::segment(3);

        $rules = [
            'name' => 'required',
            'email' => 'required|unique:user,email,' . $id,
        ];

        if ($this->has('password')) {
            $rules['password'] = 'required|min:6|max:20';
        }

        return $rules;
    }
}
