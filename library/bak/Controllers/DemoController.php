<?php
declare(strict_types = 1);

namespace Swoolecan\Baseapp\Controllers;

use App\Http\Resource\UserCollection;
use App\Http\Resource\UserResource;
use App\Service\UserService;
use Illuminate\Http\Request;

class DemoController extends AbstractController
{
    /**
     * @var UserService
     */
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;

        $this->middleware('auth:api', ['except' => ['store', 'show', 'index']]);
    }

    public function index()
    {
        $resource = $this->service->getUserList();

        return $this->response->success(new UserCollection($resource), '成功');
    }

    public function show($id)
    {
        $user = $this->service->getUserById($id);

        return $this->response->success(new UserResource($user), '成功');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     *
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = $this->service->register($request);

        return $this->response->created(new UserResource($user));
    }
}
