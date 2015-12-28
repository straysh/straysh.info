<?php namespace App\Http\Helpers;

class Yconst
{
	/**************************
	 * 终端类型
	 *************************/
	const CLIENT_TYPE_WEBPAGE               = 1;  //终端类型:网页
	const CLIENT_TYPE_WAP                   = 2;  //终端类型:手机浏览器
	const CLIENT_TYPE_IOS_PHONE             = 3;  //终端类型:IOS 手机
	const CLIENT_TYPE_IOS_PAD               = 4;  //终端类型:IOS 平板
	const CLIENT_TYPE_ANDROID_PHONE         = 5;  //终端类型:Android 手机
	const CLIENT_TYPE_ANDROID_PAD           = 6;  //终端类型:Android 平板

	/**************************
	 * 资源类型
	 *************************/
	const OBJECT_TYPE_PROFILE_PHOTO         = 1;  //个人头像
	const OBJECT_TYPE_BG_PHOTO              = 2;  //首屏背景图片
	const OBJECT_TYPE_RESTAURANT            = 3;  //商家首图
	const OBJECT_TYPE_RESTAURANT_LOGO       = 4;  //商家首图
	const OBJECT_TYPE_RESTAURANT_DISH       = 5;  //菜品
	const OBJECT_TYPE_RESTAURANT_DISH_PHOTO = 6;  //菜品图片
	const OBJECT_TYPE_RESTAURANT_ENV        = 7;  //环境图片
	const OBJECT_TYPE_RESTAURANT_PHOTO      = 8;  //商家-用户图片
	const OBJECT_TYPE_RESTAURANT_VIDEO      = 9;  //商家视频
	const OBJECT_TYPE_TABLETALK             = 10; //tabletalk
	const OBJECT_TYPE_TABLETALK_PHOTO       = 11; //tabletalk图片
	const OBJECT_TYPE_TABLETALK_VIDEO       = 12; //tabletalk视频
	const OBJECT_TYPE_USER                  = 13; //用户
	const OBJECT_TYPE_USER_PHOTO            = 14; //用户图片
	const OBJECT_TYPE_USER_VIDEO            = 15; //用户视频
	const OBJECT_TYPE_COLLECTION            = 16; //collection
	const OBJECT_TYPE_USER_POST             = 17; //用户动态
	const OBJECT_TYPE_USER_POST_PHOTO       = 18; //用户动态图片
	const OBJECT_TYPE_CIRCLE                = 19; //circle
	const OBJECT_TYPE_CIRCLE_PHOTO          = 20; //circle图片
	const OBJECT_TYPE_CIRCLE_VIDEO          = 21; //circle视频

	/**************************
	 * 人生菜单分类
	 *************************/
	const LIFEMENU_CATEGORY_APPETIZER       = 1;
	const LIFEMENU_CATEGORY_SOUP            = 2;
	const LIFEMENU_CATEGORY_FISH_DISH       = 3;
	const LIFEMENU_CATEGORY_MEAT_DISH       = 4;
	const LIFEMENU_CATEGORY_MAIN_COURSE     = 5;
	const LIFEMENU_CATEGORY_SALAD           = 6;
	const LIFEMENU_CATEGORY_DESSERT         = 7;
	const LIFEMENU_CATEGORY_DRINK           = 8;

	/**************************
	 * 消息类型
	 *************************/
	const MESSAGE_TYPE_USER                 = 1;
	const MESSAGE_TYPE_SYSTEM               = 2;
	const MESSAGE_TYPE_ADMIN                = 4;

	/**************************
	 * 消息动作类型
	 *************************/
	const MESSAGE_ACTION_CHAT               = 1;
	const MESSAGE_ACTION_AT                 = 2;
	const MESSAGE_ACTION_FOLLOW             = 3;

	/**************************
	 * 关联模型の加载模式
	 *************************/
	const LOAD_NONE                         = 0;
	const LOAD_STATISTIC                    = 1;
	const LOAD_RESTAURANT                   = 2;
	const LOAD_USER                         = 4;
	const LOAD_USER_ROLE                    = 8;
	const LOAD_IMAGES                       = 16;
	const LOAD_COUNTRY                      = 32;
	const LOAD_STATE                        = 64;
	const LOAD_CITY                         = 128;
	const LOAD_ALL                          = 255;
}
