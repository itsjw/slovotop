<?php
declare(strict_types=1);

namespace App\GraphQL\Query\Task;

use App\GraphQL\Serialize\TaskSerialize;
use App\Models\Task;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

/**
 * Class TaskQuery
 *
 * @package App\GraphQL\Query\Task
 */
class TaskQuery extends Query
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'TaskQuery',
        'description' => 'A query',
    ];

    /**
     * @return \GraphQL\Type\Definition\ListOfType
     */
    public function type()
    {
        return Type::listOf(\GraphQL::type('TaskType'));
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
     * @apiGroup      Task
     * @apiPermission auth
     * @api           {post} /apps/v2 Task-Query
     * @apiName       Task-Query
     * @apiParam {Integer} id
     * @apiParamExample {json} Request-Example:
     * {"query":"{ TaskQuery ( id:1 ) { id,name...}"}
     * @apiSuccess {Integer} id ID
     * @apiSuccess {String} name name
     * @apiSuccess {Object} user [User]
     * @apiSuccess {Object} project [Project]
     * @apiSuccess {Object} status [TaskStatus]
     * @apiSuccess {Object} stage [TaskStage]
     * @apiSuccess {Object} editor [User]
     * @apiSuccess {Object} author [User]
     * @apiSuccess {Object} subject [TaskSubject]
     * @apiSuccess {Timestamp} date_end date_end
     * @apiSuccess {Integer} price price
     * @apiSuccess {String} title title
     * @apiSuccess {String} desc desc
     * @apiSuccess {String} words words
     * @apiSuccess {String} more_data more_data
     * @apiSuccess {String} task task
     * @apiSuccess {String} rule_text rule_text
     * @apiSuccess {String} text_body text_body
     * @apiSuccess {String} text_preview text_preview
     * @apiSuccess {String} text_url text_url
     * @apiSuccess {Integer} text_min text_min
     * @apiSuccess {Integer} text_max text_max
     * @apiSuccess {String} text_unique text_unique
     * @apiSuccess {Timestamp} created_at created_at
     * @apiSuccess {Timestamp} updated_at updated_at
     * @apiExample {json} Example usage:
     * {"query":"{ TaskQuery { id,name,count,.....,created_at,updated_at } }"}
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
        $query = Task::query();

        if (isset($args['id'])) {
            $query->where('id', $args['id']);
        }

        return TaskSerialize::collection($query->get());
    }
}