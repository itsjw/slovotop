<?php
declare(strict_types=1);

namespace App\GraphQL\Mutation\Access;

use App\Models\StageTaskAccess;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

/**
 * Class ChangeAccessTaskFieldMutation
 *
 * @package App\GraphQL\Mutation
 */
class ChangeAccessTaskFieldMutation extends Mutation
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'ChangeAccessTaskFieldMutation',
        'description' => 'A mutation',
    ];

    /**
     * @return mixed
     */
    public function type()
    {
        return \GraphQL::type('StageTaskAccessType');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'access' => [
                'name' => 'access',
                'type' => Type::int(),
                'rule' => ['required'],
            ],
            'stage'  => [
                'name' => 'stage',
                'type' => Type::int(),
                'rule' => ['required', 'not_in:0'],
            ],
            'field'  => [
                'name' => 'field',
                'type' => Type::string(),
                'rule' => ['required'],
            ],
        ];
    }

    /**
     * @apiVersion    0.1.0
     * @apiGroup      Access
     * @apiPermission auth
     * @api           {post} /apps/v2 Change Access Task Field
     * @apiName       Change Access Task Field
     * @apiParam {Integer{required,0-1}} access access
     * @apiParam {Integer{required,>=1}} stage stage ID
     * @apiParam {String{required}} field field name
     * @apiParamExample {json} Request-Example:
     * {"query":"mutation { ChangeAccessTaskFieldMutation (access:1,stage:1,field:"name") { id } }"}
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

        $field = StageTaskAccess::firstOrNew(['field' => $args['field']]);
        $field->stage_id = $args['stage'];
        $field->field = $args['field'];
        $field->access = $args['access'];
        $field->save();

        return [
            'id'     => $args['stage'],
            'notify' => trans('data.notifyOK'),
        ];

    }

}