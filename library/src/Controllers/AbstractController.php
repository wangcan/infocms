<?php

namespace Larabase\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Controller as BaseController;

abstract class AbstractController extends BaseController
{
    use OperationTrait;

    public function __construct()
    {
    }

    public function getServiceRepo($code = '', $params = [])
    {
        $code = !empty($code) ? $code : get_called_class();
        return $this->resource->getObject('service-repo', $code);
    }

    public function getRepositoryObj($code = '', $params = [])
    {
        $code = !empty($code) ? $code : get_called_class();
        return $this->resource->getObject('repository', $code, $params);
    }

    public function getServiceObj($code = '', $params = [])
    {
        $code = !empty($code) ? $code : get_called_class();
        return $this->resource->getObject('service', $code, $params);
    }

    public function getRequestObj($scene = '', $repository = null, $code = '')
    {
        //$type = empty($action) ? 'request' : 'request-' . $action;
        $code = !empty($code) ? $code : get_called_class();
        //$request = $this->resource->getObject($type, $code, false);
        $request = $this->resource->getObject('request', $code, false);
        if (empty($request)) {
            return $this->request;
        }
        if ($repository) {
            $request->setRepository($repository);
        }
        $request->setScene($scene);

        if (method_exists($request, 'validateResolved')) {
            $request->validateResolved();
        }
        return $request;
    }

    protected function success($datas, $message = 'success')
    {
        return ['code' => 200, 'message' => $message, 'datas' => $datas];
    }

    public function throwException($code, $message = null)
    {
        return $this->resource->throwException($code, $message);
    }

    public function dealCriteria($scene, $repository, $params)
    {
        return $repository->getDealSearchFields($scene, $params);
    }

    public function getVersion()
    {
        return \Request::header('version');
    }

    public function getRouteParam($param)
    {
        return \ResourceManager::getRouteParam($param);
    }
}
