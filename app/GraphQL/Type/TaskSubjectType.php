<?php
declare(strict_types=1);

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

/**
 * Class TaskSubjectType
 *
 * @package App\GraphQL\Type
 */
class TaskSubjectType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'TaskSubjectType',
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
                'description' => 'TaskSubjectType ID',
            ],
            'name'       => [
                'type'        => Type::string(),
                'description' => 'TaskSubjectType name',
            ],
            'price'      => [
                'type'        => Type::string(),
                'description' => 'TaskSubjectType price',
            ],
            'created_at' => [
                'type'        => Type::string(),
                'description' => 'TaskSubjectType created_at',
            ],
            'updated_at' => [
                'type'        => Type::string(),
                'description' => 'TaskSubjectType updated_at',
            ],
        ];
    }
}