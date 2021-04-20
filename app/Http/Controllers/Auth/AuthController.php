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
        $this->middleware('auth:api', ['except' => ['login', 'qrcode', 'qrscan', 'logout']]);
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
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * @api {post} /auth/token/new 刷新token(refresh token)
     * @apiDescription 刷新token(refresh token)
     * @apiGroup Auth
     * @apiPermission JWT
     * @apiVersion 1.0.0
     * @apiHeader {String} Authorization 用户旧的jwt-token, value以Bearer开头
     * @apiHeaderExample {json} Header-Example:
     *     {
     *       "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL21vYmlsZS5kZWZhcmEuY29tXC9hdXRoXC90b2tlbiIsImlhdCI6IjE0NDU0MjY0MTAiLCJleHAiOiIxNDQ1NjQyNDIxIiwibmJmIjoiMTQ0NTQyNjQyMSIsImp0aSI6Ijk3OTRjMTljYTk1NTdkNDQyYzBiMzk0ZjI2N2QzMTMxIn0.9UPMTxo3_PudxTWldsf4ag0PHq1rK8yO9e5vqdwRZLY"
     *     }
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         token: 9UPMTxo3_PudxTWldsf4ag0PHq1rK8yO9e5vqdwRZLY.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL21vYmlsZS5kZWZhcmEuY29tXC9hdXRoXC90b2tlbiIsImlhdCI6IjE0NDU0MjY0MTAiLCJleHAiOiIxNDQ1NjQyNDIxIiwibmJmIjoiMTQ0NTQyNjQyMSIsImp0aSI6Ijk3OTRjMTljYTk1NTdkNDQyYzBiMzk0ZjI2N2QzMTMxIn0.eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9
     *     }
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "message": "token无效",
     *       "status_code": 400
     *     }
     */
    public function refreshToken()
    {
        try {
            $token = JWTAuth::parseToken()->refresh();
        } catch (TokenExpiredException $e) {
            return $this->response->error('token已过期', $e->getStatusCode());
        } catch (JWTException $e) {
            return $this->response->error('token无效', $e->getStatusCode());
        }

        return $this->response->array(compact('token'));
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
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
