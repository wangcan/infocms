<?php

namespace App\Models;

use Larabase\Models\AbstractModel as AbstractModelBase;

class AbstractModel extends AbstractModelBase
{

    public function formatContent()
    {
        $content = $this->getOriginal('content');
        $domain = config('app.uploadUrl');
        $content = str_replace('src="upload', 'src="' . $domain . 'upload', $content);
        return $content;
    }

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

    public function pointAttachmentUrl($field)
    {
        $info = $this->getSingleAttachment($field);
        return empty($info) ? '' : $info->url;
    }

    public function getMulAttachment($field)
    {
        $attachment = \ResourceManager::getModel('attachment', 'infocms');
        $where = [
            'info_field' => $field,
            'info_id' => $this->id,
            'info_table' => $this->getTable(),
        ];
        $infos = $attachment->where($where)->get();
        if (empty($info)) {
            return [];
        }
        return $infos;
    }
}
