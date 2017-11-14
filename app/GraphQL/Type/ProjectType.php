<?php
declare(strict_types=1);

namespace App\GraphQL\Type;

use App\Models\Project;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

/**
 * Class ProjectType
 *
 * @package App\GraphQL\Type
 */
class ProjectType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'ProjectType',
        'description' => 'A type',
        'model'       => Project::class,
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id'         => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'ProjectType ID',
            ],
            'name'       => [
                'type'        => Type::string(),
                'description' => 'ProjectType name',
            ],
            'site'       => [
                'type'        => Type::string(),
                'description' => 'ProjectType site',
            ],
            'user'       => [
                'type'        => \GraphQL::type('UserType'),
                'description' => 'ProjectType user',
            ],
            'created_at' => [
                'type'        => Type::string(),
                'description' => 'ProjectType created_at',
            ],
            'updated_at' => [
                'type'        => Type::string(),
                'description' => 'ProjectType updated_at',
            ],
            'notify'     => [
                'type'        => Type::string(),
                'description' => 'notify',
                'selectable'  => false,
            ],
        ];
    }
}