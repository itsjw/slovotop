<?php

namespace App\Http\Resources\Settings;

use Illuminate\Http\Resources\Json\Resource;

class General extends Resource
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
            $this->name => $this->value,
        ];
    }
}
