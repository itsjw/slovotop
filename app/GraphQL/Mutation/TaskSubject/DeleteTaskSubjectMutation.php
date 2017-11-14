<?php
declare(strict_types=1);

namespace App\GraphQL\Mutation\TaskSubject;

use App\Models\Menu;
use App\Models\TaskSubject;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

/**
 * Class AddTaskSubjectMutation
 *
 * @package App\GraphQL\Mutation
 */
class DeleteTaskSubjectMutation extends Mutation
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'DeleteTaskSubjectMutation',
        'description' => 'A mutation',
    ];

    /**
     * @return mixed
     */
    public function type()
    {
        return \GraphQL::type('TaskSubjectType');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'items' => [
                'name' => 'items',
                'type' => Type::string(),
            ],
        ];
    }

    /**
     * @apiVersion    0.1.0
     * @apiGroup      TaskSubject
     * @apiPermission auth
     * @api           {post} v2 TaskSubject-Delete
     * @apiName       TaskSubject-Delete
     * @apiParam {String{1,2,3..}} items items
     * @apiParamExample {json} Request-Example:
     * {"query":"mutation { DeleteTaskSubjectMutation (items:"1,2,3") { id } }"}
     * @apiSuccess {Array} id ['id' => id ,'notify' => trans('data.notifyOK')]
     *
     * @param $root
     * @param $args
     * @param \Rebing\GraphQL\Support\SelectFields $fields
     * @param \GraphQL\Type\Definition\ResolveInfo $info
     *
     * @return array
     */
    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        if (Menu::getAccessMenu('subjects') == 2) {

            $items = explode(',', $args['items']);

            TaskSubject::whereIn('id', $items)->delete();

            return [
                'id'     => 0,
                'notify' => trans('data.notifyOK'),
            ];
        }

        return [];
    }
}