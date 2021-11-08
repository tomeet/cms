<?php

namespace Tomeet\Cms\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleAnnexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'filename'=> $this->filename,
            'filepath'=> $this->filepath,
            'extension'=> $this->extension,
            'mine_type'=> $this->mine_type,
            'size'=> $this->size,
        ];
    }
}
