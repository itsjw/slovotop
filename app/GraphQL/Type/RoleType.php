<?php
declare(strict_types=1);

namespace App\GraphQL\Type;

use App\Models\Role;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

/**
 * Class RoleType
 *
 * @package App\GraphQL\Type
 */
class RoleType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'RoleType',
        'description' => 'A type',
        'model'       => Role::class,
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id'         => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'RoleType ID',
            ],
            'name'       => [
                'type'        => Type::string(),
                'description' => 'RoleType name',
            ],
            'created_at' => [
                'type'        => Type::string(),
                'description' => 'RoleType created_at',
            ],
            'updated_at' => [
                'type'        => Type::string(),
                'description' => 'RoleType updated_at',
            ],
            'count'      => [
                'type'        => Type::int(),
                'description' => 'RoleType count users',
            ],
            'notify'     => [
                'type'        => Type::string(),
                'description' => 'notify',
                'selectable'  => false,
            ],
        ];
    }
}