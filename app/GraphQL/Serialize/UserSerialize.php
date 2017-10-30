<?php
declare(strict_types=1);

namespace App\GraphQL\Serialize;

use App\Models\User;

/**
 * Class UserSerialize
 *
 * @package App\GraphQL\Serialize
 */
class UserSerialize extends Serialize
{
    /**
     * @param User $user
     *
     * @return array
     */
    public function toArray($user): array
    {
        return [
            'id'         => $user->id,
            'name'       => $user->name,
            'surname'    => $user->surname,
            'email'      => $user->email,
            'confirm'    => $user->confirm,
            'roles'      => UserRolesSerialize::collection($user->roles),
            'created_at' => $user->created_at->format('d-m-Y H:m:s'),
            'updated_at' => $user->updated_at->format('d-m-Y H:m:s'),
        ];
    }
}