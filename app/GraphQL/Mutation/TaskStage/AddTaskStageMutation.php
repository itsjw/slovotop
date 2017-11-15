<?php
declare(strict_types=1);

namespace App\GraphQL\Mutation\TaskStage;

use App\Models\Menu;
use App\Models\TaskStage;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Validation\Rule;
use Rebing\GraphQL\Error\ValidationError;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

/**
 * Class AddTaskStageMutation
 *
 * @package App\GraphQL\Mutation
 */
class AddTaskStageMutation extends Mutation
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'AddTaskStageMutation',
        'description' => 'A mutation',
    ];

    /**
     * @return mixed
     */
    public function type()
    {
        return \GraphQL::type('TaskStageType');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id'       => [
                'name' => 'id',
                'type' => Type::ID(),
            ],
            'name'     => [
                'name'  => 'name',
                'type'  => Type::string(),
                'rules' => ['required'],
            ],
            'priority' => [
                'name' => 'priority',
                'type' => Type::int(),
            ],
        ];
    }

    /**
     * @apiVersion    0.1.0
     * @apiGroup      Task Stage
     * @apiPermission auth
     * @api           {post} v2 AddTaskStageMutation-Add/Update
     * @apiName       AddTaskStageMutation-Add/Update
     * @apiParam {Integer{required}} id ID
     * @apiParam {String{required}} name name
     * @apiParam {Integer{required,unique}} priority priority
     * @apiParamExample {json} Request-Example:
     * {"query":"mutation { AddTaskStageMutation (id: 0,name:"name",priority:1) { id } }"}
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
        if (Menu::getAccessMenu('settings') == 2) {

            $subject = TaskStage::findOrNew($args['id']);

            $this->validPriority($args);

            $subject->name     = $args['name'];
            $subject->priority = $args['priority'];
            $subject->save();

            return [
                'id'     => $subject->id,
                'notify' => trans('data.notifyOK'),
            ];
        }

        return [];
    }

    /**
     * validate Priority
     *
     * @param $data
     *
     * @throws \Rebing\GraphQL\Error\ValidationError
     */
    private function validPriority($data)
    {
        $validate = \Validator::make($data, [
            'priority' => [
                'required',
                Rule::unique('task_stages')->ignore($data['id']),
            ],
        ]);

        if ($validate->fails()) {
            throw with(new ValidationError('validation'))->setValidator($validate);
        }

        return $data;
    }
}