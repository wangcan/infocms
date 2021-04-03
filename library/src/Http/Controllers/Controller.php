<?php

namespace Yeelight\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

//use Jiannei\Response\Laravel\Support\Traits\ExceptionTrait;

/**
 * Class Controller
 *
 * @category Yeelight
 *
 * @package Yeelight\Http\Controllers
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    //use ExceptionTrait;
}
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Http\Resources\UserResource;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


   public function getUserFace($uid, $size)
    {
        $userinfo = model('User')->getUserInfo($uid);
        $userinfo['avatar_big']=str_replace("file","www",$userinfo['avatar_big']);
        $userinfo['avatar_middle']=str_replace("file","www",$userinfo['avatar_middle']);
        $userinfo['avatar_small']=str_replace("file","www",$userinfo['avatar_small']);

//    switch ($size) {
//        case 'b':
//            $userface = $userinfo['avatar_big'];
//            break;
//        case 'm':
//            $userface = $userinfo['avatar_middle'];
//            break;
//        default:
//            $userface = $userinfo['avatar_small'];
//            break;
//    }
        $userface = $userinfo['avatar_middle'];
//    return $userface;
        $tx=str_replace("https://www.liupinshuyuan.com", "https://file.liupinshuyuan.com",  $userface);
        return  $tx;

    }

    public function getCurrentUid()
    {
        $user = $this->getCurrentUser();
		//$uid = isset($_GET['test_uid']) ? $_GET['test_uid'] : (empty($user) ? 0 : $user['uid']);
		$uid = empty($user) ? 0 : $user['uid'];
		return $uid;
    }



    protected function getCurrentCopybookUser()
    {
        $payload = auth('ecommerce')->payload()->toArray();

        return $payload['sub'];
    }


    public function getCurrentUser()
    {
        static $data;
        if (!empty($data)) {
            return $data;
        }
        $data = auth('api')->user();
        //$data = User::query()->where('uid', 629239)->first();
        return $data;
    }

    public function getDeviceno()
    {
        return \Request::header('deviceno');
    }

    protected function _userInfo($user)
    {
        return new UserResource($user);
    }
}
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
<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Controller as BaseController;
use Maatwebsite\Excel\Facades\Excel;
use App\Exceptions\PrivException;
use App\Services\ExcelService;
use App\Services\ExcelDownloadService;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Assistant;
use App\Models\Managerlog;

class Controller extends BaseController
{

    const CODE_NOT_FOUND = 404;
    protected  $perPage;
    protected $user = null;
    public $smartpenAdmin;
    public $smartpenTeachers = [];
    public $smartpenAssistants = [];

    public function __construct()
    {
        try{
            $inTest = config('app.inTest');
            $this->user = $inTest && $inTest == 2 ? User::find(1909223) : \JWTAuth::parseToken()->authenticate();
        }catch (\Exception $e){
            throw new PrivException('您没有权限');
        }
        $route = \Request::route()->getName();
        $smartpenAdminRoutes = config('priv.smartpen_admin_route');
        $smartpenAdmin = config('priv.smartpen_admin') ? array_filter(array_unique(explode(',', config('priv.smartpen_admin')))) : [];
        //$smartpenUser = config('priv.smartpen_user') ? array_filter(array_unique(explode(',', config('priv.smartpen_user')))) : [];
        $uid = $this->user->uid;
        $this->smartpenAdmin = !empty($smartpenAdmin) && in_array($uid, $smartpenAdmin) ? true : false;
        if (empty($this->smartpenAdmin) && in_array($route, $smartpenAdminRoutes)) {
            throw new PrivException('您没有智能笔管理权限');
        }
        $this->smartpenTeachers = Teacher::query()->where('uid', $uid)->get();
        $this->smartpenAssistants = Assistant::query()->where('uid', $uid)->get();
        if (empty($this->smartpenAdmin) && $this->smartpenTeachers->isEmpty() && $this->smatpenAssistants->isEmpty()) {
            throw new PrivException('您没有智能笔权限');
        }

        $this->perPage = intval(Input::get('page_size',15));
    }

    public function error($msg, $code = 1)
    {
       return collect([
           'status' => $code,
           'msg' => $msg, 
           //'data' => null,
           ]);
    }

    public function success($msg , $data=null ,$token = '')
    {
       $headers = $token ? ['Authorization' =>  'Bearer '.$token ] : [];
        return  new Response(
             collect([
                'status' => 0,
                'msg' => $msg,
                'data' => $data,
              ]),
            200,
            $headers
        );
    }

    public function user(){
        return $this->user;
    }

    function getUserFace($uid, $size)
    {
        $userinfo = model('User')->getUserInfo($uid);
        $userinfo['avatar_big']=str_replace("file","www",$userinfo['avatar_big']);
        $userinfo['avatar_middle']=str_replace("file","www",$userinfo['avatar_middle']);
        $userinfo['avatar_small']=str_replace("file","www",$userinfo['avatar_small']);

        $userface = $userinfo['avatar_middle'];
        $tx=str_replace("https://www.liupinshuyuan.com", "https://file.liupinshuyuan.com",  $userface);
        return  $tx;

    }

    public function getCurrentUid()
    {
        return $this->user->uid;
        $user = $this->getCurrentUser();
        //$uid = isset($_GET['test_uid']) ? $_GET['test_uid'] : (empty($user) ? 0 : $user['uid']);
        $uid = empty($user) ? 0 : $user['uid'];
        return $uid;
    }

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

        $model = $this->getModel();
        $query = $model->query();

        $query = $model->filterCondition($query, $params, $actionType);
        if (!empty($params['order_elem']) && is_array($params['order_elem'])) {
            foreach ($params['order_elem'] as $oField => $oType) {
                $query->orderBy($oField, $oType);
            }
        } elseif (isset($params['order_field']) && !empty($params['order_field']) && !empty($params['order_type'])) {
            $orderType = isset($params['order_type']) ? $params['order_type'] : 'desc';
            $query->orderBy($params['order_field'], $orderType);
        } else {
            $query->orderBy($model->getKeyName(), 'desc');
        }
        if (isset($params['exclude_field']) && is_array($params['exclude_field']) && !empty($params['exclude_field'])) {
            $query = $this->dealExclude($query, $params['exclude_field']);
        }

        $count = $query->count();
        $datas = $query->limit($limit)->offset($offset)->get();
        if (isset($_GET['intest'])) {
            dump(DB::getQueryLog());
        }
        $datas = $this->getResource($datas, $actionType);

		if ($downloadData) {
			$formatMethod = "_{$actionType}DownDatas";
			$downDatas = $this->getModel()->$formatMethod($datas, $params);
			return $this->_download($downDatas['datas'], $downDatas['ext'] . '_' . $downloadTitle);
		}
        $return = array_merge([
            'infos' => $datas,
            'totalNum' => $count,
            'pageSize' => $limit,
            'currentPage' => $page
        ], $dataExt);

        return $this->success('success', $return);
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
        if (!empty($this->smartpenAdmin)) {
            return $params;
        }
        if (!empty($this->smartpenTeachers)) {
            $params['isTeacher'] = true;
            $params['point_teacher_id'] = $this->getCurrentTeacherIds();
        }
        if (!empty($this->smartpenAssistants)) {
            $params['isAssistant'] = true;
            $params['point_assistant_id'] = $this->getCurrentAssistantIds();
        }
        return $params;
    }

    protected function _importDatas($request, $model, $type = '')
    {
        /*$resourceId = $request->input('resource_id');
        $resource = $model->getResourceById($resourceId);
        if (empty($resource)) {
            return $this->error('资源不存在', 400);
        }*/
        $excelService = new ExcelService();

        $fileObj = $request->file('excel_file');
        $extName = $fileObj->extension();
        $extName = $extName == 'zip' ? 'xlsx' : $extName;
        $file = $fileObj->storeAs('import', $type . '.' . $extName);

        $datas = Excel::toArray($excelService, $file);//"/tmp/{$type}.xlsx");
        //$datas = Excel::toArray($excelService, "/tmp/test/{$type}.xlsx");
        $datas = isset($datas[0]) ? $datas[0] : false;
        if (isset($datas[0])) {
            unset($datas[0]);
        }
        $count = count($datas);
        if (empty($count)) {
            return $this->error('没有有效的数据', 400);
        }

        $datas = $model->importDatas($datas);
        $message = '导入了' . count($datas['result']) . '条数据';
        if (isset($datas['errors']) && count($datas['errors']) > 0) {
            $message .= '; 导入失败的信息数：' . count($datas['errors']);
        }
        if (isset($datas['updates']) && count($datas['updates']) > 0) {
            $message .= '; 编辑的信息数：' . count($datas['updates']);
        }
        return $this->success($message, $datas);
    }

    protected function _downloadExcel($datas, $title = 'title')
    {
        return Excel::download(new ExcelDownloadService, $title . '.xlsx');
    }

    protected function createLog($menuCode, $menuName, $dataSource, $data)
    {
        $model = new Managerlog();
        $data = [
            'menu_code' => $menuCode,
            'menu_name' => $menuName,
            'data_source' => serialize($dataSource),
            'data' => serialize($data),
            'manager_uid' => $this->user['uid'],
            'manager_name' => $this->user['uname'],
        ];
        $model->createRecord($data);
        return true;
    }

    protected function getModel($code = null)
    {
        $code = is_null($code) ?$this->_getModelCode() :$code;
        return $this->getPointModel($code);
    }

    protected function _store($request)
    {
        $params = $request->all();
        $result = $this->getModel()->createData($params);
        if (isset($result['code']) && $result['code'] == 400) {
			return $this->error($result['message']);
        }
        return $this->success('success', $result);
    }

    protected function _update($request)
    {
        $inputs = $request->all();
        $result = $this->getModel()->updateData($inputs);
		if (isset($result['code']) && $result['code'] == 400) {
            return $this->error($result['message'], 400);
		}
        return $this->success('success', []);
    }

    protected function _delete($request)
    {
        $inputs = $request->all();
        $model = $this->getModel();
        $result = $model->deleteData($inputs);
		if (isset($result['code']) && $result['code'] == 400) {
            return $this->error($result['message'], 400);
		}
        return $this->success('success', []);
    }

    public function getPointModel($code)
    {
        $code = ucfirst($code);
        $class = "\App\Models\\{$code}";
        $model = new $class();
        $model->adminUser = $this->user;
        return $model;
    }

    protected function _download($datas, $title)
    {
		$service = new ExcelDownloadService();
		$service->setSourceDatas($datas);
		$file = $title . time() . '.xlsx';
        $r = Excel::store($service, $file);

        $host = config('app.api_url');
        $host = rtrim($host, '/');
        return $this->success('success', ['url' => $host . '/smartpen/docs/' . $file]);
    }

    public function getCurrentTeacherIds()
    {
        $teacherIds = [];
        foreach ($this->smartpenTeachers as $teacher) {
            $teacherIds[] = $teacher['id'];
        }

        return $teacherIds;
    }

    public function getCurrentAssistantIds()
    {
        $assistantIds = [];
        foreach ($this->smartpenAssistants as $assistant) {
            $assistantIds[] = $assistant['id'];
        }

        return $assistantIds;
    }
}
<?php

