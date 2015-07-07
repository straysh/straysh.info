<?php namespace App\Helpers;

use App\Exceptions\DevInvalidParamsException;
use App\ModelServices\ImageService;
use Intervention\Image\ImageManager;
use App\Models\Frontend\ImgBsc;
use App\Models\Frontend\ImgSrc;
use App\Models\Frontend\UserPhoto;

/**
 * http://image.intervention.io/api/
 */
class ImageHelper extends BaseHelper
{
    private static $_instance;
	private $originPath;
	private $baseUri;

	public function __construct()
	{
		parent::__construct();
		$this->originPath = config("setting.img_upload.origin_path", public_path()."/images/uploaded/origin");
		$this->baseUri = config("setting.img_upload.base_img_url", "http://static.yumcircle.local");
	}
	/**
	 * @return ImageHelper
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

	public function test($id)
	{
		var_dump($id);
//      exit;
//		if(123456!==$id){
//			var_dump("error");exit;
//		}
		return $id+1;
	}

	/**
	 * @param mixed $file
	 * @param int   $uid
	 * @param int   $type
	 * @param int   $rotation
	 * @return array
	 * @throws DevInvalidParamsException
	 */
	public function fileUpload($file, $uid, $type=0, $rotation=0)
	{
		if(empty($file))
		{
			throw new DevInvalidParamsException("empty file uploaded");
		}
		$manager = new ImageManager();
		$image = $manager->make($file)->rotate($rotation*90);
		$hash = $image->getImageSignature();
		$bscId = ImageService::getInstance()->createBsc($hash);
		$exif = $image->getExifJson();
		$hash = hash("sha256", $hash.$exif);
		$srcId = ImageService::getInstance()->createSrc($uid, $bscId, $type, $exif, $hash);
		if( ImgBsc::getInstance()->needMoveUpload )
		{
			$image->save( $this->getOriginPath($bscId) );
		}
		$image->destroy();

		return [$bscId, $srcId];
	}

	/**
	 * @param int   $uid
	 * @param int   $type
	 * @param int   $rotation    'rotation' => 选装次数,
	 * @param float $scale       'scale' => 缩放比例,
	 * @param int   $x           'x' =>  剪切区域左上角x坐标,
	 * @param int   $y           'y' => 剪切区域左上角y坐标,
	 * @param int   $w           'w' => 剪裁区域宽度,
	 * @param int   $h           'h' => 剪裁区域高度,
	 * @param int   $originImgId 'origin_img_id' => 原始图片id
	 *
	 * @return array
	 * @throws DevInvalidParamsException
	 */
	public function cropImage($uid, $type=0, $rotation, $scale, $x, $y, $w, $h, $originImgId)
	{
		$scale = filter_var($scale, FILTER_VALIDATE_FLOAT);
		$rotation = filter_var($rotation, FILTER_VALIDATE_INT, ['default'=>0]);
		$x = filter_var($x, FILTER_VALIDATE_FLOAT, ['default'=>0]);
		$y = filter_var($y, FILTER_VALIDATE_FLOAT, ['default'=>0]);
		$w = filter_var($w, FILTER_VALIDATE_INT);
		$h = filter_var($h, FILTER_VALIDATE_INT);
		$originImgId = filter_var($originImgId, FILTER_VALIDATE_INT);

		if(empty($scale) || empty($w) || empty($h) || empty($originImgId))
		{
			throw new DevInvalidParamsException("invalid params");
		}

		$file = $this->getOriginPath($originImgId);
		if(empty($file))
		{
			throw new DevInvalidParamsException("empty file uploaded");
		}
		$x = round($x/$scale);
		$y = round($y/$scale);
		$scaleW = round($w/$scale);
		$scaleH = round($h/$scale);
		$manager = new ImageManager();
		$image = $manager->make($file)
			->rotate($rotation*90)
			->crop($scaleW, $scaleH, $x, $y)
			->resize($w, $h);
		$hash = $image->getImageSignature();
		$bscId = ImageService::getInstance()->createBsc($hash);
//		$hash = $image->getImageSignature();
//		$bscId = ImageService::getInstance()->createBsc($hash);
		$exif = $image->getExifJson();
		$hash = hash("sha256", $hash.$exif);
		$srcId = ImageService::getInstance()->createSrc($uid, $bscId, $type, $exif, $hash);
		$image->save( $this->getOriginPath($bscId) );
		$image->destroy();

		return [$bscId, $srcId];
	}

