<?php

namespace App\Models\Infocms;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Article.
 *
 * @package namespace App\Entities;
 */
class Article extends AbstractModel implements Transformable
{
    use TransformableTrait;

    protected $table = 'article';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

}
