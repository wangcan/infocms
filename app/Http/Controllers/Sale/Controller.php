<?php

namespace App\Http\Controllers\Sale;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller as BaseController;
use App\Models\Sale\SalePeople;
use Maatwebsite\Excel\Facades\Excel; 
use App\Services\ExcelDownloadService;

class Controller extends BaseController
{
	protected $inSaleman = true;

    protected function _index($pageServe, $actionType = '', $dataExt = [])
    {
		DB::connection()->enableQueryLog();  // 开启QueryLog
        $params = $pageServe->request->all();
		$params = $this->formatPriv($params);
    	if (isset($params['code']) && $params['code'] == 403) {
    		return $params;
    	}

		$downloadData = isset($dataExt['download']) ? $dataExt['download'] : false;
		if ($downloadData) {
			$downloadData = $dataExt['download'];
			$downloadTitle = $downloadData['title'];
			$limit = isset($downloadData['limit']) ? $downloadData['limit'] : 2000;
			$page = 1;
			$offset = 0;
		} else {
            list($limit, $offset, $page) = $pageServe->getPageParameters();
		}

        $query = $this->getModel()->query();

        $query = $this->getModel()->filterCondition($query, $params, $actionType);
        if (!empty($params['order_elem']) && is_array($params['order_elem'])) {
			foreach ($params['order_elem'] as $oField => $oType) {
				$query->orderBy($oField, $oType);
			}
		} elseif (isset($params['order_field']) && !empty($params['order_field']) && !empty($params['order_type'])) {
            $orderType = isset($params['order_type']) ? $params['order_type'] : 'desc';
            $query->orderBy($params['order_field'], $orderType);
		} else {
            $query->orderBy('id', 'desc');
        }
		if (isset($params['exclude_field']) && is_array($params['exclude_field']) && !empty($params['exclude_field'])) {
			$query = $this->dealExclude($query, $params['exclude_field']);
		}

        $count = $query->count();
        $datas = $query->limit($limit)->offset($offset)->get();
		if (isset($_GET['intest'])) {
		    dump(DB::getQueryLog());
		}
		if ($downloadData) {
			$formatMethod = "_{$actionType}DownDatas";
			$downDatas = $this->getModel()->$formatMethod($datas, $params);
			return $this->_download($downDatas['datas'], $downDatas['ext'] . '_' . $downloadTitle);
		}
        $datas = $this->getResource($datas, $actionType);
        $return = array_merge([
            'infos' => $datas,
            'totalNum' => $count,
            'pageSize' => $limit,
            'currentPage' => $page
        ], $dataExt);

        return responseJsonHttp(200, 'success', $return);
    }

	protected function dealExclude($query, $excludeField)
	{
		//print_r($params);exit();
		foreach ($excludeField as $eField => $eValue) {
			$eValue = (array) $eValue;
			$query->whereNotIn($eField, $eValue);
		}
		return $query;
	}

	protected function formatPriv($params)
	{
		$cUid = $this->getCurrentUid();
		$specialIds = env('SALEALLPRIV', '');
		$specialIds = empty($specialIds) ? false : array_filter(explode(',', $specialIds));
		if (!in_array($cUid, $specialIds)) {
    		$saleman = $this->getSalemanData();
    		if (isset($saleman['code']) && $saleman['code'] == 403) {
    			return $saleman;
    		}
    		if ($this->inSaleman) {
    			$params['inSaleman'] = true;
    			$params['saleman_id'] = $saleman['id'];
    			$params['saleman_uid'] = $saleman['uid'];
    		}
		}
		return $params;
	}

	public function getSalemanData($forceSaleman = false)
	{
		$salePeople = new SalePeople();
		$saleman = $salePeople->query()->where('uid', $this->getCurrentUid())->first();
		
		if ($this->inSaleman && empty($saleman)) {
			return ['code' => 403, 'message' => '该操作需要时销售才能操作'];
		}
		return $saleman;
	}

    protected function _download($datas, $title)
    {
		$service = new ExcelDownloadService();
		$service->setSourceDatas($datas);
		//print_R($service);exit();
		$file = 'sale/' . $title . time() . '.xlsx';
		/*$file = 'sale-' . $title . '.xlsx';
        //return Excel::download($service, $file);
        $r = Excel::download($service, $file);
		$c = $r->getFile();
		$c =$c->getRealPath();
		$c = file_get_contents($c);
		//print_r($c);exit();
		return responseJsonHttp(200, 'success', $c);*/
        Excel::store($service, $file);

        return responseJsonHttp(200, 'success', config('app.url') . $file);

    }
}
