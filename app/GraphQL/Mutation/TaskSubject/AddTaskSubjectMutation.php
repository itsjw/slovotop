<?php
declare(strict_types=1);

namespace App\GraphQL\Mutation\TaskSubject;

use App\Models\Menu;
use App\Models\TaskSubject;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

/**
 * Class AddTaskSubjectMutation
 *
 * @package App\GraphQL\Mutation
 */
class AddTaskSubjectMutation extends Mutation
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'AddTaskSubjectMutation',
        'description' => 'A mutation',
    ];

    /**
     * @return mixed
     */
    public function type()
    {
        return \GraphQL::type('TaskSubjectType');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id'    => [
                'name' => 'id',
                'type' => Type::ID(),
            ],
            'name'  => [
                'name'  => 'name',
                'type'  => Type::string(),
                'rules' => ['required'],
            ],
            'price' => [
                'name'  => 'price',
                'type'  => Type::int(),
                'rules' => ['required', 'numeric', 'not_in:0'],
            ],
        ];
    }

    /**
     * @apiVersion    0.1.0
     * @apiGroup      Task Subject
     * @apiPermission auth
     * @api           {post} /apps/v2 TaskSubject-Add/Update
     * @apiName       TaskSubject-Add/Update
     * @apiParam {Integer{required}} id ID
     * @apiParam {String{required}} name name
     * @apiParam {Integer{required}} price price
     * @apiParamExample {json} Request-Example:
     * {"query":"mutation { AddTaskSubjectMutation (id: 0,name:"name",price:100) { id } }"}
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

        $subject = TaskSubject::findOrNew($args['id']);

        $subject->name  = $args['name'];
        $subject->price = $args['price'];
        $subject->save();

        return [
            'id'     => $subject->id,
            'notify' => trans('data.notifyOK'),
        ];

    }

}