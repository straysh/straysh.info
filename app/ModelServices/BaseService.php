<?php namespace App\ModelServices;

//use Illuminate\Support\Facades\App;

class BaseService
{

    protected function __construct()
    {
//        $this->_user = App::make("Yuser");
    }

	protected function formatDate($array)
	{
		if( empty($array) ) return [];
		if(!empty($array['created_at']))
		{
			$array['created_date'] = date('d M, Y', $array['created_at']);
		}
		if(!empty($array['updated_at']))
		{
			$array['updated_date'] = date('d M, Y', $array['updated_at']);
			unset($array['updated_at']);
		}
		if(!empty($array['deleted_at']))
		{
			$array['deleted_date'] = date('d M, Y', $array['deleted_at']);
			unset($array['deleted_at']);
		}
		if(array_key_exists('deleted_at', $array)) unset($array['deleted_at']);

		return $array;
	}

	protected function formatNumber( $array )
	{
		if( empty($array) ) return $array;

		foreach($array as $k=>$v)
		{
			if(is_numeric($v)) $array[$k] = $v<0 ? 0 : $v;

			if(in_array($k, ["rating", "price", "latitude", "longitude"]))
			{
				$array[$k] = (float)$v;
				continue;
			}

			if(is_numeric($v))
			{
				$array[$k] = (int)$v;
				continue;
			}
		}

		return $array;
	}

}