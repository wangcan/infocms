<?php

namespace Larabase\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

use Prettus\Repository\Criteria\RequestCriteria;
//use App\Repositories\Enums\PermissionEnum;
//use App\Repositories\Models\Post;
//use App\Repositories\Presenters\PostPresenter;
//use Illuminate\Support\Arr;
//use Spatie\Permission\Exceptions\UnauthorizedException;

/**
 * Class AbstractRepository
 *
 * @category Larabase
 * @package Larabase\Repositories
 * @license https://opensource.org/licenses/MIT MIT
 */
abstract class AbstractRepository extends BaseRepository
{
    public function __construct()
    {
        $app = app();
        parent::__construct($app);
    }

    public function model()
    {
        return null;
    }

    /*public function presenter()
    {
        return PostPresenter::class;
    }*/

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /*public function checkPermission()
    {
        $authUser = auth('api')->user();

        // 登录用户是否有 Posts 数据表操作权限
        $permission = PermissionEnum::DATA_POSTS()->name;
        if (! $authUser->can($permission)) {
            throw UnauthorizedException::forPermissions(Arr::wrap($permission));
        }
    }*/

    public function searchPage()
    {
        // 使用预加载，避免 N+1
        $posts = $this->model->with('author')->published()->paginate(10);

        return $this->parserResult($posts);
    }
}
