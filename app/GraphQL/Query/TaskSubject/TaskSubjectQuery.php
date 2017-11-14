<?php
declare(strict_types=1);

namespace App\GraphQL\Query\TaskSubject;

use App\GraphQL\Serialize\TaskSubjectSerialize;
use App\Models\TaskSubject;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

/**
 * Class TaskSubjectQuery
 *
 * @package App\GraphQL\Query\TaskSubject
 */
class TaskSubjectQuery extends Query
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'RoleQuery',
        'description' => 'A query',
    ];

    /**
     * @return \GraphQL\Type\Definition\ListOfType
     */
    public function type()
    {
        return Type::listOf(\GraphQL::type('TaskSubjectType'));
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id'         => [
                'name' => 'id',
                'type' => Type::id(),
            ],
            'searchName' => [
                'name' => 'searchName',
                'type' => Type::string(),
            ],
        ];
    }

    /**
     * @apiVersion    0.1.0
     * @apiGroup      TaskSubject
     * @apiPermission auth
     * @api           {post} v2 TaskSubject-Query
     * @apiName       TaskSubject-Query
     * @apiParam {Integer} id
     * @apiParam {String} searchName searchName
     * @apiParamExample {json} Request-Example:
     * {"query":"{ TaskSubjectQuery ( id:1,searchName:"searchName" ) { id,name...}"}
     * @apiSuccess {Integer} id ID
     * @apiSuccess {String} name name
     * @apiSuccess {Integer} price price
     * @apiSuccess {Timestamp} created_at created_at
     * @apiSuccess {Timestamp} updated_at updated_at
     * @apiExample {json} Example usage:
     * {"query":"{ TaskSubjectQuery { id,name,price,created_at,updated_at } }"}
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
        $query = TaskSubject::query();

        if (isset($args['id'])) {
            $query->where('id', $args['id']);
        }
        if (isset($args['searchName'])) {
            $query->where('name', 'like', '%'.$args['searchName'].'%');
        }

        return TaskSubjectSerialize::collection($query->get());
    }
}