<?php namespace App\Consts;

class ErrorCode
{
    const NORMAL_SUCCESS                    = 10000; //通用成功
    const ALREADY_LOGIN                     = 10001; //已经登陆了
    const MUST_LOGIN                        = 10006; //需要登录
    const USER_NOT_EXISTS                   = 10007; //用户不存在
    const EMAIL_NOT_EXISTS                  = 10008; //邮箱不存在
    const MOBILE_NOT_EXISTS                 = 10009; //手机号不存在
    const USERNAME_EXISTS                   = 10010; //用户名已经被注册了
    const USERNAME_REQUIRED                 = 10011; //用户名为空
    const USERNAME_TOO_LONG_OR_SHORT        = 10012; //用户名长度不合法
    const USERNAME_FORBIDDEN                = 10013; //用户名被禁止使用
    const USERNAME_INVALID                  = 10014; //用户名格式错误
    const EMAIL_EXISTS                      = 10015; //邮箱已经注册了
    const EMAIL_REQUIRED                    = 10016; //邮箱不能为空
    const EMAIL_TOO_LONG_OR_SHORT           = 10017; //邮箱长度不合法
    const EMAIL_INVALID                     = 10018; //邮箱格式错误
    const MOBILE_EXISTS                     = 10019; //手机号已经注册了
    const MOBILE_REQUIRED                   = 10020; //手机号不能为空
    const MOBILE_TOO_LONG_OR_SHORT          = 10021; //手机号长度不合法
    const MOBILE_INVALID                    = 10022; //手机号格式错误
    const INVALID_EMAIL_OR_MOBILE           = 10023; //邮箱或手机号格式错误
    const PASSWORD_REQUIRED                 = 10024; //密码不能为空
    const PASSWORD_TOO_LONG_OR_SHORT        = 10025; //密码长度不合法
    const PASSWORD_INCONSIST                = 10026; //两次密码不一致
    const ACCOUNT_NOT_BOUND                 = 10027; //三方账号未和本地账号绑定，无法登陆
    const ACCOUNT_ALREADY_BOUND             = 10028; //该三方账号已经与本地账号绑定,不能重复绑定
    const MOBILE_ALREADY_BOUND              = 10029; //该手机号已经被绑定了
    const EMAIL_INCONSIST                   = 10030; //邮箱不一致
    const USER_EXISTS                       = 10031; //用户已存在

    const NORMAL_INVALID_PARAMETERS         = 30000; //通用参数不合法
    const MISS_PARAMETERS                   = 30001; //缺少参数
    const INVALID_CAPTCHA                   = 30003; //验证码错误
    const PRICE_NEGTIVE                     = 30004; //金额不能为负数
    const PRICE_ZERO                        = 30005; //金额不能为零或负数

