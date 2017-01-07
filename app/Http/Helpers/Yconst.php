<?php namespace App\Http\Helpers;

class Yconst
{
	const RESULT_SKIP                      = 1;//internal const, 返回点后的代码块不需要执行
	const RESULT_RETURN                    = 2;//internal const, 返回点后的代码块需要正常执行

	const OPTION_ALL                        = 999;
	const SYS_ACCOUNT                       = 1;//系统账户
	const QUEST_ORDER                       = 'quest';//需求
	const SERVICE_ORDER                     = 'service';//服务
	const TRADE_ORDER                       = 'trade';//交易
	const DAIBI_BUY                         = 'daibi';//代币
	const Deposit                           = 'deposit';//保证金

	const USER_TYPE_CONSUMER                = 1;
	const USER_TYPE_WORKER                  = 2;
	const USER_TYPE_BIZ_WORKER              = 3;
	const USER_TYPE_SYSTEM                  = 100;
	const USER_TYPE_CALL_CENTER             = 101;

	const APPROVER_SYSTEM_AUTO              = 1;//系统自动确认
	const APPROVER_ADMINISTRATOR            = 2;//后台管理员人工确认
	const APPROVER_UNKNOWN                  = 3;//未审核

	const CANCEL_TYPE_ING                   = 2;
	const CANCEL_TYPE_OK                    = 3;
	const CANCEL_TYPE_ADMIN                 = 5;

	/**************************
	 * 图片类型
	 *************************/

	const ACCOUNT_STATE_NORMAL              = 1;//默认,正常
	const ACCOUNT_STATE_ABNORMAL            = 2;//账号异常
	const ACCOUNT_STATE_FORBIDDEN           = 3;//账号被禁用

	/**************************
	 * 图片类型
	 *************************/

	const IMAGE_AVATAR                      = 1;//头像
	const IMAGE_ID_CARD                     = 2;//身份证
	const IMAGE_PASSPORT                    = 3;//护照
	const IMAGE_SELF_PHOTO                  = 4;//本尊照片
	const IMAGE_SKILL_PHOTO                 = 5;//技能图片

	/**************************
	 * 终端类型
	 *************************/
	const CLIENT_WEBPAGE                    = 1;//终端类型:网页
	const CLIENT_WAP                        = 2;//终端类型:手机浏览器
	const CLIENT_IOS_PHONE                  = 3;//终端类型:IOS 手机
	const CLIENT_IOS_PAD                    = 4;//终端类型:IOS 平板
	const CLIENT_ANDROID_PHONE              = 5;//终端类型:Android 手机
	const CLIENT_ANDROID_PAD                = 6;//终端类型:Android 平板
	const CLIENT_WECHAT_APP                 = 7;//终端类型:微信网页版

	const REG_TYPE_UNKNOWN                  = 0;//未知
	const REG_TYPE_MOBILE                   = 1;//手机注册
	const REG_TYPE_EMAIL                    = 2;//邮箱注册
	const REG_TYPE_WECHAT                   = 3;//微信注册

	/**************************
	 * 系统通知类型
	 *************************/
	const NOTIFICATION_SYSTEM               = 4;//系统消息

	/**************************
	 * 订单状态
	 *************************/

	const QUEST_STAGE_NEW                   = 1;//新需求
	const QUEST_STAGE_FETCHED               = 2;//已被抢
	const QUEST_STAGE_CLOSED                = 3;//已关闭
	const QUEST_STAGE_CANCELED              = 4;//已取消
	const QUEST_STAGE_EXPIRED               = 5;//已过期
	const QUEST_STAGE_GAME_OVER             = 6;//已抢完

	const SERVICE_STAGE_FETCHED             = 1;//已抢单
	const SERVICE_STAGE_CHOOSED             = 2;//已选择
	const SERVICE_STAGE_DONE                = 3;//已完成
	const SERVICE_STAGE_CLOSED              = 4;//已关闭
	const SERVICE_STAGE_CANCELED            = 5;//已取消
	const SERVICE_STAGE_EXPIRED             = 6;//已过期

	const TRADE_STAGE_DEFAULT               = 100;// 初始化状态
	const TRADE_STAGE_CHOOSED               = 101;//待付款
	const TRADE_STAGE_PAYING                = 102;//支付中
	const TRADE_STAGE_PAIED                 = 103;//支付完成
	const TRADE_STAGE_OFFLINETRADE          = 104;//线下交易
	const TRADE_STAGE_SERVING               = 105;//服务中
	const TRADE_STAGE_DONE_APPLYING         = 106;//申请交易完成
	const TRADE_STAGE_DONE_CONFIRMED        = 107;//确认交易完成
	const TRADE_STAGE_CANCELING             = 108;//交易取消中
	const TRADE_STAGE_CANCELED              = 109;//交易取消成功
	const TRADE_STAGE_REFUNDING             = 110;//交易退款审核中
	const TRADE_STAGE_REFUNDED              = 111;//交易退款成功

	const VERIFY_STAGE_DEFAULT              = 1;//默认状态
	const VERIFY_STAGE_ING                  = 2;//审核中
	const VERIFY_STAGE_REJECTED             = 3;//审核被拒绝
	const VERIFY_STAGE_DONE                 = 4;//审核通过
	const VERIFY_STAGE_BLOCK                = 5;//黑名单

