<?php
declare(strict_types=1);

namespace App\GraphQL\Serialize;

use App\Models\Role;

/**
 * Class RoleSerialize
 *
 * @package App\GraphQL\Serialize
 */
class RoleSerialize extends Serialize
{
    /**
     * @param Role $role
     *
     * @return array
     */
    public function toArray($role): array
    {
        return [
            'id'         => $role->id,
            'name'       => $role->name,
            'count'      => $role->users->count(),
            'accessMenu' => $role->accessMenu,
            'created_at' => $role->created_at->format('d-m-Y H:m:s'),
            'updated_at' => $role->updated_at->format('d-m-Y H:m:s'),
        ];
    }
}