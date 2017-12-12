<?php
declare(strict_types=1);

namespace App\Http\Resources\Stages;

use Illuminate\Http\Resources\Json\Resource;

/**
 * Class Stage
 * @package App\Http\Resources\Stages
 */
class Stage extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'priority' => $this->priority,
            'price'    => $this->price,
            'time'     => $this->time,
            'roles'    => \count($this->roles) > 0 ? $this->roles : [['access' => 0]],
        ];
    }
}