namespace App\Http\Controllers\Front;

use App\Models\Setting;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

    const CODE_NOT_FOUND = 404;
    protected  $perPage;
    protected $user = null;

    public function __construct()
    {
        try{
            $this->user = \JWTAuth::parseToken()->authenticate();
        }catch (\Exception $e){
            $this->user = null;
        }
        $inTest = config('app.inTest');
        $testUser = \Request::input('point_testuid');
        if ($inTest && $testUser) {
            $this->user = \App\Models\AppUser::find($testUser);
        }
        $this->perPage = intval(Input::get('page_size',15));
    }

    public function error($msg, $code = 1, $data = null)
    {
       return collect([
           'status' => $code,
           'msg' => $msg, 
           'data' => $data,
           ]);
    }

    public function success($msg , $data=null ,$token = '',$pageCount=0)
    {
       $headers = $token ? ['Authorization' =>  'Bearer '.$token ] : [];
        return  new Response(
             collect([
                'status' => 0,
                'msg' => $msg,
                'data' => $data,
              ]),
            200,
            $headers
        );
    }

    public function user(){
        return $this->user;
    }

    public function getDeviceno()
    {
        return \Request::header('deviceno');
    }

    public function getPointModel($code)
    {
        $code = ucfirst($code);
        $class = "\App\Models\\{$code}";
        return new $class();
    }

    public function noPenMark($course, $request)
    {
        $noPen = $request->input('no_pen');
        if (empty($noPen)) {
            return 0;
        }
        $isExperience = $course->isExperience();
        if (empty($isExperience)) {
            return 0;
        }
        return 1;
    }

    public function getVersion()
    {
        return \Request::header('version');
    }

    public function checkInnerUid($uid)
    {
        $innerUids = config('app.inner_uid');
        $innerUids = explode(',', $innerUids);
        return in_array($uid, $innerUids) ? 1 : 0;
    }
}