    const NORMAL_NOT_PERMITTED              = 40000; //通用权限不足
    const REQUEST_NOT_AJAX                  = 40001; //不是ajax请求
    const NOT_AUTHENTICATED                 = 40003; //未授权
    const INVALID_TOKEN                     = 40004; //无效token
    const EXPIRED_TOKEN                     = 40005; //accessToken 无效(已过期)
    const SMS_REQ_OUT_OF_LIMIT              = 40006; //验证码发送过于频繁
    const SMS_SENT_FAIL                     = 40007; //验证码发送失败
    const AUTH_EXPIRED                      = 40008; //登陆已失效
    const WORKER_LOCKED                     = 40009; //订单锁定中,不能选择该服务方/等待对方付款
    const PAYER_NOT_MATCH                   = 40010; //订单付款方不一致
    const PINGPP_API_KEY_NOT_SET            = 40011; //ping++ api key未设置
    const PINGPP_RSA_PRIVATE_PEM_NOT_SET    = 40012; //ping++ rsa private pem 未设置
    const NOT_OWNER                         = 40013; //不是创建者,无权操作
    const NOT_YOUR_ORDER                    = 40014; //不是你的订单,修改被拒绝
    const USER_ACCOUNT_NOT_EXIST            = 40015; //用户的资金账户不存在
    const BALANCE_TRANSFER_EXCEPTION        = 40016; //账户交易异常
    const BALANCE_RECHARGE_EXCEPTION        = 40017; //账户交易异常
    const BALANCE_NOT_ENOUGH                = 40018; //账户余额不足
    const BALANCE_FROZENIN_EXCEPTION        = 40019; //冻结金额异常
    const BALANCE_CASHOUT_EXCEPTION         = 40020; //提现金额异常
    const SERVICEORDER_CANCELED             = 40021; //服务订单已经被取消
    const SERVICEORDER_EXPIRED              = 40022; //服务订单已经过期
    const SERVICEORDER_DONE                 = 40023; //服务订单已经完成
    const SERVICEORDER_STAGE_EXCEPTION      = 40024; //服务订单状态不一致,修改被拒绝
    const TRADEORDER_STAGE_EXCEPTION        = 40025; //交易订单状态不一致,修改被拒绝
    const TRADEORDER_PAYING                 = 40026; //对方付款中,不能修改价格
    const TRADEORDER_PRICE_EXCEPTION        = 40027; //交易订单金额不一致
    const TRADEORDER_PAYING_EXPIRED         = 40028; //支付时间窗过期
    const TRADEORDER_REFUND_PRICE_NOT_MATCH = 40029; //退款金额不一致
    const ORDER_CANNOT_REVIEW               = 40030; //订单不能被点评
    const BILL_RECORD_NOT_EXISTS            = 40031; //账单记录不存在
    const BILL_RECORD_EXCEPTION             = 40032; //账单记录异常
    const ALREADY_REVIEWED                  = 40033; //已经评价
    const BILL_PAID_ZERO                    = 40034; //账单支付金额为零
    const FETCHER_REACHED_MAXIMUM           = 40035; //抢单人数已达上限
    const JOB_NOT_MATCH                     = 40036; //服务为通过审核,不能提供该服务
    const QUEST_DUP_FETCHED                 = 40037; //重复抢单
    const WORKER_NOT_VERIFIED               = 40038; //服务方尚未通过审核
    const DAIBI_NOT_ENOUGH                  = 40039; //代币余额不足
    const EMAIL_NOT_ACTIVATE                = 40040; //邮箱未激活
    const DAIBI_ORDER_NOT_EXISTS            = 40041; //代币订单不存在
    const REDEEM_NOT_EXISTS                 = 40042; //兑换码不存在
    const REDEEM_ALREADY_USED               = 40043; //兑换码已经被使用了
    const IMAGES_EMPTY                      = 40044; //图片列表为空
    const INVALID_INVITOR_CODE              = 40045; //邀请码无效
    const NOT_YOUR_ACCOUNT                  = 40046; //不是你的账户(钱包)
    const INVITOR_CODE_BOUND                = 40047; //该账号已经绑定邀请码
    const PRICE_TOO_LOW                     = 40048; //金额过低
    const QUESTORDER_STAGE_EXCEPTION        = 40049; //需求订单状态不一致,修改被拒绝
    const BALANCE_MARGIN_EXCEPTION          = 40050; //保证金余额异常
    const BALANCE_MARGIN_NOT_ENOUGH         = 40051; //保证金余额不足
    const PAY_STATUS_OFF                    = 40052; //不可支付
    const REFUND_OVERFLOW                   = 40053; //退款金额超过支付金额
    const NOT_CITY_PARTNER                  = 40054; //不是城市合伙人
    const QUEST_CANCELED                    = 40055; //需求已被取消
    const ALREADY_ENT_OWNER                 = 40056; //已经是企业主
    const NOT_ENT_OWNER                     = 40057; //不是企业主
    const NOT_ENT_STAFF                     = 40058; //不是企业员工
    const ENT_STAFF_EXISTS                  = 40059; //员工已经存在
    const ENT_STAFF_NOT_EXISTS              = 40060; //员工不存在
    const ENT_ALREADY_BOUND                 = 40061; //已经加入企业
    const NOT_WORKER                        = 40062; //不是服务者
    const PAYMENT_EXCEPTION                 = 40063; //支付异常
    const Coupon_INVALID                    = 40064; //优惠券无效
    const COUPON_STOCK_NEGATIVE             = 40065; //优惠券被领完了

    const NORMAL_FAILURE                    = 50001; //通用失败
    const REGISTER_FAIL                     = 50002; //用户注册失败
    const RESOURCE_NOT_EXISTS               = 50003; //请求的资源不存在(如商家不存在、circle不存在、菜品不存在等)
    const REQUEST_PAGE_NOT_EXISTS           = 50004; //请求的页面不存在
    const DB_FAILURE                        = 50005; //数据库错误[该错误只能在调试时使用,线上代码中不允许使用]
    const REQUEST_404                       = 50006; //请求的地址不存在
    const QUESTORDER_NOT_EXISTS             = 50007; //需求订单不存在
    const SERVICEORDER_NOT_EXIST            = 50008; //服务订单不存在
    const TRADEORDER_NOT_EXIST              = 50009; //交易订单不存在
    const ORDER_CLOSED                      = 50011; //订单已经被关闭
    const STREAM_BROKEN                     = 50012; //网络数据传输不完整
    const QUEST_LIMIT                       = 50013; //需求发布频率超过系统限制

    const VERSION_DEPRECATED                = 60001; //版本过低

}