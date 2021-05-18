<?php

namespace Larabase\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Presenter\ModelFractalPresenter;

/**
 * Class AbstractModel
 *
 * @category Larabase
 * @package Larabase\Models
 * @license https://opensource.org/licenses/MIT MIT
 * @mixin \Eloquent
 */
class AbstractModel extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * Set Model Presenter.
     *
     * @return $this
     * @throws \Exception
     */
    public function setModelPresenter()
    {
        $this->setPresenter(new ModelFractalPresenter());

        return $this;
    }

    /**
     * Set a given attribute on the model.
     *
     * @param string $key The Attribute Name
     * @param mixed $value The Attribute Value
     *
     * @return $this
     */
    public function setAttribute($key, $value)
    {
        if ($this->timestampAlwaysUtc) {
            // set to UTC only if Carbon
            if ($value instanceof Carbon) {
                $value->setTimezone('UTC');
            }
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Get a plain attribute (not a relationship).
     *
     * @param string $key The Attribute Name
     *
     * @return mixed
     */
    public function getAttributeValue($key)
    {
        $value = parent::getAttributeValue($key);

        if ($value instanceof Carbon && $this->getWithUserTimezone) {
            $value->setTimezone($this->getAuthUserDateTimezone());
        }

        return $value;
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param \DateTimeInterface $date DateTime Interface
     *
     * @return string
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        if ($date instanceof Carbon && $this->getWithUserTimezone) {
            $date->setTimezone($this->getAuthUserDateTimezone());
        }

        return $date->format($this->getDateFormat());
    }

    public function getPreInfo($params)
    {
        $params['orderBy'] = ['id' => 'desc'];
        return $this->_relateDatas(1, $params);
    }

    public function getNextInfo($params)
    {
        $params['orderBy'] = ['id' => 'asc'];
        return $this->_relateDatas(1, $params);
    }

    public function getRelateDatas($num, $params)
    {
        return $this->_relateDatas($num, $params);
    }

    public function _relateDatas($num, $params)
    {
        $where = $params['where'] ?? [];
        $oderBy = $params['orderBy'] ?? ['id' => 'desc'];
        $select = $params['select'] ?? 'id,name,description,created_at';
        $datas = $this->query()->where($where)->orderBy($orderBy)->limit($num)->get();
        return $datas;
    }

    /**
     * Get ID from the model primary key.
     *
     * @return mixed
     */
    /*public function getIdAttribute()
    {
        return $this->attributes[$this->getKeyName()];
    }*/
}
