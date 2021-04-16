<?php

namespace Yeelight\Repositories\Eloquent;

use Yeelight\Base\Repositories\Eloquent\Repository;
use Yeelight\Repositories\Interfaces\BaseRepositoryInterface;

/**
 * Class BaseRepository
 *
 * @category Yeelight
 *
 * @package Yeelight\Repositories\Eloquent
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
abstract class BaseRepository extends Repository implements BaseRepositoryInterface
{
    /**
     * Delete multiple entities by $ids.
     *
     * @param array $ids
     *
     * @return int
     */
    public function deleteIn(array $ids)
    {
        $deleted = false;
        if (!empty($ids)) {
            foreach ($ids as $id) {
                $deleted = $this->delete($id);
            }
        }

        return $deleted;
    }

    /**
     * Chunk the results of the query.
     *
     * @param callable $callback
     * @param int      $count
     *
     * @return bool
     */
    public function chunk(callable $callback, $count = 100)
    {
        $this->applyCriteria();
        $this->applyScope();

        $temporarySkipPresenter = $this->skipPresenter;

        $this->skipPresenter(true);

        $lists = $this->model->chunk($count, $callback);

        $this->skipPresenter($temporarySkipPresenter);

        $this->resetModel();

        return $lists;
    }
}
<?php

/*
 * This file is part of the Jiannei/lumen-api-starter.
 *
 * (c) Jiannei <longjian.huang@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Repositories\Eloquent;

use App\Repositories\Presenters\Presenter;
use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Eloquent\BaseRepository as BaseRepositoryEloquent;

abstract class BaseRepository extends BaseRepositoryEloquent
{
    /**
     * @var Presenter
     */
    protected $presenter;

    /**
     * Retrieve all data of repository, simple paginated.
     *
     * @param  null|int  $limit
     * @param  array  $columns
     *
     * @return mixed
     */
    public function cursorPaginate($limit = null, $columns = ['*'])
    {
        return $this->paginate($limit, $columns, 'cursor');
    }

    /**
     * Retrieve all data of repository, paginated.
     *
     * @param  null|int  $limit
     * @param  array  $columns
     * @param  string  $method
     *
     * @return mixed
     */
    public function paginate($limit = null, $columns = ['*'], $method = 'paginate')
    {
        $this->applyCriteria();
        $this->applyScope();

        $limit = is_null($limit) ? config('repository.pagination.limit', 15) : (int) $limit;

        if ($method === 'cursor') {
            $results = $this->model->select($columns)->limit($limit)->get();

            if ($this->model instanceof Builder) {
                $primaryKey = $this->model->getModel()->getKeyName();
            } else {
                $primaryKey = $this->model->getKeyName();
            }

            $count = $results->count();
            $next = $count === $limit ? optional($results->last())->{$primaryKey} : null;

            $prev = request('prev');
            $this->presenter->makeCursor((int) request('cursor'), $prev ? (int) $prev : null, $next, $count);
        } else {
            $results = $this->model->{$method}($limit, $columns);
            $results->appends(app('request')->query());
        }

        $this->resetModel();

        return $this->parserResult($results);
    }
}
