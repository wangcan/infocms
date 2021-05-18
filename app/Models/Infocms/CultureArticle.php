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

}
