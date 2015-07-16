<?php namespace App\Http\Requests\Role;

use App\Http\Requests\Validator;
use Illuminate\Support\Facades\Request;

class Update extends Validator
{

    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:role,slug,' . Request::segment(3)
        ];
    }
}
