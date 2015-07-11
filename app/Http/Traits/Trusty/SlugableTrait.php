<?php namespace App\Http\Traits\Trusty;

use Illuminate\Support\Str;

trait SlugableTrait
{
    /**
     * Set slug property.
     *
     * @param string $value
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value, '_');
    }
}