<?php

namespace App\Models\Infocms;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Pet.
 *
 * @package namespace App\Entities;
 */
class Pet extends AbstractModel implements Transformable
{
    use TransformableTrait;

    protected $table = 'pet';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

}
