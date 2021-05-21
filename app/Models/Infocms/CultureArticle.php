<?php

namespace App\Models\Infocms;

/**
 * Class CultureArticle.
 *
 * @package namespace App\Entities;
 */
class CultureArticle extends AbstractModel
{
    protected $table = 'culture_article';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function cultureCategory()
    {
        return $this->hasOne('App\Models\Infocms\CultureCategory', 'code', 'category_code');
    }

    public function getUrl()
    {
        $domain = config('app.cultureDomain');;
        $url = rtrim($domain, '/') . '/show-' . $this->id;
        return $url;
    }
}