	const BILL_TYPE_OL_PAY                  = 101;//在线支付
	const BILL_TYPE_RECHARGE                = 102;//充值
	const BILL_TYPE_CASH_OUT_APPLY          = 103;//提现
	const BILL_TYPE_RELAX_PAY               = 104;//余额支付
	const BILL_TYPE_CASH_OUT_FEE            = 105;//提现手续费
	const BILL_TYPE_USE_RELAX_PAY           = 106;//余额支付订单
	const BILL_TYPE_USE_MARGIN              = 107;//保证金支付订单
	const BILL_TYPE_DEPOSIT                 = 108;//充值保证金
	const BILL_TYPE_BROKERAGE               = 201;//支付报酬
	const BILL_TYPE_CASH_OUT_PAID           = 202;//支付提现
	const BILL_TYPE_BONUS                   = 203;//支付提成
	const BILL_TYPE_REFUNDING               = 204;//用户退款申请
	const BILL_TYPE_REFUNDED                = 205;//系统向用户退款
	const BILL_TYPE_QUEST_PRE_PAY           = 206;//发布需求预付款
	const BILL_TYPE_DAIBI_USE_RELAX_PAY     = 301;//余额购买代币
	const BILL_TYPE_DAIBI_OL_PAY            = 302;//在线支付购买代币
	const BILL_TYPE_DAIBI_SPEND             = 303;//消费代币
	const BILL_TYPE_DAIBI_REFUND            = 304;//退还代币
	const BILL_TYPE_DAIBI_SPEND_BAILED      = 305;//保单消费代币
	const BILL_TYPE_DAIBI_REFUND_BAILED     = 306;//保单退还代币
	const BILL_TYPE_DEPOSIT_CASHOUT         = 307;//担保金提现
	const BILL_TYPE_DAIBI_REWARD            = 401;//系统赠送代币
	const BILL_TYPE_DAIBI_INVITED_REWARD    = 402;//被邀请赠送代币
	const BILL_TYPE_DAIBI_REDEEM            = 403;//兑换码兑换代币
	const BILL_TYPE_DAIBI_REBATE            = 404;//充值代币返利

	const REVIEWED_STAGE_NONE               = 1;//双方未评
	const REVIEWED_STAGE_ONLY_WORKER        = 2;//C未评
	const REVIEWED_STAGE_ONLY_CONSUMER      = 3;//W未评
	const REVIEWED_STAGE_BOTH               = 4;//已互评

	const PAID_METHOD_ALIPAY                 = 1;//支付宝
	const PAID_METHOD_WECHAT                 = 2;//微信支付
	const PAID_METHOD_APPLEPAY               = 3;//苹果支付
	const PAID_METHOD_PAYPAL                 = 4;//paypal
	const PAID_METHOD_OFFLINETRADE           = 5;//线下交易
	const PAID_METHOD_UNIT_TEST              = 6;//单元测试
	const PAID_METHOD_SELF                   = 7;//余额

	/***********************************
	 *            退款系统
	 **********************************/
	const REFUND_STAGE_DEF                   = 1;//初始状态
	const REFUND_STAGE_DELAY                 = 2;//管理员延迟退款
	const REFUND_STAGE_START                 = 3;//等待系统发起退款
	const REFUND_STAGE_ALIPAY_RECONFIRM      = 4;//等待管理员确认支付宝退款
	const REFUND_STAGE_PINGPP_NOTIFY         = 5;//等待渠道退款确认
	const REFUND_STAGE_SUCCESS               = 6;//退款成功

	const REFUND_FILTER_USER_CANCEL          = 1;//用户取消需求
	const REFUND_FILTER_FINAL                = 2;//七日后触发系统退款

	/***********************************
	 *            消息系统
	 **********************************/
	const MESSAGE_TYPE_SYS_BOARD_ALL         = 1;// 公告消息(对全站用户)
	const MESSAGE_TYPE_SYS_BOARD_WORKER      = 2;// 公告消息(对服务者)
	const MESSAGE_TYPE_SYS_NOTICE            = 3;// 系统通知(对单个用户)
	const MESSAGE_TYPE_USER_MESSAGE          = 4;// 用户站内信

	/***********************************
	 *            推广系统
	 **********************************/
	const PROMOTION_CP_REG_REWARD_RMB        = 10; //成功邀请奖励金额￥10
	const PROMOTION_WECHAT_FIRST_QUEST_REWARD_RMB        = 1; //被邀请人发布第一个需求,奖励金额￥1
	const PROMOTION_WECHAT_REG_REWARD_RMB    = 0.2;//成功邀请奖励金额￥0.1
	const PROMOTION_WECHAT_REWARD            = 501;//微信推广奖励
	const PROMOTION_CP_DAIBI_REBATE          = 502;//被邀请人购买代币返利
	const PROMOTION_CP_REG_REWARD            = 503;//成功邀请服务者奖励
	const PROMOTION_CP_REG_KPI_REWARD        = 504;//成功邀请KPI奖励
	const PROMOTION_CASHOUT_APPLY            = 505;//提现申请
	const PROMOTION_WECHAT_FIRST_QUEST_REWARD= 506;//被微信邀请用户第一次发布需求

	const PROMOTION_JOB_STAUTS_DEFAULT       = 1;//未处理
	const PROMOTION_JOB_STAUTS_ING           = 2;//处理中
	const PROMOTION_JOB_STAUTS_DONE          = 3;//已理中
	const PROMOTION_JOB_STAUTS_FAIL          = 4;//处理失败

	const PROMOTION_INVITE_WECHAT            = 1;//微信推广邀请
	const PROMOTION_INVITE_APP               = 2;//APP注册邀请

}
