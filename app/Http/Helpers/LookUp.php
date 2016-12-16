<?php namespace App\Http\Helpers;

use App\Http\Helpers\Yconst;

class LookUp 
{
	private static $_items;

	private function __construct()
	{
		;
	}

	/**
	 * 查找一个索引的label
	 *
	 * @param string  $group
	 * @param string  $item
	 *
	 * @return bool|mixed|null
	 */
	public static function item( $group, $item )
	{
		if(empty(self::$_items)) self::loadItems();
		$result = isset(self::$_items[$group]) && isset(self::$_items[$group][$item]) ?
			self::$_items[$group][$item] :
			NULL;
		return $result;
	}

	/**
	 * 查找一个label的索引
	 *
	 * @param string $group
	 * @param string $item
	 *
	 * @return bool|mixed
	 */
	public static function itemIndex($group, $item)
	{
		if(empty(self::$_items)) self::loadItems();
		$group = strtoupper($group);
		if(isset(self::$_items[$group]))
		{
//			$key = array_search($item, self::$_items[$group], TRUE);
			$key = array_keys(self::$_items[$group], $item);
			return count($key)==1 ? $key[0] : NULL;
		}else{
			return FALSE;
		}
	}

	public static function items($group)
	{
		$group = strtoupper($group);
		if(empty(self::$_items)) self::loadItems();
		return isset(self::$_items[$group]) ? self::$_items[$group] : array();
	}

	private static function loadItems()
	{
		$object_type = [
			'profile_photo',
			'bg_photo',
			'restaurant',
			'restaurant_logo',
			'restaurant_dish',
			'restaurant_dish_photo',
			'restaurant_env',
			'restaurant_photo',
			'restaurant_video',
			'tabletalk',
			'tabletalk_photo',
			'tabletalk_video',
			'user',
			'user_photo',
			'user_video',
			'collection',
			'user_post',
			'user_post_photo',
			'circle',
			'circle_photo',
			'circle_video',
		];
		$client_type = [
			'webpage', 'wap', 'ios_phone', 'ios_pad', 'android_phone', 'android_pad'
		];
		$lifemenu_category = [
			'appetizer', 'soup', 'fish_dish', 'meat_dish', 'main_course', 'salad', 'dessert', 'drink'
		];
		self::generateItmes( 'OBJECT_TYPE', $object_type );
		self::generateItmes( 'CLIENT_TYPE', $client_type );
		self::generateItmes( 'LIFEMENU_CATEGORY', $lifemenu_category );

		self::$_items['TALK_TYPE'][1001] = 'tabletalk';//tableTalk
		self::$_items['TALK_TYPE'][1002] = 'sub_tabletalk';//共餐者追评
		self::$_items['TALK_TYPE'][1003] = 'comment';//盖楼
		self::$_items['TALK_TYPE'][1004] = 'sub_comment';//回复
		self::$_items['TALK_TYPE'][1005] = 'review';//图片,环境,菜品点评

		self::$_items['USERPOST_TYPE'][1] = 'post';//
		self::$_items['USERPOST_TYPE'][2] = 'comment';//

		self::$_items['UPLOADED_OR_COLLECTED'][0] = 'collected';
		self::$_items['UPLOADED_OR_COLLECTED'][1] = 'uploaded';
		self::$_items['UPLOADED_OR_COLLECTED'][2] = 'all';

		self::$_items['GENDER'][0] = 'Female';
		self::$_items['GENDER'][1] = 'Male';
		self::$_items['GENDER'][2] = 'Secret';

		self::$_items['CURRENCY'][1] = 'aud';
		self::$_items['CURRENCY'][2] = 'usd';

		self::$_items['SOCIALIZE_TYPE'][1] = 'facebook';
		self::$_items['SOCIALIZE_TYPE'][2] = 'twitter';
		self::$_items['SOCIALIZE_TYPE'][3] = 'google';
//		self::$_items['SOCIALIZE_TYPE'][4] = 'pinterest';
//		self::$_items['SOCIALIZE_TYPE'][5] = 'weibo';

	}

	private static function generateItmes($type, $values)
	{
		if(empty($type) || !is_array($values)) return;
		foreach($values as $label)
		{
			$key = constant("\\App\\Helpers\\Yconst::{$type}_".strtoupper($label));
			self::$_items[$type][$key] = $label;
		}
	}
}