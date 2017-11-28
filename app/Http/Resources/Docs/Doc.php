<?php

namespace App\Http\Resources\Docs;

use App\Http\Resources\Users\UserLittle;
use Illuminate\Http\Resources\Json\Resource;

class Doc extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'body'       => $this->body,
            'user'       => new UserLittle($this->user),
            'created_at' => $this->created_at->format('d-m-Y H:m:s'),
            'updated_at' => $this->updated_at->format('d-m-Y H:m:s'),
        ];
    }
}
