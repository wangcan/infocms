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

    public function getUrl()
    {
        return '';
    }
}
