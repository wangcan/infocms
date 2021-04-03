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

use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Jiannei\Response\Laravel\Support\Facades\Response;

class UsersController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

        $this->middleware('auth:api', ['except' => ['store', 'show']]);
    }

    public function index(Request $request)
    {
        $users = $this->userService->handleSearchList($request);

        return Response::success($users);
    }

    public function simple(Request $request)
    {
        $users = $this->userService->handleSearchSimpleList($request);

        return Response::success($users);
    }

    public function cursor(Request $request)
    {
        $this->validate($request, [
            'cursor' => 'sometimes|integer',
            'prev' => 'sometimes|integer',
        ]);

        $users = $this->userService->handleSearchCursorList($request);

        return Response::success($users);
    }

    public function show($id)
    {
        $user = $this->userService->handleSearchItem($id);

        return Response::success($user);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = $this->userService->handleCreateItem($request);

        return Response::created(new UserResource($user));
    }
}
