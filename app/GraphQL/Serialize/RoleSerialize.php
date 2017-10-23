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
     * @param Role $user
     *
     * @return array
     */
    public function toArray($user): array
    {
        return [
            'id'         => $user->id,
            'name'       => $user->name,
            'created_at' => $user->created_at->format('d-m-Y H:m:s'),
            'updated_at' => $user->updated_at->format('d-m-Y H:m:s'),
        ];
    }
}