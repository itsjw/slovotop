<?php
declare(strict_types=1);

namespace App\GraphQL\Query\Role;

use App\GraphQL\Serialize\RoleSerialize;
use App\Models\Role;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

/**
 * Class RoleQuery
 *
 * @package App\GraphQL\Query\Role
 */
class RoleQuery extends Query
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
        return Type::listOf(\GraphQL::type('RoleType'));
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
     * @apiGroup      Role
     * @apiPermission auth
     * @api           {post} v2 Role-Query
     * @apiName       Role-Query
     * @apiParam {Integer} id
     * @apiParamExample {json} Request-Example:
     * {"query":"{ RoleQuery ( id:1 ) { id,name...}"}
     * @apiSuccess {Integer} id ID
     * @apiSuccess {String} name name
     * @apiSuccess {Integer} count count
     * @apiSuccess {Timestamp} created_at created_at
     * @apiSuccess {Timestamp} updated_at updated_at
     * @apiExample {json} Example usage:
     * {"query":"{ RoleQuery { id,name,count,created_at,updated_at } }"}
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
        $query = Role::query();

        if (isset($args['id'])) {
            $query->where('id', $args['id']);
        }

        return RoleSerialize::collection($query->get());
    }
}