<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use EasyWeChat\Factory;
use Illuminate\Support\Str;

class WechatServe
{

    public function getWechatServe($type, $code = '')
    {
        $code = empty($code) ? 'default' : $code;
        switch ($type) {
        case 'platform':
            return \EasyWeChat::openPlatform($code);
        case 'official':
			$config = config('wechat.official_account.' . $code);
			return Factory::officialAccount($config);
            //return \EasyWeChat::officialAccount($code);
        }
        //$app   = Factory::openPlatform($config);
    }

    public function getAuthurl($code = '')
    {
        $code = empty($code) ? 'default' : $code;
        //$config = config('wechat.open_platform.' . $code);
		$config = config('wechat.official_account.' . $code);
		$baseUrl = 'https://open.weixin.qq.com/connect/qrconnect?';
		$params = [
			'appid' => $config['app_id'],
			'response_type' => 'code',
			'scope' => 'snsapi_login',
			'state' => 'pad',
			'redirect_uri' => $config['redirecturl'],
		];
		return $baseUrl . http_build_query($params);
        //$url = appid=wxe7bea13954476147&redirect_uri=https%3A%2F%2Fwww.liupinshuyuan.com%2Flogin_callback%2Fweixin%2FLogin%2Fno_register_display.html&response_type=code&scope=snsapi_login&state=22983018bb868830094f3ae90f701701#wechat_redirect';
        //$url = $this->getWechatServe('platform', $code)->getPreAuthorizationUrl($config['redirecturl']);
    }

	public function getOauthurl()
	{
        $app = $this->getWechatServe('official');
        $oauth = $app->oauth;
        $oauth->redirect()->send();
        exit();
	}

	public function initUserinfo($oauth)
	{
		//$test = '{"id":"ozjtT0Wl6yBS27BDrxYWeyoc3j4k","name":"wangcan","nickname":"wangcan","avatar":"http:\/\/thirdwx.qlogo.cn\/mmopen\/vi_32\/Q0j4TwGTfTJgyRhHgzZCiaV9cF6hII4S4MTcmhAJkLY0bLjNmOibtALq6NngISCwhiaCoxtnOlEMiclSgm4nxiaibia1w\/132","email":null,"original":{"openid":"ozjtT0Wl6yBS27BDrxYWeyoc3j4k","nickname":"wangcan","sex":1,"language":"zh_CN","city":"","province":"","country":"中国","headimgurl":"http:\/\/thirdwx.qlogo.cn\/mmopen\/vi_32\/Q0j4TwGTfTJgyRhHgzZCiaV9cF6hII4S4MTcmhAJkLY0bLjNmOibtALq6NngISCwhiaCoxtnOlEMiclSgm4nxiaibia1w\/132","privilege":[],"unionid":"owQ_-08mXi5_5dFTtN4Z95otsngU"},"token":"33_DRXqJVQzgij4kCMlRLNtu6_Od170TpZYVaPtu9ijMOSH4Oz7syQajqS2r3614ZLDHNE0ApIm2xlar9Vv2JG_cWLSitwfQAeWF1Iblk0LF5s","provider":"WeChat"}';
		//$user = json_decode($test, true);
		$user = $oauth->user();
		$user = $user->toArray();
		//$user = $user->toJSON();
        return $this->formatUserData($user);
	}

    public function formatUserData($user)
    {
        $data = [
            //'data' => serialize($user),
        ];
        $original = [];
        if (isset($user['original'])) {
            $original = $user['original'];
            unset($user['original']);
        }
        $user = array_merge($user, $original);

        $pairs = [
            'openid', 'name', 'nickname',
            'headimgurl', 'token', 'unionid',
            'sex', 'language', 'city', 'province', 'country',
        ];
        foreach ($pairs as $key) {
            $value = isset($user[$key]) ? $user[$key] : '';
            if ($key == 'headimgurl' && empty($value) && !empty($user['avatar'])) {
                $value = $user['avatar'];
            }
            $value = empty($value) && $key == 'sex' ? 0 : $value;
            $data[$key] = $value;
        }
        return $data;
    }

    /**
     * 生成签名
     * @param $url
     * @return array|bool
     * @throws \EasyWeChat\Kernel\Exceptions\HttpException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \EasyWeChat\Kernel\Exceptions\RuntimeException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function signature($url){

        $jsapiTicket = $this->jsapiTicket();
        if (!$jsapiTicket) {
            return false;
        }

        $appId = config('app.wechat_app_id');
        $noncestr = Str::random(16);;
        $timestamp = time();
        $sha1sStr = "jsapi_ticket=$jsapiTicket&noncestr=$noncestr&timestamp=$timestamp&url=$url";
        $signature = sha1($sha1sStr);

        $config = [];
        $config['app_id'] = $appId;
        $config['timestamp'] = $timestamp;
        $config['noncestr'] = $noncestr;
        $config['signature'] = $signature;
        $config['jsapiTicket'] = $jsapiTicket;
        $config['url'] = $url;
        return $config;
    }
    /**
     * 获取jsapi_TICKET
     * @param $code
     * @return bool
     * @throws \EasyWeChat\Kernel\Exceptions\HttpException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \EasyWeChat\Kernel\Exceptions\RuntimeException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function jsapiTicket(){
        //获取token
        $accessToken = false;
        $token = Cache::get('wx_token_score');
        if ($token && $token['extend'] > time()) {
            $accessToken  = $token['value'];
        } else {
            $appId = config('app.wechat_app_id');
            $secret = config('app.wechat_app_secret');
            $accessTokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appId&secret=$secret";
            $result = json_decode(file_get_contents($accessTokenUrl));
            if($result->access_token){
                $dataTocken = [];
                $dataTocken['value'] = $result->access_token;
                $dataTocken['extend'] = time() + 7000;
                Cache::put('wx_token_score',$dataTocken,7200);
                $accessToken = $result->access_token;
            }

        }

        $jsapiTicket = false;
        $ticket = Cache::get('wx_ticket_score');

        if ($ticket && $ticket['extend'] > time()) {
            $jsapiTicket = $ticket['value'];
        } else {
            //获取SDK_TICKET
            $guzzle = new GuzzleServe();
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$accessToken."&type=jsapi";
            $res = $guzzle->curl($url);
            $res = json_decode($res, true);

            //存储
            try {
                if ($res['errcode'] == 0) {
                    $data = [];
                    $data['value'] = $res['ticket'];
                    $data['extend'] = time() + 7000;
                    Cache::put('wx_ticket_score',$data,7200);
                    $jsapiTicket = $res['ticket'];
                }
            } catch (\Exception $exception) {

            }

        }
        return $jsapiTicket;
    }
}
