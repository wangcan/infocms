<?php

namespace App\Http\Controllers\Sale;

use Illuminate\Support\Facades\Redis;
use App\Models\Sale\SalePeople;
use App\Models\Sale\SaleGroup;
use App\Services\PageServe;
use App\Http\Resources\Sale\SalePeopleResource;
use App\Http\Requests\Sale\SalePeopleIndexRequest;
use App\Http\Requests\Sale\SalePeopleNoticeRequest;
use App\Http\Requests\Sale\SalePeopleRecordRequest;
use Illuminate\Http\Request;

class SalePeopleController extends Controller
{
    /**
     * @group sale-v1.5销售后台
     *
     * index0203销售列表页
     *
     * @responseFile responses/sale-sale-people-index.get.json
     */
    public function index(PageServe $serve, SalePeopleIndexRequest $request)
    {
        return $this->_index($serve);
    }

    /**
     * @group saleindex销售后台
     *
     * rank0203销售榜单
     *
     * @responseFile responses/sale-sale-people-rank.get.json
     */
    public function rank(PageServe $serve)
    {
        return $this->_index($serve);
    }

    /**
     * @group sale-v1.5销售后台
     *
     * group2991销售组
     *
     * @responseFile responses/sale-sale-people-group.get.json
     */
    public function group()
    {
		$saleGroup = new SaleGroup();
		$datas = array_values($saleGroup->getLevelDatas());
        return responseJsonHttp('200', 'success', $datas);
    }

    /**
     * @group saleindex销售后台
     *
     * new2939我的客户最新动态
     *
     * @response {
     *  "code": 200,
     *  "message": "success",
     *  "data":{
     *    "newReview": "新的点评数",
     *    "newHomework": "新的作品提交数"
     *  }
     * }
     */
    public function notice()//SalePeopleNoticeRequest $request)
    {
        $uid = $this->getCurrentUid();
        return $this->getModel()->getNoticeData($uid);
    }

	protected function formatPriv($params)
	{
		$cUid = $this->getCurrentUid();
		$specialIds = env('SALEMANPRIV', '');
		$specialIds = empty($specialIds) ? false : array_filter(explode(',', $specialIds));
		if (!in_array($cUid, $specialIds)) {
    		$saleman = $this->getSalemanData();
    		if (isset($saleman['code']) && $saleman['code'] == 403) {
    			return $saleman;
    		}
    		if ($this->inSaleman) {
    			$params['inSaleman'] = true;
    			$params['saleman_id'] = -1;//$saleman['id'];
    			$params['saleman_uid'] = $saleman['uid'];
    		}
		}
		return $params;
	}

    /**
     * @group saleindex销售后台
     *
     * recordNotice2939记录销售最后一次关注我的客户的时间
     *
     * @response {
     *  "code": 200,
     *  "message": "success"
     * }
     */
    public function recordNotice(SalePeopleRecordRequest $request)
    {
        $uid = $this->getCurrentUid();
        $type = $request->input('type');
		if (!in_array($type, ['homework', 'review'])) {
			return $responseJsonHttp(400, '参数有误');
		}

        return $this->getModel()->readNotice($uid, $type);
    }

    protected function getModel()
    {
        return new SalePeople();
    }

    protected function getResource($datas)
    {
        return SalePeopleResource::collection($datas);
    }

    public function test()
    {
        return view('test-form');
    }

    public function testFill(Request $request)
    {
        //$uInfos = \App\Models\User::inRandomOrder()->limit(10)->get();
        $uInfos = \App\Models\User::query()->limit(10)->offset(1000)->get();
        $bInfos = ['1' => '软笔', '2' => '硬笔', '3' => '少儿'];
        return view('test-fill', ['uInfos' => $uInfos, 'bInfos' => $bInfos]);
    }

    protected function testFillbak(Request $request)
    {
        $all = $request->all();
        $user = new \App\Models\User;

        $infos = $user->query()->limit(200)->get();

        $customer = new \App\Models\Sale\SalemanCustomer();
        $salemanId = 3;
        foreach ($infos as $info) {
            foreach ([1, 2, 3] as $cateId) {
                $created = time() - rand(0, 86400 * 30);
                $data = [
                    'saleman_id' => $salemanId,
                    'uid' => $info['uid'],
                    'cate_id' => $cateId,
                    'created_time' => $created,
                    'updated_time' => $created + rand(60, 60 * 10),
                    'last_time' => $created + rand(60, 60 * 10),
                ];
                //$r = $customer->create($data);
                //var_dump($r);
            }
        }
        //print_r(count($infos));
    }

	public function testUser(Request $request)
	{
		//print_R($_COOKIE);exit();
		$s = $request->session();
		//print_R($s);
	}
    public function testredis()
    {
        Redis::set('name', 'test');
        $values = Redis::get('name');
        dd($values);
    }
}
