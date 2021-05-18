<?php

namespace App\Presenters;

use Larabase\Presenters\AbstractPresenter as AbstractPresenterBase;

class AbstractPresenter extends AbstractPresenterBase
{

    public function getRelateDatas($info, $num = 8, $type = 'simple')
    {
        return $info->relateDatas($num, $type);
    }
}
