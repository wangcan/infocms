<?php

/*
 * This file is part of the Jiannei/lumen-api-starter.
 *
 * (c) Jiannei <longjian.huang@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers;

use App\Repositories\Models\Log;
use Illuminate\Http\Request;
use Jiannei\Response\Laravel\Support\Facades\Response;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('enum:false');
        $this->middleware('throttle:10,1', ['only' => ['configurations']]);
    }

    public function configurations(Request $request)
    {
        return Response::success([
            'app' => config('app'),
            'auth' => config('auth'),
            'broadcasting' => config('broadcasting'),
            'cache' => config('cache'),
            'database' => config('database'),
            'filesystems' => config('filesystems'),
            'logging' => config('logging'),
            'queue' => config('queue'),
            'services' => config('services'),
        ]);
    }

    public function logs()
    {
        return Response::success(Log::all());
    }

    public function syncRoles(Request $request)
    {
        $this->validate($request, [
            'roles' => 'required|array',
        ]);

        $roles = $request->input('roles');

        $request->user()->syncRoles($roles);

        return Response::success($roles, '角色更新成功');
    }

    public function syncPermissions(Request $request)
    {
        $this->validate($request, [
            'permissions' => 'required|array',
        ]);

        $permissions = $request->input('permissions');
        $request->user()->syncPermissions($permissions);

        return Response::success($permissions, '权限更新成功');
    }
}
