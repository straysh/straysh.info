<?php namespace App\Helpers;

class ErrorCode
{
	const NORMAL_SUCCESS             = 10000; //通用成功
	const ALREADY_LOGIN              = 10001; //已经登陆了
	const MUST_LOGIN                 = 10006; //需要登录
	const USER_NOT_EXISTS            = 10007; //用户不存在
	const EMAIL_NOT_EXISTS           = 10008; //用户不存在
	const MOBILE_NOT_EXISTS          = 10009; //用户不存在
	const USERNAME_EXISTS            = 10010; //用户名已经被注册了
	const USERNAME_REQUIRED          = 10011; //用户名为空
	const USERNAME_TOO_LONG_OR_SHORT = 10012; //用户名长度不合法
	const USERNAME_FORBIDDEN         = 10013; //用户名被禁止使用
	const USERNAME_INVALID           = 10014; //用户名格式错误
	const EMAIL_EXISTS               = 10015; //邮箱已经注册了
	const EMAIL_REQUIRED             = 10016; //邮箱不能为空
	const EMAIL_TOO_LONG_OR_SHORT    = 10017; //邮箱长度不合法
	const EMAIL_INVALID              = 10018; //邮箱格式错误
	const MOBILE_EXISTS              = 10019; //手机号已经注册了
	const MOBILE_REQUIRED            = 10020; //手机号不能为空
	const MOBILE_TOO_LONG_OR_SHORT   = 10021; //手机号长度不合法
	const MOBILE_INVALID             = 10022; //手机号格式错误
	const INVALID_EMAIL_OR_MOBILE    = 10023; //邮箱或手机号格式错误
	const PASSWORD_REQUIRED          = 10024; //手机号不能为空
	const PASSWORD_TOO_LONG_OR_SHORT = 10025; //手机号长度不合法
	const PASSWORD_INCONSISTANCE     = 10026; //两次密码不一致
	const ACCOUNT_NOT_BOUND          = 10027; //三方账号未和本地账号绑定，无法登陆

	const NORMAL_INVALID_PARAMETERS  = 30000; //通用参数不合法
	const MISS_PARAMETERS            = 30001; //缺少参数
	const INVALID_CAPTCHA            = 30003; //验证码错误

	const NORMAL_NOT_PERMITTED       = 40000; //通用权限不足
	const REQUEST_NOT_AJAX           = 40001; //不是ajax请求
	const NOT_AUTHENTICATED          = 40003; //未授权
	const INVALID_TOKEN              = 40004; //无效token
	const EXPIRED_TOKEN              = 40005; //accessToken 无效(已过期)

	const NORMAL_FAILURE             = 50001; //通用失败
	const REGISTER_FAIL              = 50002; //用户注册失败
	const RESOURCE_NOT_EXISTS        = 50003; //请求的资源不存在(如商家不存在、circle不存在、菜品不存在等)
	const REQUEST_PAGE_NOT_EXISTS    = 50004; //请求的页面不存在
	const DB_FAILURE                 = 50005; //数据库错误[该错误只能在调试时使用,线上代码中不允许使用]


	const CIRCLE_NOT_OWNER = 20000;//没有群主操作权限
	const CIRCLE_NOT_MANAGER = 20001;//没有群管理员操作权限
	const CIRCLE_NOT_MEMBER = 20002;//没有群成员权限
	const NOT_AUTHOR = 20003;//不是数据所有者
	const CIRCLE_REACHED_MAX_MEMBER = 20010;//已达到群最大成员数，无法申请加入
	const CIRCLE_REACHED_MAX_MANAGER = 20011;//已达到群最大管理员数，无法设置更多管理员
	const CIRCLE_IS_APPLIED = 20012;//已经在申请队列，请勿重复申请
	const CIRCLE_NO_APPLY = 20013;//没有申请历史
	const CIRCLE_TRANSFER_ERROR = 20020;//转让群失败




}