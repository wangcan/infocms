<?php

namespace App\Presenters\Infocms;

use App\Presenters\AbstractPresenter as AbstractPresenterBase;

class AbstractPresenter extends AbstractPresenterBase
{

    protected function getDefaultModule()
    {
        return 'infocms';
    }
}
