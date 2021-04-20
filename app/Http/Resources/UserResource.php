<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

		//$avatars = $this->resource->getAvatar();

        return [
            'name' => $this->name,
            'id' => $this->id,
            //'sex' => $this->sex,
//            'avatar' => isset($avatars['avatar_big']) ? $avatars['avatar_big'] : 'http://test.liupinshuyuan.com/data/upload/avatar/77/f9/45/original_100_100.jpg?v1590540483.1439',
            //'avatar' => isset($avatars) ? $avatars : config('imageUrl.attach_url').'addons/theme/stv1/_static/images/noavatar/middle.jpg',
        ];

    }

}
