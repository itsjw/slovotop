<?php
declare(strict_types=1);

namespace App\GraphQL\Mutation\Access;

use App\Models\Role;
use App\Models\TaskStage;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

/**
 * Class ChangeAccessStageMutation
 *
 * @package App\GraphQL\Mutation
 */
class ChangeAccessStageMutation extends Mutation
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'ChangeAccessStageMutation',
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
            'access' => [
                'name' => 'access',
                'type' => Type::int(),
                'rule' => ['required'],
            ],
            'stage'  => [
                'name' => 'stage',
                'type' => Type::int(),
                'rule' => ['required', 'not_in:0'],
            ],
            'role'   => [
                'name' => 'role',
                'type' => Type::int(),
                'rule' => ['required', 'not_in:0'],
            ],
        ];
    }

    /**
     * @apiVersion    0.1.0
     * @apiGroup      Access
     * @apiPermission auth
     * @api           {post} /apps/v2 Change Access Stage
     * @apiName       Change Access Stage
     * @apiParam {Integer{required,0-1}} access access
     * @apiParam {Integer{required,>=1}} stage stage ID
     * @apiParam {Integer{required,>=1}} role role ID
     * @apiParamExample {json} Request-Example:
     * {"query":"mutation { ChangeAccessStageMutation (access:1,stage:1,role:2) { id } }"}
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

        $stage = TaskStage::find($args['stage'])->roles()->where('role_id', $args['role']);

        if ($stage->exists()) {
            $stage->updateExistingPivot($args['role'], ['access' => $args['access']]);
        } else {
            $role = Role::find($args['role']);
            $stage->save($role, ['access' => $args['access']]);
        }

        return [
            'id'     => $args['stage'],
            'notify' => trans('data.notifyOK'),
        ];

    }

}