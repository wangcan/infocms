<?php

namespace App\Models\Infocms;

/**
 * Class CultureCategory.
 *
 * @package namespace App\Entities;
 */
class CultureCategory extends AbstractModel
{
    protected $table = 'culture_category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function parentElem()
    {
        return $this->hasOne('App\Models\Infocms\CultureCategory', 'code', 'parent_code');
    }

    public function getUrl()
    {
        $domain = config('app.cultureDomain');;
        $url = rtrim($domain, '/') . '/list/' . $this->code;
        return $url;
    }
}
