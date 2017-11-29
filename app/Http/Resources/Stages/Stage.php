<?php

namespace App\Http\Resources\Stages;

use Illuminate\Http\Resources\Json\Resource;

class Stage extends Resource
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
            'id'         => $this->id,
            'name'       => $this->name,
            'priority'   => $this->priority,
            'price'      => $this->price,
            'roles'      => count($this->roles) > 0 ? $this->roles : [['access' => 0]],
        ];
    }
}
