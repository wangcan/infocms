<?php

namespace App\Models;

use Larabase\Models\AbstractModel as AbstractModelBase;

class AbstractModel extends AbstractModelBase
{

    public function getSingleAttachment($field)
    {
        $attachment = \ResourceManager::getModel('attachment', 'infocms');
        $where = [
            'info_field' => $field,
            'info_id' => $this->id,
            'info_table' => $this->getTable(),
        ];
        $info = $attachment->where($where)->first();
        if (empty($info)) {
            return [];
        }
        return $info;
    }

    public function attachmentUrl($field)
    {
        $info = $this->getSingleAttachment($field);
        return empty($info) ? '' : $info->source_url;
    }

    public function getAttachments($field, $id)
    {
    }
}
