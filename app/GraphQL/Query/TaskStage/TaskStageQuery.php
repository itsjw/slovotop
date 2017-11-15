<?php
declare(strict_types=1);

namespace App\GraphQL\Query\TaskStage;

use App\GraphQL\Serialize\TaskStageSerialize;
use App\Models\TaskStage;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

/**
 * Class TaskStageQuery
 *
 * @package App\GraphQL\Query\TaskStage
 */
class TaskStageQuery extends Query
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'TaskStageQuery',
        'description' => 'A query',
    ];

    /**
     * @return \GraphQL\Type\Definition\ListOfType
     */
    public function type()
    {
        return Type::listOf(\GraphQL::type('TaskStageType'));
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::id(),
            ],
        ];
    }

    /**
     * @apiVersion    0.1.0
     * @apiGroup      Task Stage
     * @apiPermission auth
     * @api           {post} v2 TaskStage-Query
     * @apiName       TaskStage-Query
     * @apiParam {Integer} id
     * @apiParamExample {json} Request-Example:
     * {"query":"{ TaskStageQuery ( id:1 ) { id,name...}"}
     * @apiSuccess {Integer} id ID
     * @apiSuccess {String} name name
     * @apiSuccess {Integer} priority priority
     * @apiSuccess {Timestamp} created_at created_at
     * @apiSuccess {Timestamp} updated_at updated_at
     * @apiExample {json} Example usage:
     * {"query":"{ TaskStageQuery { id,name,priority,created_at,updated_at } }"}
     *
     * @param $root
     * @param $args
     * @param \Rebing\GraphQL\Support\SelectFields $fields
     * @param \GraphQL\Type\Definition\ResolveInfo $info
     *
     * @return \Illuminate\Support\Collection
     */
    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $query = TaskStage::query()->orderBy('priority', 'asc');

        if (isset($args['id'])) {
            $query->where('id', $args['id']);
        }

        return TaskStageSerialize::collection($query->get());
    }
}