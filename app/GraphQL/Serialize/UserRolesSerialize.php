<?php
declare(strict_types=1);

namespace App\GraphQL\Serialize;

use App\Models\UserRole;

/**
 * Class UserRolesSerialize
 *
 * @package App\GraphQL\Serialize
 */
class UserRolesSerialize extends Serialize
{
    /**
     * @param UserRole $userRole
     *
     * @return array
     */
    public function toArray($userRole): array
    {
        return [
            'id'         => $userRole->id,
            'user'       => $userRole->user,
            'role'       => RoleSerialize::serialize($userRole->role),
            'created_at' => $userRole->created_at->format('d-m-Y H:m:s'),
            'updated_at' => $userRole->updated_at->format('d-m-Y H:m:s'),
        ];
    }
}