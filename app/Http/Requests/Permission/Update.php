<?php namespace App\Http\Requests\Permission;

use App\Http\Requests\Validator;
use Illuminate\Support\Facades\Request;

class Update extends Validator
{

    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:permission,slug,' . Request::segment(3)
        ];
    }
}
