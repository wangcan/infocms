<?php 

namespace Larabase\Criteria;

class MultipleCriteria extends AbstractCriteria
{
    public function _pointApply($query, $repository)
    {
        $field = $this->getField();
        if (empty($field)) {
            return $query;
        }
        $operator = $this->params['operator'];
        $mark = $this->params['mark'] ?? ',';
        $values = array_filter(explode($mark, $this->params['value']));
        foreach ($values as $value) {
            $query->orWhere($field, $operator, $value);
        }

        return $query;
    }
}
