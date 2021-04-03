<?php

declare(strict_types = 1);

namespace Swoolecan\Baseapp\Repositories;

trait TraitSearchField
{
    public function getDealSearchFields($scene, $params)
    {
        $fields = $this->getSceneFields($scene . 'Search');
        $this->criteria = $this->criteria->make([]);

        $sortElem = $params['sort_elem'] ? json_decode($params['sort_elem'], true) : false;
        if (!empty($sortElem)) {
            $criteriaClass = '\Swoolecan\Baseapp\Criteria\SortCriteria';
            $this->pushCriteria(new $criteriaClass($sortElem));
        }

        if (empty($params) || empty($fields)) {
            return $this;
        }
        $defaultSearchFields = $this->getDefaultSearchDealFields();
        $showFields = $this->getSearchDealFields();
        $datas = [];
        //$this->criteria = [];
        foreach ($fields as $field) {
            $defaultSearchField = $defaultSearchFields[$field] ?? [];
            $showField = $showFields[$field] ?? [];
            $data = array_merge($defaultSearchField, $showField);
            if ((!isset($params[$field]) || $params[$field] === '') && !isset($data['value'])) {
                continue;
            }
            $data['field'] = $data['field'] ?? $field;
            $data['operator'] = $data['operator'] ?? '=';
            $data['value'] = isset($params[$field]) ? $params[$field] : $data['value'];
            //print_r($data);
            //$datas[$field] = $data;
            $type = $data['type'] ?? 'common';
            $type = ucfirst($type);

            $criteriaClass = "\Swoolecan\Baseapp\Criteria\\{$type}Criteria";
            $this->pushCriteria(new $criteriaClass($data));
            //$repository->pushCriteria($criteria);
        }

        return $this;
    }

    public function getDealSortFields($sortElem)
    {

        return $this;
    }

    public function getDefaultSearchDealFields()
    {
        return [
            'status' => ['type' => 'multiple'],
            'parent_code' => ['type' => 'multiple'],
            'user_id' => [],
            'name' => ['operator' => 'like'],
            'code' => ['operator' => 'like'],
            'region_code' => [],
            'created_at' => ['type' => 'between'],
            'updated_at' => ['type' => 'between'],
        ];
    }

    public function getSearchDealFields()
    {
        return [];
    }

    public function getFormatSearchFields($scene)
    {
        $fields = $this->getSceneFields($scene);
        $defaultSearchFields = $this->getDefaultSearchFields();
        $formFields = $this->getSearchFields();
        $fieldNames = $this->getAttributeNames($scene);
        $datas = [];
        foreach ($fields as $field) {
            $defaultSearchField = $defaultSearchFields[$field] ?? [];
            $formField = $formFields[$field] ?? [];
            $data = array_merge($defaultSearchField, $formField);
            $data = empty($data) ? ['type' => 'input'] : $data;
            if (in_array($data['type'], ['radio', 'select']) && !isset($data['infos'])) {
                $data['infos'] = $this->getKeyValues($field);
            }
            if ($data['type'] == 'selectSearch' && !isset($data['searchApp'])) {
                $data['searchApp'] = $this->config->get('app_code');
            }
            $data['options'] = $fieldNames[$field] ?? ['name' => $field];
            $datas[$field] = $data;
        }

        return $datas;
    }

    public function getDefaultSearchFields()
    {
        return [
            'nickname' => ['type' => 'input', 'require' => ['add']],
            'user_id' => ['type' => 'selectSearch', 'require' => ['add'], 'searchResource' => 'user', 'searchApp' => 'passport'],
            'status' => ['type' => 'select', 'multiple' => 1],
            'created_at' => ['type' => 'datetimerange'],
            'updated_at' => ['type' => 'datetimerange'],
            'area' => ['type' => 'cascader'],
        ];
    }

    public function getSearchFields()
    {
        return [];
    }
}
