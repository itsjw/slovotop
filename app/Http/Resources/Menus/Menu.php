<?php

namespace App\Http\Resources\Menus;

use Illuminate\Http\Resources\Json\Resource;

class Menu extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'roles' => count($this->roles) > 0 ? $this->roles : [['access' => 0]],
        ];
    }
}
