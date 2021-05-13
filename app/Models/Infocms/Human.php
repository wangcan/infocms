<?php

namespace App\Models\Infocms;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Human.
 *
 */
class Human extends AbstractModel implements Transformable
{
    use TransformableTrait;

    protected $table = 'human';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

}
