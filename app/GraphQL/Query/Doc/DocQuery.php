<?php
declare(strict_types=1);

namespace App\GraphQL\Query\Doc;

use App\GraphQL\Serialize\DocSerialize;
use App\Models\Doc;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

/**
 * Class DocQuery
 *
 * @package App\GraphQL\Query\Doc
 */
class DocQuery extends Query
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'DocQuery',
        'description' => 'A query',
    ];

    /**
     * @return \GraphQL\Type\Definition\ListOfType
     */
    public function type()
    {
        return Type::listOf(\GraphQL::type('DocType'));
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id'         => [
                'name' => 'id',
                'type' => Type::id(),
            ],
            'searchName' => [
                'name' => 'searchName',
                'type' => Type::string(),
            ],
        ];
    }

    /**
     * @apiVersion    0.1.0
     * @apiGroup      Doc
     * @apiPermission auth
     * @api           {post} /apps/v2 Doc-Query
     * @apiName       Doc-Query
     * @apiParam {Integer} id
     * @apiParam {String} searchName searchName
     * @apiParamExample {json} Request-Example:
     * {"query":"{ DocQuery ( id:1,searchName:"searchName" ) { id,name...}"}
     * @apiSuccess {Integer} id ID
     * @apiSuccess {String} name name
     * @apiSuccess {String} body body
     * @apiSuccess {Object} user [User]
     * @apiSuccess {Object} roles [Roles]
     * @apiSuccess {Timestamp} created_at created_at
     * @apiSuccess {Timestamp} updated_at updated_at
     * @apiExample {json} Example usage:
     * {"query":"{ DocQuery { id,name,body,user{id,name},roles{access},created_at,updated_at } }"}
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
        $query = Doc::query();

        if (isset($args['id'])) {
            $query->where('id', $args['id']);
        }
        if (isset($args['searchName'])) {
            $query->where('name', 'like', '%'.$args['searchName'].'%');
        }
        if ( ! \Auth::user()->isAdmin()) {
            $query->whereHas('roles', function ($request) {
                $request->whereIn('role_id', \Auth::user()->getRoles())->where('access', '>', 0);
            });
        }


        return DocSerialize::collection($query->get());
    }
}