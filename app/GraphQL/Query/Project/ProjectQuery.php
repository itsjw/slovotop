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
            'id' => [
                'name' => 'id',
                'type' => Type::id(),
            ],
        ];
    }

    /**
     * @apiVersion    0.1.0
     * @apiGroup      Query
     * @apiPermission admin
     * @api           {post} v1 ProjectQuery
     * @apiName       ProjectQuery
     * @apiParam {Integer} id
     * @apiParamExample {json} Request-Example:
     * {"query":"{ ProjectQuery ( id:1 ) { id,name...}"}
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

        return ProjectSerialize::collection($query->get());
    }
}