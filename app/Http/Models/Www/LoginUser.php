<?php namespace App\Http\Models\Www;

use App\Exceptions\DevDbException;
use App\Exceptions\DevInvalidParamsException;
use App\Http\Helpers\ErrorCode;
use App\Http\Helpers\Yconst;
use App\Http\Helpers\Yutils;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 系统账号uid为1.用户账号从101开始.
 * @property int $id
 * @property string $username
 * @property int $user_type 枚举1:普通用户2:服务者3:企业服务者101:客服
 * @property int $reg_type 枚举0:未知1:手机2:邮箱3:微信
 * @property string $unionid
 * @property string $invitor_code
 * @property string $invite_code
 * @property string $email
 * @property string $mobile
 * @property string $password
 * @property string $remember_token
 * @property int $avatar
 * @property int $src_id
 * @property int $client_type
 * @property int $is_active
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 */
class LoginUser extends BaseModel implements AuthenticatableContract,CanResetPasswordContract
{
    use Authenticatable,CanResetPassword,SoftDeletes;

    private static $_instance;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'login_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'mobile', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @return self
     */
    public static function getInstance()
    {
        if(!isset(self::$_instance))
        {
            $c = __CLASS__;
            self::$_instance = new $c;
        }
        return self::$_instance;
    }

    /**
     * 关联模型
     */
    public function user()
    {
        return $this->hasOne('App\Http\Models\User', 'uid', 'id')->select('user.*');
    }

    /**
     * @param int $id
     * @return self
     */
    public function getOne( $id )
    {
        return self::find( $id );
    }

    public function getByEmail($email)
    {
        return self::where('email', $email)->first();
    }

    /**
     * 拼接user 和 login_user里的信息
     * @var int $uid
     * @return LoginUser
     */
    public function getUserinfo($uid)
    {
        $uid = filter_var($uid, FILTER_VALIDATE_INT);
        if(!$uid) return null;

        $user = self::select(explode(", ", "id, username, user_type, invite_code, email, mobile, avatar, is_active, is_verified"))
            ->with(['user' => function($query){
                return $query->addSelect(explode(", ", "uid, displayname, birthday, gender, level, credits, reviewed_amount, orders_amount, star, introduction"));
            }])
            ->whereRaw('id=? AND state=1', [$uid]);
        return $user->first();
    }

    public function setAvatar($uid, $imgId, $srcId)
    {
        $result = self::where("id", $uid)->update([
            "avatar" => $imgId,
            "src_id" => $srcId
        ]);
        if(FALSE === $result)
            throw new DevDbException('set avatar fail');

        return TRUE;
    }

    /**
     * @param array $params
     * @return LoginUser|array
     * @throws DevDbException
     * @throws DevInvalidParamsException
     */
    public function createLoginuser($params)
    {
        if(empty($params['unionid']) && empty($params['email']) && empty($params['mobile']))
            throw new DevInvalidParamsException(ErrorCode::NORMAL_INVALID_PARAMETERS);
        $model = new self;
        $model->username = $params['username'];
        $model->user_type = $params['user_type'];
        $model->unionid = !empty($params['unionid']) ? $params['unionid'] : NULL;
        $model->email = !empty($params['email']) ? $params['email'] : NULL;
        $model->mobile = !empty($params['mobile']) ? $params['mobile'] : NULL;
        $model->reg_type = !empty($params['reg_type']) ? $params['reg_type'] : NULL;
        $model->password = !empty($params['password']) ? bcrypt($params['password']) : str_random(32).$params['unionid'];
        $model->is_active = isset($params['is_active']) ? $params['is_active'] : 0;
        $model->client_type = isset($params['client_type']) ? $params['client_type'] : 0;
        if(!$model->save())
            throw new DevDbException('create loginuser fail');

        return $model;
    }

    public function assocWechat($uid, $unionid)
    {
        if(!self::where('id', $uid)->update([ 'unionid' => $unionid ]))
        {
            throw new DevDbException('assoc wechat fail');
        }
    }

    public function changeUserTypeToWorker($uid)
    {
        $model = self::where("uid", $uid)->first();
        if(empty($model))
            throw new DevInvalidParamsException(ErrorCode::USER_NOT_EXISTS);

        $model->user_type = Yconst::USER_TYPE_WORKER;
        if(!$model->save())
        {
            throw new DevDbException(ErrorCode::DB_FAILURE);
        }
    }

    public function getUsername($uid)
    {
        $model = self::where('uid', $uid)->first();
        return $model ? $model->username : NULL;
    }

    public function upsertInvitorCode()
    {
        $this->invite_code = Yutils::getInstance()->generateInvitorCode($this->id, $this->username);
        $this->save();
    }
}