<?php

namespace App\Repositories\Infocms;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Infocms\Pet;
use App\Presenters\Infocms\PetPresenter;
use App\Validators\Infocms\PetValidator;

/**
 * Class PetRepository.
 *
 * @package namespace App\Repositories;
 */
class PetRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Pet::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PetValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return PetPresenter::class;
    }
}
