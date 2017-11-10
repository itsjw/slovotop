<?php
declare(strict_types=1);

namespace App\GraphQL\Query\Project;

use App\GraphQL\Serialize\ProjectSerialize;
use App\Models\Project;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

/**
 * Class ProjectQuery
 *
 * @package App\GraphQL\Query\Project
 */
class ProjectQuery extends Query
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'ProjectQuery',
        'description' => 'A query',
    ];

    /**
     * @return \GraphQL\Type\Definition\ListOfType
     */
    public function type()
    {
        return Type::listOf(\GraphQL::type('ProjectType'));
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
            'site'    => [
                'name' => 'site',
                'type' => Type::string(),
            ],
            'owner'   => [
                'name' => 'owner',
                'type' => Type::string(),
            ],
        ];
    }

    /**
     * @apiVersion    0.1.0
     * @apiGroup      Project
     * @apiPermission auth
     * @api           {post} v2 Project-Query
     * @apiName       Project-Query
     * @apiParam {Integer} id ID
     * @apiParam {String} name name
     * @apiParam {String} site site
     * @apiParam {String} owner owner
     * @apiParamExample {json} Request-Example:
     * {"query":"{ ProjectQuery ( id:1,owner:"owner" ) { id,name...}"}
     * @apiSuccess {Integer} id ID
     * @apiSuccess {String} name name
     * @apiSuccess {String} site site
     * @apiSuccess {Object} user [User]
     * @apiSuccess {Timestamp} created_at created_at
     * @apiSuccess {Timestamp} updated_at updated_at
     * @apiExample {json} Example usage:
     * {"query":"{ ProjectQuery { id,name,site,user{ia,name},created_at,updated_at } }"}
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
        $query = Project::query();

        if (isset($args['id'])) {
            $query->where('id', $args['id']);
        }
        if ( ! \Auth::user()->isAdmin()) {
            $query->where('user_id', \Auth::id());
        }

        if (isset($args['name'])) {
            $query->where('name', 'like', '%'.$args['name'].'%');
        }
        if (isset($args['site'])) {
            $query->where('site', 'like', '%'.$args['site'].'%');
        }
        if (isset($args['owner'])) {
            $query->where('email', 'like', '%'.$args['owner'].'%');
        }
        if (isset($args['orderID'])) {
            $query->orderBy('id', $args['orderID']);
        }

        return ProjectSerialize::collection($query->get());
    }
}