<?php namespace App\Http\Traits;

use App\Http\Helpers\ErrorCode;
use Validator;

trait Registar
{

    private $validators = [
        /*'username' => 'required|unique:login_user|between:4,58|Regex:/^[a-zA-Z]{2}[a-zA-Z0-9_-]{4,58}$/',*/
        'mobile' => 'required|min:13|max:24|unique:login_user',
        'mobile_out_db' => 'required|min:13|max:24',
        'email' => 'required|email|max:255|unique:login_user,email',
        'email_out_db' => 'required|email|max:255',
        'password' => 'required|confirmed|min:6|max:16'
    ];

	protected function setCustomMessages($validator)
	{
		$validator->setCustomMessages([
			"username.required" => ErrorCode::USERNAME_REQUIRED,
			"username.unique" => ErrorCode::USERNAME_EXISTS,
			"username.min" => ErrorCode::USERNAME_TOO_LONG_OR_SHORT,
			"username.max" => ErrorCode::USERNAME_TOO_LONG_OR_SHORT,
			"username.between" => ErrorCode::USERNAME_TOO_LONG_OR_SHORT,
			"username.regex" => ErrorCode::USERNAME_INVALID,

			"email.required" => ErrorCode::EMAIL_REQUIRED,
			"email.unique" => ErrorCode::EMAIL_EXISTS,
			"email.max" => ErrorCode::EMAIL_TOO_LONG_OR_SHORT,
			"email.email" => ErrorCode::EMAIL_INVALID,

            "mobile.required" => ErrorCode::MOBILE_REQUIRED,
            "mobile.unique" => ErrorCode::MOBILE_EXISTS,
            "mobile.max" => ErrorCode::MOBILE_TOO_LONG_OR_SHORT,
            "mobile.min" => ErrorCode::MOBILE_TOO_LONG_OR_SHORT,
            "mobile.digits" => ErrorCode::MOBILE_TOO_LONG_OR_SHORT,
            "mobile.email" => ErrorCode::MOBILE_INVALID,

			"password.required" => ErrorCode::PASSWORD_REQUIRED,
			"password.confirmed" => ErrorCode::PASSWORD_INCONSIST,
			"password.min" => ErrorCode::PASSWORD_TOO_LONG_OR_SHORT,
			"password.max" => ErrorCode::PASSWORD_TOO_LONG_OR_SHORT,
			"password.between" => ErrorCode::PASSWORD_TOO_LONG_OR_SHORT,

			"token.required" => ErrorCode::MISS_PARAMETERS,
		]);
	}

    /**
     * 注册校验
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorWithMobile(array $data)
    {
        return Validator::make($data, [
            'mobile' => $this->validators['mobile'],
            'password' => $this->validators['password'],
        ]);
    }
    protected function validatorWithEmail(array $data)
    {
        return Validator::make($data, [
            'email' => $this->validators['email'],
            'password' => $this->validators['password'],
        ]);
    }

    /**
     * 重置密码校验
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorOnResetWithMobile(array $data)
    {
        return Validator::make($data, [
            'mobile' => $this->validators['mobile_out_db'],
            'password' => $this->validators['password'],
        ]);
    }
    protected function validatorOnResetWithEmail(array $data)
    {
        return Validator::make($data, [
            'email' => $this->validators['email_out_db'],
            'password' => $this->validators['password'],
        ]);
    }

    /**
     * 登录校验手机号格式
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorMobile(array $data)
    {
        return Validator::make($data, [
            'mobile' => $this->validators['mobile_out_db'],
        ]);
    }

    /**
     * 修改密码时,校验密码格式
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorEmail(array $data)
    {
        return Validator::make($data, [
            'email' => $this->validators['email_out_db'],
        ]);
    }

    public function validatorResetPassword(array $data)
    {
        return Validator::make($data, [
            'token' => 'required',
            'password'=> $this->validators['password']
        ]);
    }

    public function validatorResetPassword2(array $data)
    {
        return Validator::make($data, [
            'token' => 'required',
            'token2' => 'required',
            'password'=> $this->validators['password']
        ]);
    }

}