<?php
declare(strict_types=1);

namespace App\GraphQL\Type;

use App\Models\Doc;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

/**
 * Class DocType
 *
 * @package App\GraphQL\Type
 */
class DocType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'DocType',
        'description' => 'A type',
        'model'       => Doc::class,
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id'         => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'DocType ID',
            ],
            'name'       => [
                'type'        => Type::string(),
                'description' => 'DocType name',
            ],
            'body'       => [
                'type'        => Type::string(),
                'description' => 'DocType body',
            ],
            'user'       => [
                'type'        => \GraphQL::type('UserType'),
                'description' => 'DocType users',
            ],
            'roles'      => [
                'type'        => Type::listOf(\GraphQL::type('AccessType')),
                'description' => 'DocType roles',
            ],
            'created_at' => [
                'type'        => Type::string(),
                'description' => 'DocType created_at',
            ],
            'updated_at' => [
                'type'        => Type::string(),
                'description' => 'DocType updated_at',
            ],
        ];
    }
}