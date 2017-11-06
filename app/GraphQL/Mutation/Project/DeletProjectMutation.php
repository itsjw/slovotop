<?php
declare(strict_types=1);

namespace App\GraphQL\Mutation\Project;

use App\GraphQL\Serialize\ProjectSerialize;
use App\Models\Project;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

/**
 * Class DeletProjectMutation
 *
 * @package App\GraphQL\Mutation
 */
class DeletProjectMutation extends Mutation
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'DeleteProjectMutation',
        'description' => 'A mutation',
    ];

    /**
     * @return mixed
     */
    public function type()
    {
        return \GraphQL::type('ProjectType');
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
     * @apiGroup      Project
     * @apiPermission auth
     * @api           {post} v2 Project-Delete
     * @apiName       Project-Delete
     * @apiParam {String{1,2,3..}} items items
     * @apiParamExample {json} Request-Example:
     * {"query":"mutation { DeleteProjectMutation (items:"1,2,3") { id } }"}
     * @apiSuccess {Array} id ['id' => trans('data.notifyOK')]
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

        foreach ($items as $key) {
            $project = Project::where('id', $key);

            if ( ! \Auth::user()->hasRole(1)) {
                $project->where('user_id', \Auth::id());
            }

            $project->delete();
        }

        return ['id' => trans('data.notifyOK')];

    }

}