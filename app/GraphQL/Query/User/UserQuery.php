<?php

namespace App\GraphQL\Query\User;

use App\GraphQL\Serialize\UserSerialize;
use App\Models\User;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

/**
 * Class UserQuery
 *
 * @package App\GraphQL\Query
 */
class UserQuery extends Query
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'UserQuery',
        'description' => 'A UserQuery query',
    ];

    /**
     * @return \GraphQL\Type\Definition\ListOfType
     */
    public function type()
    {
        return Type::listOf(\GraphQL::type('UserType'));
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id'      => [
                'name' => 'id',
                'type' => Type::id(),
            ],
            'orderID' => [
                'name' => 'orderID',
                'type' => Type::string(),
            ],
            'name'    => [
                'name' => 'name',
                'type' => Type::string(),
            ],
            'surname' => [
                'name' => 'surname',
                'type' => Type::string(),
            ],
            'email'   => [
                'name' => 'email',
                'type' => Type::string(),
            ],
        ];
    }

    /**
     * @apiVersion    0.1.0
     * @apiGroup      User
     * @apiPermission auth
     * @api           {post} v1 User-query
     * @apiName       User-query
     * @apiParam {Integer} id id
     * @apiParam {String} orderID order by ID
     * @apiParam {String} name name
     * @apiParam {String} surname surname
     * @apiParam {String} email email
     * @apiParamExample {json} Request-Example:
     * {"query":"{ UserQuery ( id:1,orderID:"asc" ) { id,name,surname,...}"}
     * @apiSuccess {Integer} id ID
     * @apiSuccess {String} name name
     * @apiSuccess {String} surname surname
     * @apiSuccess {String} email email
     * @apiSuccess {Boolean} confirm confirm
     * @apiSuccess {Object} roles [Roles]
     * @apiSuccess {Timestamp} created_at created_at
     * @apiSuccess {Timestamp} updated_at updated_at
     * @apiExample {json} Example usage:
     * {"query":"{ UserQuery { id,name,surname,email,role{id,name},confirm,created_at,updated_at } }"}
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
        $query = User::query();

        if (isset($args['id'])) {
            $query->where('id', $args['id']);
        }
        if (isset($args['name'])) {
            $query->where('name', 'like', '%'.$args['name'].'%');
        }
        if (isset($args['surname'])) {
            $query->where('surname', 'like', '%'.$args['surname'].'%');
        }
        if (isset($args['email'])) {
            $query->where('email', 'like', '%'.$args['email'].'%');
        }
        if (isset($args['orderID'])) {
            $query->orderBy('id', $args['orderID']);
        }

        return UserSerialize::collection($query->get());
    }
}