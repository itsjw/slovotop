<?php
declare(strict_types=1);

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

/**
 * Class AccessMenuType
 *
 * @package App\GraphQL\Type
 */
class AccessMenuType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'AccessMenuType',
        'description' => 'A type',
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id'         => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'AccessMenuType ID',
            ],
            'menu_id'       => [
                'type'        => Type::int(),
                'description' => 'AccessMenuType menu_id',
            ],
            'access'       => [
                'type'        => Type::int(),
                'description' => 'AccessMenuType access',
            ],
            'role_id'       => [
                'type'        => Type::int(),
                'description' => 'AccessMenuType role_id',
            ],
            'created_at' => [
                'type'        => Type::string(),
                'description' => 'AccessMenuType created_at',
            ],
            'updated_at' => [
                'type'        => Type::string(),
                'description' => 'AccessMenuType updated_at',
            ],
        ];
    }
}