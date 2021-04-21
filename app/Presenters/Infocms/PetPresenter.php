<?php

namespace App\Presenters\Infocms;

use App\Transformers\Infocms\PetTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PetPresenter.
 *
 * @package namespace App\Presenters;
 */
class PetPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PetTransformer();
    }
}
