<?php

namespace App\GraphQL\Type;

use App\Models\UserRole;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserRoleType extends GraphQLType
{
    protected $attributes = [
        'name'        => 'UserRoleType',
        'description' => 'A type',
        'model'       => UserRole::class,
    ];

    public function fields()
    {
        return [
            'id'   => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'UserRoleType ID',
            ],
            'user' => [
                'type'        => \GraphQL::type('UserType'),
                'description' => 'UserRoleType user',
            ],
            'role' => [
                'type'        => \GraphQL::type('RoleType'),
                'description' => 'UserRoleType role',
            ],
        ];
    }
}