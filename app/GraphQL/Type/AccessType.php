<?php
declare(strict_types=1);

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

/**
 * Class AccessType
 *
 * @package App\GraphQL\Type
 */
class AccessType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'AccessType',
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
                'description' => 'AccessType ID',
            ],
            'accessable_id'       => [
                'type'        => Type::int(),
                'description' => 'AccessType accessable_id',
            ],
            'accessable_type' => [
                'type'        => Type::string(),
                'description' => 'AccessType accessable_type',
            ],
            'role_id' => [
                'type'        => Type::int(),
                'description' => 'AccessType role_id',
            ],
            'name' => [
                'type'        => Type::string(),
                'description' => 'AccessType name',
            ],
            'access'      => [
                'type'        => Type::int(),
                'description' => 'AccessType access',
            ]
        ];
    }
}