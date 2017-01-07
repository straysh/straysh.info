<?php  namespace App\Http\Models\Www;

use App\Exceptions\DevDbException;
use Illuminate\Database\Eloquent\Model as CModel;

abstract class FrontendModel extends CModel
{

	public $timestamps = FALSE;
	protected $dateAttrs = ['created_at', 'updated_at', 'deleted_at'];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
	    $this->filltimestamps();
    }

    public function hasAttribute($attributeName)
    {
        return isset($this->attributes[$attributeName]) || array_key_exists($attributeName, $this->attributes);
    }

	public function getDates()
	{
		return array();
	}

	protected function getDateFormat()
	{
		return 'U';
	}

    static protected function boot()
    {
        parent::boot();
    }

	public function filltimestamps()
	{
		$time = time();
		self::creating(function()use($time){
			if(in_array('created_at', $this->dateAttrs)) $this->created_at = $time;
			if(in_array('updated_at', $this->dateAttrs)) $this->updated_at = $time;
		});
		self::updating(function()use($time){
			if(in_array('updated_at', $this->dateAttrs)) $this->updated_at = $time;
		});
		self::deleting(function()use($time){
			if(in_array('updated_at', $this->dateAttrs)) $this->updated_at = $time;
			if(in_array('deleted_at', $this->dateAttrs)) $this->deleted_at = $time;
		});
	}

	public function scopeLast($query)
	{
		return $query->orderbyRaw("created_at DESC")->first();
	}

	protected function concatOrder($sql, $params)
	{
		if(!empty($params['orderby']))
		{
			$sql->orderByRaw($params['orderby']);
		}

		return $sql;
	}

	protected function parseMaxpage($sql, $options)
	{
		$total = $sql->count('*');
		return (int) ceil($total / $options['limit']);
	}

	/**
	 * ooxx_amount +/- 1の处理逻辑,该函数只应该被event listener调用
	 * @param int   $pk
	 * @param array $attributes
	 * @return string
	 * @throws DevDbException
	 */
	public function incAmount($pk, $attributes)
	{
		$primaryKey = $this->primaryKey;

		if( empty($pk) ) throw new DevDbException('model not specified');
		$model = self::find($pk);
		if( empty($model) ) throw new DevDbException('model not exists');

		foreach($attributes as $attrName=>$attrValue)
		{
			if( !$model->hasAttribute($attrName) ) continue;
			$model->$attrName += $attrValue;
		}

		if(!$model->save())
		{
			throw new DevDbException('update amount failed');
		}
		return $this->$primaryKey;
	}

}