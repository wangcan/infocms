<?php

namespace Larabase\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Controller as BaseController;

abstract class AbstractController extends BaseController
{
    use TraitOperation;

    const CODE_NOT_FOUND = 404;
    protected  $perPage;
    protected $user = null;

    public function __construct()
    {
        try{
            //$inTest = config('app.inTest');
            //$this->user = $inTest && $inTest == 2 ? User::find(1909223) : \JWTAuth::parseToken()->authenticate();
        }catch (\Exception $e){
            //throw new \Exception('您没有权限');
        }

        //$this->perPage = intval(Input::get('page_size',15));
    }

    public function user(){
        return $this->user;
    }

    public function getCurrentUid()
    {
        return $this->user->uid;
        $user = $this->getCurrentUser();
        //$uid = isset($_GET['test_uid']) ? $_GET['test_uid'] : (empty($user) ? 0 : $user['uid']);
        $uid = empty($user) ? 0 : $user['uid'];
        return $uid;
    }

    protected function getModel($code = null, $module = '')
    {
        $code = is_null($code) ?$this->_getModelCode() :$code;
        return \ResourceManager::getModel($code, $module);
    }

    public function getVersion()
    {
        return \Request::header('version');
    }

    public function getRouteParam($param)
    {
        return \Larabase\Helpers\ResourceManager::getRouteParam($param);
    }
}
