<?php

namespace App\Presenters\Infocms;

/**
 * Class BrandPresenter.
 *
 * @package namespace App\Presenters;
 */
class BrandPresenter extends AbstractPresenter
{
    public function getProductDatas($brand)
    {
        return $brand->products;
    }

    public function getStoreDatas($brand)
    {
        return $brand->stores;
    }

    public function getWebsiteDatas($brand)
    {
        return $brand->websites;
    }
}
