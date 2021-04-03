<?php

namespace Yeelight\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard(config('yeelight.backend.route.prefix'))->guest() && !$this->shouldPassThrough($request)) {
            return redirect()->guest(backend_base_path('auth/login'));
        }

        return $next($request);
    }

    /**
     * Determine if the request has a URI that should pass through verification.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function shouldPassThrough($request)
    {
        $excepts = [
            backend_base_path('auth/login'),
            backend_base_path('auth/logout'),
        ];

        foreach ($excepts as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->is($except)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate($request, array $guards)
    {
		$inSale = env('INSALETMP', false);
		if (false) {//$inSale) {
			return $this->saleTmpauth($request);
		}
        $testUser = $request->input('test_user');
        $testSorts = [
            'new' => 629380, 
            'simple' => 629221, 
            'common' => 629228, 
            'vip' => 629239
        ];
        if (!env('INTEST') || !in_array($testUser, array_keys($testSorts))) {
            return parent::authenticate($request, $guards);
        }

        $userModel = new User();
        $user = $userModel->query()->where('uid', $testSorts[$testUser])->first();
        foreach ($guards as $guard) {
            $guardModel = $this->auth->guard($guard);
            $r = $guardModel->setUser($user);
            return $this->auth->shouldUse($guard);
        }

        $this->unauthenticated($request, $guards);
    }

	public function saleTmpauth($request)
	{
		$guards = ['api'];
		$sessionId = isset($_COOKIE['PHPSESSID']) ? $_COOKIE['PHPSESSID'] : false;
		if (empty($sessionId)) {
            return parent::authenticate($request, $guards);
		}
		$sPath = env('TPSESSION_PATH', '');
		$file = $sPath . '/sess_' . $sessionId;
		if (!file_exists($file)) {
            return parent::authenticate($request, $guards);
		}
		//$content = file_get_contents($file);
		//$data = unserialize(substr($content, 6));
		$uid = 629226;//isset($data['admin']) ? $data['admin']['uid'] : 0;
		$uid = isset($data['admin']) ? $data['admin']['uid'] : 0;
		if (empty($uid)) {
            return parent::authenticate($request, $guards);
		}

        $userModel = new User();
        $user = $userModel->query()->where('uid', $uid)->first();
        foreach ($guards as $guard) {
            $guardModel = $this->auth->guard($guard);
            $r = $guardModel->setUser($user);
            return $this->auth->shouldUse($guard);
        }
        $this->unauthenticated($request, $guards);
	}
}
