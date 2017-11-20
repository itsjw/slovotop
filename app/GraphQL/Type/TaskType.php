<?php
declare(strict_types=1);

namespace App\GraphQL\Type;

use App\Models\Task;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

/**
 * Class TaskType
 *
 * @package App\GraphQL\Type
 */
class TaskType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'TaskType',
        'description' => 'A type',
        'model'       => Task::class,
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id'         => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'TaskType ID',
            ],
            'name'       => [
                'type'        => Type::string(),
                'description' => 'TaskType name',
            ],
            'user'       => [
                'type'        => \GraphQL::type('UserType'),
                'description' => 'TaskType user',
            ],
            'project'    => [
                'type'        => \GraphQL::type('ProjectType'),
                'description' => 'TaskType project',
            ],
            'status'     => [
                'type'        => \GraphQL::type('TaskStatusType'),
                'description' => 'TaskType status',
            ],
            'stage'      => [
                'type'        => \GraphQL::type('TaskStageType'),
                'description' => 'TaskType stage',
            ],
            'editor'     => [
                'type'        => \GraphQL::type('UserType'),
                'description' => 'TaskType editor',
            ],
            'author'     => [
                'type'        => \GraphQL::type('UserType'),
                'description' => 'TaskType author',
            ],
            'subject'    => [
                'type'        => \GraphQL::type('TaskSubjectType'),
                'description' => 'TaskType subject',
            ],
            'date_end'   => [
                'type'        => Type::string(),
                'description' => 'TaskType date_end',
            ],
            'price'   => [
                'type'        => Type::int(),
                'description' => 'TaskType price',
            ],
            'title'   => [
                'type'        => Type::string(),
                'description' => 'TaskType title',
            ],
            'desc'   => [
                'type'        => Type::string(),
                'description' => 'TaskType desc',
            ],
            'words'   => [
                'type'        => Type::string(),
                'description' => 'TaskType words',
            ],
            'more_data'   => [
                'type'        => Type::string(),
                'description' => 'TaskType more_data',
            ],
            'task'   => [
                'type'        => Type::string(),
                'description' => 'TaskType task',
            ],
            'rule_text'   => [
                'type'        => Type::string(),
                'description' => 'TaskType rule_text',
            ],
            'text_body'   => [
                'type'        => Type::string(),
                'description' => 'TaskType text_body',
            ],
            'text_preview'   => [
                'type'        => Type::string(),
                'description' => 'TaskType text_preview',
            ],
            'text_url'   => [
                'type'        => Type::string(),
                'description' => 'TaskType text_url',
            ],
            'text_min'   => [
                'type'        => Type::int(),
                'description' => 'TaskType text_min',
            ],
            'text_max'   => [
                'type'        => Type::int(),
                'description' => 'TaskType text_max',
            ],
            'text_unique'   => [
                'type'        => Type::string(),
                'description' => 'TaskType text_unique',
            ],
            'created_at' => [
                'type'        => Type::string(),
                'description' => 'TaskType created_at',
            ],
            'updated_at' => [
                'type'        => Type::string(),
                'description' => 'TaskType updated_at',
            ],
            'notify'     => [
                'type'        => Type::string(),
                'description' => 'notify',
                'selectable'  => false,
            ],
        ];
    }
}