<?php
declare(strict_types=1);

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

/**
 * Class TaskStatusType
 *
 * @package App\GraphQL\Type
 */
class TaskStatusType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'TaskStatusType',
        'description' => 'A type',
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id'     => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'TaskStatusType ID',
            ],
            'name'   => [
                'type'        => Type::string(),
                'description' => 'TaskStatusType name',
            ],
            'notify' => [
                'type'        => Type::string(),
                'description' => 'notify',
                'selectable'  => false,
            ],
        ];
    }
}