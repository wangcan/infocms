<?php

namespace App\Models\Infocms;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PetArticle.
 *
 * @package namespace App\Entities;
 */
class PetArticle extends AbstractModel implements Transformable
{
    use TransformableTrait;

    protected $table = 'pet_article';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

}
