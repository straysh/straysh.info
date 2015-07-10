<?php namespace App\Http\Traits;

trait ClassNameTrait
{

    /**
     * Get called classname.
     *
     * @return string
     */
    public static function className()
    {
//        return get_called_class();
        return static::class;
    }
}
