<?php

namespace App\Models\Infocms;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Product.
 *
 * @package namespace App\Entities;
 */
class Product extends AbstractModel implements Transformable
{
    use TransformableTrait;

    protected $table = 'product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function website()
    {
        return $this->hasOne('App\Models\Infocms\Website', 'foreign_key', 'local_key');
    }
}
