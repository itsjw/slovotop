<?php
declare(strict_types=1);

namespace App\GraphQL\Type;

use App\Models\StageTaskAccess;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

/**
 * Class StageTaskAccessType
 *
 * @package App\GraphQL\Type
 */
class StageTaskAccessType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'StageTaskAccessType',
        'description' => 'A type',
        'model'       => StageTaskAccess::class,
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id'         => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'StageTaskAccessType ID',
            ],
            'stage'      => [
                'type'        => \GraphQL::type('TaskStageType'),
                'description' => 'StageTaskAccessType stage',
            ],
            'field'      => [
                'type'        => Type::string(),
                'description' => 'StageTaskAccessType field',
            ],
            'access'     => [
                'type'        => Type::int(),
                'description' => 'StageTaskAccessType access',
            ],
            'created_at' => [
                'type'        => Type::string(),
                'description' => 'StageTaskAccessType created_at',
            ],
            'updated_at' => [
                'type'        => Type::string(),
                'description' => 'StageTaskAccessType updated_at',
            ],
            'notify'     => [
                'type'        => Type::string(),
                'description' => 'notify',
                'selectable'  => false,
            ],
        ];
    }
}