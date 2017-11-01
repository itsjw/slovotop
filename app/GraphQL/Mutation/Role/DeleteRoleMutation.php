<?php
declare(strict_types=1);

namespace App\GraphQL\Mutation\Role;

use App\GraphQL\Serialize\RoleSerialize;
use App\Models\Role;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

/**
 * Class DeleteRoleMutation
 *
 * @package App\GraphQL\Mutation
 */
class DeleteRoleMutation extends Mutation
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'DeleteRoleMutation',
        'description' => 'A mutation',
    ];

    /**
     * @return mixed
     */
    public function type()
    {
        return \GraphQL::type('RoleType');
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
     * @apiGroup      Role
     * @apiPermission auth
     * @api           {post} v1 Role-Delete
     * @apiName      Role-Delete
     * @apiParam {String{1,2,3..}} items items
     * @apiParamExample {json} Request-Example:
     * {"query":"mutation { DeleteRoleMutation (items:"1,2,3") { id } }"}
     * @apiSuccess {Object} role [Role]
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
            $role = Role::findOrfail($key);
            if ( ! $role->users()->count()) {
                $role->delete();
            }
        }

        return RoleSerialize::serialize($role);

    }
}