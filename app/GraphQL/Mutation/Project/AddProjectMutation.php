<?php
declare(strict_types=1);

namespace App\GraphQL\Mutation\Project;

use App\GraphQL\Serialize\ProjectSerialize;
use App\Models\Project;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

/**
 * Class AddProjectMutation
 *
 * @package App\GraphQL\Mutation
 */
class AddProjectMutation extends Mutation
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'AddProject',
        'description' => 'A mutation',
    ];

    /**
     * @return mixed
     */
    public function type()
    {
        return \GraphQL::type('ProjectType');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id'      => [
                'name' => 'id',
                'type' => Type::ID(),
            ],
            'name'    => [
                'name'  => 'name',
                'type'  => Type::string(),
                'rules' => ['required'],
            ],
            'site'    => [
                'name'  => 'site',
                'type'  => Type::string(),
                'rules' => ['required'],
            ],
            'user_id' => [
                'name'  => 'user_id',
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
        $project = Project::findOrNew($args['id']);

        $project->name    = $args['name'];
        $project->site    = $args['site'];
        $project->user_id = $args['user_id'];

        $project->save();

        return ProjectSerialize::serialize($project->get());

    }

}