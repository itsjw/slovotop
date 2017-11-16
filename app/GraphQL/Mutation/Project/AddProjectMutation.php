<?php
declare(strict_types=1);

namespace App\GraphQL\Mutation\Project;

use App\GraphQL\Serialize\ProjectSerialize;
use App\Models\Menu;
use App\Models\Project;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Validation\Rule;
use Rebing\GraphQL\Error\ValidationError;
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
        'name'        => 'AddProjectMutation',
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
                'type'  => Type::int(),
                'rules' => ['required', 'not_in:0'],
            ],
        ];
    }

    /**
     * @apiVersion    0.1.0
     * @apiGroup      Project
     * @apiPermission auth
     * @api           {post} /apps/v2 Project-Add/Update
     * @apiName       Project-Add/Update
     * @apiParam {Integer{required,>=0}} id ID
     * @apiParam {String{required}} name name
     * @apiParam {String{required}} site site
     * @apiParam {Integer{required,>=1}} user_id user_id
     * @apiParamExample {json} Request-Example:
     * {"query":"mutation { AddProjectMutation (id: 0,name:"name",site:"site",user_id:1) { id } }"}
     * @apiSuccess {Array} id ['id' => id ,'notify' => trans('data.notifyOK')]
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

        $project = Project::findOrNew($args['id']);

        $project->name    = $args['name'];
        $project->site    = $args['site'];
        $project->user_id = $this->VaildNoAdmin($args);

        $project->save();

        return [
            'id'     => $project->id,
            'notify' => trans('data.notifyOK'),
        ];

    }

    /**
     * Validate admin
     *
     * @param $args
     *
     * @return mixed
     * @throws \Rebing\GraphQL\Error\ValidationError
     */
    public function VaildNoAdmin($args)
    {
        $validator = \Validator::make($args, [
            'user_id' => Rule::unique('user_roles')->where(function ($query) {
                $query->where('role_id', 1);
            }),
        ], [trans('data.projNoAdmin')]);

        if ($validator->fails()) {
            throw with(new ValidationError('validation'))->setValidator($validator);
        }

        return $args['user_id'];
    }
}