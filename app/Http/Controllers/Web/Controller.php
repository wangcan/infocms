<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{

    public function _showCommon($id, $view, $modelCode, $module)
    {
        $model = $this->getPointModel($modelCode, $module);
        $info = $model->find($id);
        if (empty($info)) {
            echo 'info no exist';exit();
        }
        //print_R($info);
        $datas = [
            'view' => $view,
            'title' => $info['name'],
            'description' => $info['description'],
            'keyword' => $info['tag'],
            'info' => $info,
        ];
        return $this->customView($view, $datas);
    }
}
