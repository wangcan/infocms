<?php namespace Prettus\Repository\Transformer;

namespace Larabase\Transformers;
use League\Fractal\TransformerAbstract;
//use Prettus\Repository\Contracts\Transformable;

/**
 * Class ModelTransformer // package Prettus\Repository\Transformer
 *
 * @category Larabase
 * @package Larabase\Transformers
 * @license https://opensource.org/licenses/MIT MIT
 */
class AbstractTransformer extends TransformerAbstract
{
    public function transform(Transformable $model)
    {
        return $model->transform();
    }
}

namespace Yeelight\Transformers;

use Yeelight\Base\Models\BaseModel;
use Yeelight\Base\Transformers\Transformer;

/**
 * Class BaseTransformer
 *
 * @category Yeelight
 *
 * @package Yeelight\Transformers
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class BaseTransformer extends Transformer
{
    /**
     * Include User.
     *
     * @param BaseModel $model
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(BaseModel $model)
    {
        $user = $model->user;
        if ($user) {
            return $this->item($user, new UserTransformer(), 'user');
        }
    }

    /**
     * Include User.
     *
     * @param BaseModel $model
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeAuthUser(BaseModel $model)
    {
        $user = auth_user();
        if ($user) {
            return $this->item($user, new UserTransformer());
        }
    }
}
<?php

namespace App\Transformers;

use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;

class BaseTransformer extends TransformerAbstract
{
    public function transform(Model $object)
    {
        return $object->attributesToArray();
    }
}