	public function getOriginPath($imgId)
	{
		$path = $this->baseImagePath($imgId);
		return "{$path}/{$imgId}.jpg";
	}

	private function baseImagePath($imgId)
	{
		$dirno = floor($imgId/5000)+1;
		$path = $this->originPath."/{$dirno}";
		if( !file_exists($path) ) mkdir($path, 0770);
		return $path;
	}

	private function baseImageUrl($imgId)
	{
		$dirno = floor($imgId/5000)+1;
		return $this->baseUri."/{$dirno}/{$imgId}.jpg";
	}

	public function userProfilePhoto($imgId)
	{
		$url = $this->baseImageUrl($imgId);
		return $url;
	}

	public function cirlcleProfilePhoto($imgId)
	{
		$url = $this->baseImageUrl($imgId);
		return $url;
	}

	public function backgroundPhoto($imgId)
	{
		return "/images/tpl-design/re-bg/0{$imgId}.jpg";
	}

	/********************************************************************
	 * 以下文件即将删除
	 *******************************************************************/

	/**
	 *格式化接收的photo参数
	 * @param      $photo ['photoType:photoId:originalName:$file:rotation']
	 * @param null $type
	 * @return array $data  [ ['original_name'=>'','file'=>'','ratation'=>'','img_id'=>'','src_id'=>'','type'=>''] ]
	 */
	public function validatePhotoParams($photo, $type=NULL)
	{
		if(!is_array($photo))
			return [];
		$data = [];
		foreach ($photo as $item)
		{
			if(empty($item)) continue;
			$image = [];
			list( $_type, $photoId, $originalName, $file, $rotation ) = explode(":", $item);
			$image['file'] = $file ? config('setting.img_upload.base_temp_path').'/'.$file : '';
			$image['original_name'] = $originalName;
			$image['rotation'] = $rotation?:0;
			$image['img_id'] =NULL;
			$image['src_id'] =NULL;
			if(!empty($photoId))
			{
				$userPhoto = UserPhoto::find($photoId);
				if($userPhoto)
				{
					$image['img_id'] = $userPhoto->img_id;
					$image['src_id'] = $userPhoto->src_id;
				}
			}
			$image['type'] =$type ?: $_type;
			$data[] = $image;
		}

		return $data;

	}

	public function imgUrl($imgId)
	{
		return $this->baseImageUrl($imgId);
	}

	/**
	 * 获取商家logo
	 * @param $id
	 * @return string
	 */
	public function restaurantLogo($id)
	{
		return "#";
		$url = $this->baseImagePath($imgId);
		return $url;
	}

	/**
	 * 获取商家页首屏背景图片（高清大图）
	 * @param $id
	 * @return string
	 */
	public function restaurantBackgroundImage($id)
	{
		$id = $id%4+1;
		return "/images/tpl-design/re-bg/0{$id}.jpg";
	}

	/**
	 * 获取商家Logo
	 * @param $id
	 * @return string
	 */
	public function restaurantMainImage($id)
	{
		return '';
	}

	/**
	 * 获取菜品首图
	 * @param int $id 菜品id，当前img_id为测试
	 * @return string
	 */
	public function dishImage($id)
	{
		return $this->baseImageUrl($id);
		$id = $id%8+1;
		return "/images/tpl-design/photo/0{$id}.jpg";
	}

}