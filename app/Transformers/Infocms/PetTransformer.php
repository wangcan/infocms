<?php

namespace App\Transformers\Infocms;

use League\Fractal\TransformerAbstract;
use App\Models\Infocms\Pet;

/**
 * Class PetTransformer.
 *
 * @package namespace App\Transformers;
 */
class PetTransformer extends TransformerAbstract
{
    /**
     * Transform the Pet entity.
     *
     * @param \App\Entities\Pet $model
     *
     * @return array
     */
    public function transform(Pet $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
