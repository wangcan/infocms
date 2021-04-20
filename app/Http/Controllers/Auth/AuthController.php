<?php

namespace App\Http\Controllers\Auth;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\PadPassword;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     * 要求附带email和password（数据来源users表）
     * 
     * @return void
     */
    public function __construct()
    {
        // 这里额外注意了：官方文档样例中只除外了『login』
        // 这样的结果是，token 只能在有效期以内进行刷新，过期无法刷新
        // 如果把 refresh 也放进去，token 即使过期但仍在刷新期以内也可刷新
        // 不过刷新一次作废
        $this->middleware('auth:api', ['except' => ['login', 'qrcode', 'qrscan', 'refresh']]);
        // 另外关于上面的中间件，官方文档写的是『auth:api』
        // 但是我推荐用 『jwt.auth』，效果是一样的，但是有更加丰富的报错信息返回
    }

    /**
     * @group auth登录模块
     *
     * dev:login账号密码登录，暂时用不到
	 * 获取到Token后，后续需要登录用户才能操作的请求，需在请求的header里带上token信息，header的变量名为Authorization，值为："Bearer {Token}" Bearer与token之间要有一个空格；
     *
     * @return Array
     * @response {
     *   "code": 200,
     *   "message": "success",
     *   "data": {
     *     "prefix": "Bearer",
     *     "token": "token",
     *     "myinfo": {
     *       "uid": "用户ID",
     *       "uname": "用户名",
     *       "sex": "性别",
     *       "avatar": "用户头像"
     *     }
     *   }
     * }
     */
    public function login(LoginRequest $request)
    {
        //$field = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $credentials = $request->only('name', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return responseJsonHttp(422, '用户名或密码不正确');
            $this->response->error('', 422);
        }

        return responseJsonHttp(200, '登录成功', ['token' => $token]);//$this->getToken($info));

        /*$credentials = request(['email', 'password']);
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);*/
    }

    /**
     * Refresh a token.
     * 刷新token，如果开启黑名单，以前的token便会失效。
     * 值得注意的是用上面的getToken再获取一次Token并不算做刷新，两次获得的Token是并行的，即两个都可用。
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $data = [
            'token' => $this->respondWithToken(auth('api')->refresh()),
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];
        return responseJsonHttp(200, '刷新成功', $data);
        /*try {
            $token = JWTAuth::parseToken()->refresh();
        } catch (TokenExpiredException $e) {
            return $this->response->error('token已过期', $e->getStatusCode());
        } catch (JWTException $e) {
            return $this->response->error('token无效', $e->getStatusCode());
        }
        return $this->response->array(compact('token'));*/
    }

    /**
     * 拼接 token
     *
     * @param User $user
     * @return array
     */
    protected function getToken(User $user)
    {
        // 换取 token
        $prefix = 'Bearer';
        $token = auth('api')->login($user);
		$deviceno = $this->getDeviceno();
		if (!empty($deviceno)) {
		    $padPassword = new PadPassword();
			$padPassword->cancelToken($user['uid'], $deviceno);
		    $padPassword->setPadToken($token, $user['uid'], $deviceno);
		}
        $myinfo = $this->_userInfo($user);

        return compact('prefix', 'token', 'myinfo');
    }
}
