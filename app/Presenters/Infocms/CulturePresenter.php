<?php

namespace App\Presenters\Infocms;

use Larabase\Helpers\TreeTool;

/**
 * Class CulturePresenter.
 *
 * @package namespace App\Presenters;
 */
class CulturePresenter extends AbstractPresenter
{
    public function getCategoryDatas()
    {
        $datas = \ResourceManager::getModel('cultureCategory', 'infocms')->get();
        $datas = $datas->keyBy('code');
        return $datas;
    }

    public function getCategoryTrees($parent = '')
    {
        $datas = $this->getCategoryDatas();
        $result = TreeTool::createTree($datas, $parent);

        return $result;
    }
}
