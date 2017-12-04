<?php
declare(strict_types=1);

namespace App\Http\Resources\Projects;

use App\Http\Resources\Users\UserLittle;
use Illuminate\Http\Resources\Json\Resource;

class ProjectLittle extends Resource
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
