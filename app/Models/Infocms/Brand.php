<?php

namespace App\Models\Infocms;


/**
 * Class Brand.
 *
 */
class Brand extends AbstractModel
{
    protected $table = 'brand';
    protected $primaryKey = 'code';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany('App\Models\Infocms\Product', 'brand_code', 'code');
    }

    public function stores()
    {
        return $this->hasMany('App\Models\Infocms\Store', 'brand_code', 'code');
    }

    public function websites()
    {
        return $this->hasMany('App\Models\Infocms\Website', 'brand_code', 'code');
    }
}
