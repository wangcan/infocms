<?php

namespace App\Models\Infocms;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Website.
 *
 */
class Website extends AbstractModel implements Transformable
{
    use TransformableTrait;

    protected $table = 'website';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

}
