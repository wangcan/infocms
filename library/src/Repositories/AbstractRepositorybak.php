<?php

namespace Larabase\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Larabase\Presenters\AbstractPresenter;

/**
 * Class AbstractRepository
 *
 * @category Larabase
 * @package Larabase\Repositories
 * @license https://opensource.org/licenses/MIT MIT
 */
abstract class AbstractRepositorybak extends BaseRepository
{
    /**
     * Is Searchable Force And Where
     *
     * @var bool
     */
    protected $isSearchableForceAndWhere = false;

    /**
     * Relate Model
     *
     * @var Model
     */
    protected $relateModel;

    /**
     * Relation
     *
     * @var Relation
     */
    protected $relation;
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

    /**
     * Get auth UserId
     *
     * @return mixed
     */
    public function authUserId()
    {
        return current_auth_user()->user_id;
    }

    /**
     * Validate Creater
     *
     * @param array $attributes attributes
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     *
     * @return mixed
     */
    public function validateCreate(array $attributes)
    {
        if (!is_null($this->validator)) {
            $this->validator->with($attributes)
                ->passesOrFail(ValidatorInterface::RULE_CREATE);
        }
    }

    /**
     * Validate Updater
     *
     * @param array $attributes attributes
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     *
     * @return mixed
     */
    public function validateUpdate(array $attributes)
    {
        if (!is_null($this->validator)) {
            $this->validator->with($attributes)
                ->passesOrFail(ValidatorInterface::RULE_UPDATE);
        }
    }

    /**
     * SetValidator
     *
     * @param ValidatorInterface $validator validator
     *
     * @return $this
     */
    public function setValidator($validator)
    {
        $this->validator = $validator;

        return $this;
    }

    /**
     * Present
     *
     * @param Object $results results
     *
     * @return mixed
     */
    public function present($results)
    {
        return $this->parserResult($results);
    }

    /**
     * SetRelateModel
     *
     * @param Model $relateModel relateModel
     *
     * @return $this
     * @throws RepositoryException
     */
    public function setRelateModel(Model $relateModel)
    {
        $this->relateModel = $relateModel;
        if ($relateModel) {
            $this->makeModel();
        }

        return $this;
    }

    /**
     * Relation
     *
     * @return \Prettus\Repository\Contracts\PresenterInterface
     */
    public function relation()
    {
    }

    /**
     * MakeModel
     *
     * @return Model|Relation|mixed|void
     * @throws RepositoryException
     */
    public function makeModel()
    {
        $model = $this->relateModel ? $this->relation() : $this->app->make($this->model());

        if (!($model instanceof Model || $model instanceof Relation)) {
            throw new RepositoryException('Class '.get_class($model).' must be an instance of Illuminate\\Database\\Eloquent\\Model');
        }

        return $this->model = $model;
    }

    /**
     * Retrieve data array for populate field select.
     *
     * @param string $column $column
     * @param string|null $key $key
     *
     * @return \Illuminate\Support\Collection|array
     * @throws RepositoryException
     */
    public function lists($column, $key = null)
    {
        $this->applyCriteria();
        $this->applyScope();

        $lists = $this->model->lists($column, $key);

        $this->resetModel();

        return $lists;
    }

    /**
     * Retrieve all data of repository.
     *
     * @param array $columns columns
     *
     * @return mixed
     * @throws RepositoryException
     */
    public function all($columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();

        if ($this->model instanceof \Illuminate\Database\Eloquent\Builder
            || $this->model instanceof \Illuminate\Database\Eloquent\Relations\Relation
        ) {
            $results = $this->model->get($columns);
        } else {
            $results = $this->model->all($columns);
        }

        $this->resetModel();

        return $this->parserResult($results);
    }

    /**
     * Add a basic where clause to the model.
     *
     * @param string|array|\Closure $column $column
     * @param mixed $value $value
     *
     * @return $this
     */
    protected function modelWhere($column, $value = null)
    {
        $this->model = $this->model->where($column, $value);

        return $this;
    }

    /**
     * SetPresenterMeta
     *
     * @param array $meta $meta
     *
     * @return mixed
     */
    public function setPresenterMeta(array $meta)
    {
        if ($this->presenter instanceof AbstractPresenter) {
            $this->presenter->setMeta($meta);
        }
    }

    /**
     * GetIsSearchableForceAndWhere
     *
     * @return bool
     */
    public function getIsSearchableForceAndWhere()
    {
        return $this->isSearchableForceAndWhere;
    }

    /**
     * Find data by where conditions.
     *
     * @param array $where $where
     *
     * @return $this
     */
    public function where(array $where)
    {
        $this->applyCriteria();
        $this->applyScope();

        $this->applyConditions($where);

        return $this;
    }

    /**
     * Retrieve first data of repository with fail if not found.
     *
     * @param array $columns columns
     *
     * @return mixed
     * @throws RepositoryException
     */
    public function firstOrFail($columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();

        $results = $this->model->firstOrFail($columns);

        $this->resetModel();

        return $this->parserResult($results);
    }

    /**
     * Where first.
     *
     * @param array $where where
     * @param array $columns columns
     *
     * @return mixed
     * @throws RepositoryException
     */
    public function whereFirst(array $where, $columns = ['*'])
    {
        return $this->where($where)->firstOrFail($columns = ['*']);
    }
}
