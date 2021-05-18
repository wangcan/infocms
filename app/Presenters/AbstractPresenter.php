<?php

namespace App\Presenters;

use Larabase\Presenters\AbstractPresenter as AbstractPresenterBase;

class AbstractPresenter extends AbstractPresenterBase
{
    public function preInfoStr($info, $params)
    {
        $data = $this->preInfo($info, $params);
        return $this->_formatPreNextStr($data);
    }

    protected function _formatPreNextStr($data)
    {
        if (empty($data)) {
            return '没有了';
        }
        $url = '';//$data->getUrl();
        $str = "<a href='{$url}' target='_blank'>{$data['name']}</a>";
        return $str;
    }

    public function nextInfoStr($info, $params)
    {
        $data = $this->nextInfo($info, $params);
        return $this->_formatPreNextStr($data);
    }

    public function preInfo($info, $params)
    {
        return $info->preInfo($params);
    }

    public function nextInfo($info, $params)
    {
        return $info->nextInfo($params);
    }

    public function getRelateDatas($info, $num = 8, $params)
    {
        return $info->relateDatas($num, $params);
    }
}
