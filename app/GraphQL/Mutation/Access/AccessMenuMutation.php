<?php
declare(strict_types=1);

namespace App\GraphQL\Mutation\Access;

use App\Models\AccessMenu;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

/**
 * Class AccessMenuMutation
 *
 * @package App\GraphQL\Mutation
 */
class AccessMenuMutation extends Mutation
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'AccessMenuMutation',
        'description' => 'A mutation',
    ];

    /**
     * @return mixed
     */
    public function type()
    {
        return \GraphQL::type('AccessMenuType');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id'     => [
                'name' => 'id',
                'type' => Type::ID(),
            ],
            'access' => [
                'name' => 'access',
                'type' => Type::int(),
                'rule' => ['required'],
            ],
            'menu'   => [
                'name' => 'menu',
                'type' => Type::int(),
                'rule' => ['required'],
            ],
            'role'   => [
                'name' => 'role',
                'type' => Type::int(),
                'rule' => ['required'],
            ],
        ];
    }

    /**
     * @apiVersion    0.1.0
     * @apiGroup      Access
     * @apiPermission auth
     * @api           {post} v1 AccessMenu-Add/Update
     * @apiName       AccessMenu-Add/Update
     * @apiParam {Integer{required,0..}} id ID
     * @apiParam {Integer{required}} access access
     * @apiParam {Integer{required}} menu menu
     * @apiParam {Integer{required}} role role
     * @apiParamExample {json} Request-Example:
     * {"query":"mutation { AccessMenuMutation (id: 0,access:1,menu:1,role:1) { id } }"}
     * @apiSuccess {Object} AccessMenu [AccessMenu]
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
        // TODO
        $role = AccessMenu::findOrNew($args['id']);

        $role->access = $args['access'];
        $role->save();

        return RoleSerialize::serialize($role);

    }
}