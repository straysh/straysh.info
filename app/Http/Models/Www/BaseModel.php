<?php  namespace App\Http\Models\Www;


use App\Exceptions\DevDbException;
use App\Http\Helpers\ErrorCode;
use Illuminate\Database\Eloquent\Model as CModel;
use Illuminate\Support\Facades\DB;

abstract class BaseModel extends CModel
{

	public $timestamps = FALSE;
	protected $dateAttrs = ['created_at', 'updated_at', 'deleted_at'];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
	    $this->filltimestamps();
    }

    public function beginTransaction()
    {
        DB::connection($this->connection)->beginTransaction();
    }

    public function commit()
    {
        DB::connection($this->connection)->commit();
    }

    public function rollback()
    {
        DB::connection($this->connection)->rollback();
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

    public function alias($alias)
    {
        return $this->from($this->getTable()." as {$alias}");
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
		}else
        {
            $sql->orderByRaw('created_at DESC');
        }

		return $sql;
	}

	protected function parseMaxpage($sql, $results, $options)
	{
		if( 1 === $options['page'] )
		{
			$results->maxPage = (int)!$results->isEmpty();

			if($results->hasMorePages())
			{
				$total = $sql->count('*');
				$results->maxPage = (int) ceil($total / $options['limit']);
			}
		}else
		{
			$results->maxPage = null;
		}

		return $results;
	}

    /**
     * ooxx_amount +/- 1の处理逻辑,该函数只应该被event listener调用
     * @param array $condition
     * @param array $attributes
     * @return string
     * @throws DevDbException
     */
    public function incAmount($condition, $attributes)
    {
        $primaryKey = $this->primaryKey;

        if( empty($condition) ) throw new DevDbException('model not specified');
        $model = self::where($condition['key'], $condition['value'])->first();

        if( empty($model) ) throw new DevDbException('model not exists');
        foreach($attributes as $attrName=>$attrValue)
        {
            if( !isset($model->$attrName) ) continue;
            $model->$attrName += $attrValue;
        }

        if(!$model->save())
        {
            throw new DevDbException('update amount failed');
        }
        return $this->$primaryKey;
    }

    /**
     * 查询条件の服务区域
     * @param $query
     * @param string $service_location
     */
    protected function appendServiceLocationCondition($query, $service_location)
    {
        $query->where(function($query) use($service_location){
            $query->whereRaw('service_location=?', ['g-1,']);
            if(!empty($service_location))
            {
                $locations = explode(',', trim($service_location, ','));
                $locations_count = count($locations);
                if(1 == $locations_count)
                {
                    if('g-1,' === $service_location) return;
                    // 服务范围是co
                    $query->whereRaw("service_location like \"{$service_location}%\"", [], 'OR');
                }else if(2 == $locations_count)
                {
                    // 服务范围是co+pr
                    $query->whereRaw("service_location=? OR service_location like \"{$service_location}%\"", [$locations[0].','], 'OR');
                }else if(3 == $locations_count)
                {
                    // 服务范围是co+pr+ci
                    $query->whereIn('service_location', [
                        $locations[0].',',
                        $locations[0].','.$locations[1].',',
                        $service_location
                    ], 'OR');
                }
            }
        });
    }

    protected function appendTimeLimitOfThisMonth($query, $is_month, $field=NULL)
    {
        if($is_month)
        {
            $field = $field ?: "created_at";
            $s = strtotime("first day of this month midnight");
            $e = strtotime("first day of next month midnight");
            $query->whereRaw("{$field}>? AND {$field}<=?", [$s, $e]);
        }

        return $query;
    }
}