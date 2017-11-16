<?php
declare(strict_types=1);

namespace App\GraphQL\Mutation\TaskStage;

use App\Models\Menu;
use App\Models\TaskStage;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

/**
 * Class DeleteTaskStageMutation
 *
 * @package App\GraphQL\Mutation
 */
class DeleteTaskStageMutation extends Mutation
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'DeleteTaskStageMutation',
        'description' => 'A mutation',
    ];

    /**
     * @return mixed
     */
    public function type()
    {
        return \GraphQL::type('TaskStageType');
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
     * @apiGroup      Task Stage
     * @apiPermission auth
     * @api           {post} /apps/v2 TaskStage-Delete
     * @apiName       TaskStage-Delete
     * @apiParam {String{1,2,3..}} items items
     * @apiParamExample {json} Request-Example:
     * {"query":"mutation { DeleteTaskStageMutation (items:"1,2,3") { id } }"}
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

        $items = explode(',', $args['items']);

        TaskStage::whereIn('id', $items)->delete();

        return [
            'id'     => 0,
            'notify' => trans('data.notifyOK'),
        ];

    }

}