<?php
declare(strict_types=1);

namespace App\GraphQL\Type;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

/**
 * Class UserType
 *
 * @package App\GraphQL\Type
 */
class UserType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'UserType',
        'description' => 'A User type',
        'model'       => User::class,
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id'         => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'User ID',
            ],
            'name'       => [
                'type'        => Type::string(),
                'description' => 'User name',
            ],
            'email'      => [
                'type'        => Type::string(),
                'description' => 'User email',
            ],
            'up_price'      => [
                'type'        => Type::float(),
                'description' => 'User up_price',
            ],
            'note'      => [
                'type'        => Type::string(),
                'description' => 'User note',
            ],
            'confirm'    => [
                'type'        => Type::string(),
                'description' => 'User confirm',
            ],
            'created_at' => [
                'type'        => Type::string(),
                'description' => 'User created_at',
            ],
            'updated_at' => [
                'type'        => Type::string(),
                'description' => 'User updated_at',
            ],
            'roles'      => [
                'type'        => Type::listOf(\GraphQL::type('UserRoleType')),
                'description' => 'User role',
            ],
            'tasksCount' => [
                'type'        => Type::int(),
                'description' => 'User tasksCount',
            ],
            'lastLogin' => [
                'type'        => Type::string(),
                'description' => 'User lastLogin',
            ],
        ];
    }
}