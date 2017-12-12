<?php

namespace App\Http\Resources\Steps;

use Illuminate\Http\Resources\Json\Resource;

class Step extends Resource
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
            'task'  => $this->task,
            'state' => $this->state,
            'stage' => $this->stage,
            'user'  => $this->user,
        ];
    }
}
