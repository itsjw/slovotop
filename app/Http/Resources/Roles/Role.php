<?php
declare(strict_types=1);

namespace App\Http\Resources\Roles;

use Illuminate\Http\Resources\Json\Resource;

/**
 * Class Role
 * @package App\Http\Resources\Roles
 */
class Role extends Resource
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
            'id'   => $this->id,
            'name' => $this->name,
        ];
    }
}
