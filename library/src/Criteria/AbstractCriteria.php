<?php

namespace Bosnadev\Repositories\Criteria;

use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;
use Illuminate\Database\Eloquent\Builder;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

abstract class Criteria {

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public abstract function apply($model, Repository $repository);

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('user_id', '=', current_auth_user()->user_id);

        return $model;
    }

    public function __construct(SocialiteAuthRequest $request)
    {
        $this->request = $request;
    }

    public function apply1($model, RepositoryInterface $repository)
    {
        if ($this->request->email) {
            $model = $model
                ->where('email', '=', $this->request->email)
                ->orWhere('email', '=', $this->request->username)
                ->orWhere('username', '=', $this->request->username);
        } else {
            $model = $model
                ->where('username', '=', $this->request->username)
                ->orWhere('email', '=', $this->request->username);
        }

        return $model;
        $model = $model
            ->where('provider', '=', $this->request->provider)
            ->where('provider_user_id', '=', $this->request->provider_user_id);

        return $model;

        if ($name = $this->request->get('name')) {
            $query->where('name', '=', $name);
        }

        if ($email = $this->request->get('email')) {
            $query->where('email', 'like', "%$email%");
        }
    }
}
