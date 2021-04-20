<?php
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Overtrue\Pinyin\Pinyin;
use App\Services\GuzzleServe;

class User extends AbstractModel implements AuthenticatableContract, JWTSubject
{
    use Authenticatable;

    protected $table = 'user';
    protected $primaryKey = 'id';
    //public $timestamps = false;
    protected $fillable = ['uname', 'sex', 'login_salt', 'password', 'login', 'reg_ip', 'ctime', 'mhm_id', 'is_audit', 'is_active','is_init','first_letter','search_key','is_copybook','phone'];

    //protected $hidden = ['password'];

    public static function getUserData($uid)
    {
        return self::query()->where('uid', $uid)->first();
    }

    public function getAvatarUrl($type = false)
    {
//        $datas = $this->getAvatar();
//        if (empty($datas)) {
//            return '';
//        }
//        if (!empty($type)) {
//            return $datas[$type];
//        }
//        return $datas['avatar_original'];
        //新的头像获取方式
        $datas = $this->getAvatar();
        return $datas;
    }

    public function getAvatar()
    {
//        $guzzle = new GuzzleServe();
//        $dispatchParams = [
//            'app' => 'review',
//            'mod' => 'Childprogram',
//            'act' => 'getAvatar',
//            'uid' => $this->uid,
//            //'uid' => 629225,
//        ];
//        $result = $guzzle->getSyspre($dispatchParams);
//		$datas = json_decode($result, true);
//		return isset($datas['data']) ? $datas['data'] : [];
        //新的腾讯云头像
        $uid =  $this->uid;
        $md5 = md5($uid);
        $sc  = '/' . substr($md5, 0, 2) . '/' . substr($md5, 2, 2) . '/' . substr($md5, 4, 2);
//        $fileName = "data/upload/avatar".$sc."/".$uid.".jpg";
        $fileName = config('imageUrl.cos_storage_url').$sc."/".$uid.".jpg";
        $cosUrl = config('imageUrl.cosv5_cdn').$fileName;
        $imgExits = imgExists($cosUrl);
        //如果存在腾讯云头像则取腾讯云头像，否则取七牛云头像
        if($imgExits){
            return $cosUrl;
        }else{
            $oldFileName = "/data/upload/avatar".$sc."/original_100_100.jpg";
            return config('imageUrl.qiniu_url').$oldFileName;
        }
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

	public function createBywechat($data)
	{
		$pinyin = new Pinyin();
        $uname = $data['nickname'];
        $uname = $this->filterEmoji($uname);
		$exist = $this->query()->where('uname', $uname)->first();
		if ($exist) {
            $uname = $uname . rand(1000, 9999);
        }
        $password   = md5(uniqid());
		$loginSalt = rand(11111, 99999);
		$firstLetter = $pinyin->abbr($uname, PINYIN_KEEP_ENGLISH);
        $firstLetter = empty($firstLetter) ? '' : strtoupper($firstLetter[0]);
        if (preg_match('/[\x7f-\xff]+/', $uname)) {
            $searchKey = $uname . ' ' . $pinyin->permalink($uname, '');
        } else {
            $searchKey = $uname;
        }
		$nData = [
			'uname' => $uname,
			'sex' => $data['sex'],
			'login_salt' => $loginSalt,
            'password' => md5(md5(trim($password)) . $loginSalt),
			'login' => $uname,
            'reg_ip' => $data['ip'],
            'ctime' => time(),
            'mhm_id' => 1,
            'is_audit' => 1, // 审核状态： 0-需要审核；1-通过审核
            'is_active' => 1,
            'first_letter' => $firstLetter,
			'search_key' => $searchKey,
		];
        $result = $this->create($nData);
        $groupLink = new UserGroupLink();
        $groupLink->create(['uid' => $result['uid'], 'user_group_id' => 2]);
        //M('user_group_link')->add(['uid'=>$uid,'user_group_id'=>2]); //设置用户为学生组
        $userInfo = new UserInfo();
        $userInfo->create(['uid' => $result['uid'], 'time_h' => time()]);
        //@M("user_info")->add(['uid'=>$uid,'time_h'=>time()]);

		$userLogin = new UserLogin();
		$userLogin->createRecord($result, $data);

        $guzzle = new GuzzleServe();
        $dispatchParams = [
            'app' => 'review',
            'mod' => 'Childprogram',
            'act' => 'saveAvatar',
            'uid' => $result['uid'],
            'url' => $data['headimgurl'],//https://www.liupinshuyuan.com/apps/home/_static/images/centerbg.jpg',
        ];
        $r = $guzzle->getSyspre($dispatchParams);
        //file_put_contents('/tmp/log.txt', "\n saveheadimg" . serialize($r));
        //model('Avatar')->saveRemoteAvatar(t($userinfo['userface']), $uid);
        return $result;
	}

    /**
     * 过滤字符串中的emoji表情
     * 要过滤的字符串 $str
     * 返回的字符串 string
     */
    public function filterEmoji($str)
    {
        $str = preg_replace_callback('/./u',function(array $match){
            return strlen($match[0]) >= 4 ? '' : $match[0];
        },$str);

        return preg_replace('/\s/is','',$str);
    }

    /**
     * Notes:上传微信头像到腾讯cos
     * Author: zhongzhong & phperShine@163.com
     * DateTime: 2020/10/22 11:16
     * @param $uid
     * @param $headImgurl
     */
    protected function saveAvatar2Cos($uid,$headImgurl)
    {
        $md5 = md5($uid);

        $sc  = '/' . substr($md5, 0, 2) . '/' . substr($md5, 2, 2) . '/' . substr($md5, 4, 2);

        $fileName = config('imageUrl.cos_storage_url').$sc."/".$uid.".jpg";

        $disk = Storage::disk('cosv5');

        try {
            $stream = file_get_contents($headImgurl);
        }catch (\Exception $exception){
            $stream = '';
        }

        $disk->put($fileName,$stream);

    }


    /**
     * Notes:获取用户头像规则
     * Author: zhongzhong & phperShine@163.com
     * DateTime: 2020/10/22 11:18
     * @return string
     */
    public function getAvatarAttribute()
    {
        $md5 = md5($this->uid);

        $sc  = '/' . substr($md5, 0, 2) . '/' . substr($md5, 2, 2) . '/' . substr($md5, 4, 2);

        $fileName = config('imageUrl.cos_storage_url').$sc."/".$this->uid.".jpg";

        $cosUrl = config('imageUrl.cosv5_cdn').$fileName."?v=" . time();

        return $cosUrl;
    }

    /**
     * Notes:一对多 关联关系 一个用户多个评测作品
     * Author: zhongzhong & phperShine@163.com
     * DateTime: 2020/10/22 11:17
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany('App\Models\CopybookPhoto','uid','uid');
    }

    /**
     * Notes:指定字帖用户
     * Author: zhongzhong & phperShine@163.com
     * DateTime: 2020/10/22 11:15
     * @param $query
     * @return mixed
     */
    public function scopeCopybook($query)
    {
        return $query->where('is_copybook', 1);
    }
}
