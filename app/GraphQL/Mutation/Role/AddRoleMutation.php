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
 * Class AddRoleMutation
 *
 * @package App\GraphQL\Mutation
 */
class AddRoleMutation extends Mutation
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'AddRole',
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
            'id'   => [
                'name' => 'id',
                'type' => Type::ID(),
            ],
            'name' => [
                'name'  => 'name',
                'type'  => Type::string(),
                'rules' => ['required'],
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     * @param \Rebing\GraphQL\Support\SelectFields $fields
     * @param \GraphQL\Type\Definition\ResolveInfo $info
     *
     * @return array
     */
    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $role = Role::findOrNew($args['id']);

        $role->name = $args['name'];
        $role->save();

        return RoleSerialize::serialize($role);

    }
}