<?php
declare(strict_types=1);

namespace App\GraphQL\Mutation\Access;

use App\Models\Menu;
use App\Models\Role;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

/**
 * Class ChangeAccessMenuMutation
 *
 * @package App\GraphQL\Mutation
 */
class ChangeAccessMenuMutation extends Mutation
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'ChangeAccessMenuMutation',
        'description' => 'A mutation',
    ];

    /**
     * @return mixed
     */
    public function type()
    {
        return \GraphQL::type('MenuType');
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
            'menu'   => [
                'name' => 'menu',
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
     * @api           {post} /apps/v2 Change Access Menu
     * @apiName       Change Access Menu
     * @apiParam {Integer{required,0-1}} access access
     * @apiParam {Integer{required,>=1}} menu menu ID
     * @apiParam {Integer{required,>=1}} role role ID
     * @apiParamExample {json} Request-Example:
     * {"query":"mutation { ChangeAccessMenuMutation (access:1,menu:1,role:2) { id } }"}
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

        $menu = Menu::find($args['menu'])->roles()->where('role_id', $args['role']);

        if ($menu->exists()) {
            $menu->updateExistingPivot($args['role'], ['access' => $args['access']]);
        } else {
            $role = Role::find($args['role']);
            $menu->save($role, ['access' => $args['access']]);
        }

        return [
            'id'     => $args['menu'],
            'notify' => trans('data.notifyOK'),
        ];

    }

}