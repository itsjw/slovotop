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