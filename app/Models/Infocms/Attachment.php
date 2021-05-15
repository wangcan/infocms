<?php

namespace App\Models\Infocms;

//use Prettus\Repository\Contracts\Transformable;
//use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Attachment.
 *
 * @package namespace App\Entities;
 */
//class Attachment extends AbstractModel implements Transformable
class Attachment extends AbstractModel
{
    protected $table = 'attachment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function getUrlAttribute()
    {
        $domain = config('app.uploadUrl');
        return rtrim($domain, '/') . '/' . $this->filepath;
    }
}
