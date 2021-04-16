<?php

namespace Yeelight\Base\Presenters;

use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class Presenter
 *
 * @category Yeelight
 *
 * @package Yeelight\Base\Presenters
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
abstract class Presenter extends FractalPresenter
{
    protected $meta = [];

    /**
     * Prepare data to present.
     *
     * @param Collection $data data
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function present($data)
    {
        if (!class_exists('League\Fractal\Manager')) {
            throw new \Exception(trans('repository::packages.league_fractal_required'));
        }

        if ($data instanceof Collection) {
            $this->resource = $this->transformCollection($data);
        } elseif ($data instanceof AbstractPaginator) {
            $this->resource = $this->transformPaginator($data);
        } else {
            $this->resource = $this->transformItem($data);
        }

        // set meta
        $this->resource->setMeta($this->meta);

        return $this->fractal->createData($this->resource)->toArray();
    }

    /**
     * Set Meta
     *
     * @param array $meta meta
     *
     * @return mixed
     */
    public function setMeta(array $meta)
    {
        $this->meta = $meta;
    }
}
<?php

namespace Larabase\Presenters;

use Yeelight\Transformers\BasicTransformer;

/**
 * Class BasicPresenter
 *
 * @category Yeelight
 *
 * @package Yeelight\Presenters
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class BasicPresenter extends BasePresenter
{
    /**
     * @var string
     */
    protected $transformer = null;

    /**
     * @param string $transformer
     */
    public function setTransformer(string $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * Transformer.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        if ($this->transformer) {
            return new $this->transformer();
        } else {
            return new BasicTransformer();
        }
    }
//use Yeelight\Transformers\AdminMenuTransformer;
    public function getTransformer()
    {
        return new AdminMenuTransformer();
    }
}
<?php
namespace Prettus\Repository\Presenter;

use Exception;
use Prettus\Repository\Transformer\ModelTransformer;

/**
 * Class ModelFractalPresenter
 * @package Prettus\Repository\Presenter
 */
class ModelFractalPresenter extends FractalPresenter
{

    /**
     * Transformer
     *
     * @return ModelTransformer
     * @throws Exception
     */
    public function getTransformer()
    {
        if (!class_exists('League\Fractal\Manager')) {
            throw new Exception("Package required. Please install: 'composer require league/fractal' (0.12.*)");
        }

        return new ModelTransformer();
    }
}
