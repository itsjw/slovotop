<?php
declare(strict_types=1);

namespace App\GraphQL\Mutation\Doc;

use App\Models\Doc;
use App\Models\Role;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

/**
 * Class AddDocMutation
 *
 * @package App\GraphQL\Mutation
 */
class AddDocMutation extends Mutation
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'AddDocMutation',
        'description' => 'A mutation',
    ];

    /**
     * @return mixed
     */
    public function type()
    {
        return \GraphQL::type('DocType');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id'    => [
                'name'  => 'id',
                'type'  => Type::ID(),
                'rules' => ['required'],
            ],
            'name'  => [
                'name'  => 'name',
                'type'  => Type::string(),
                'rules' => ['required'],
            ],
            'roles' => [
                'name'  => 'roles',
                'type'  => Type::string(),
                'rules' => ['required'],
            ],
            'user'  => [
                'name'  => 'user',
                'type'  => Type::int(),
                'rules' => ['required'],
            ],
            'body'  => [
                'name'  => 'body',
                'type'  => Type::string(),
                'rules' => ['required'],
            ],
        ];
    }

    /**
     * @apiVersion    0.1.0
     * @apiGroup      Doc
     * @apiPermission auth
     * @api           {post} v1 Doc-Add/Update
     * @apiName       Doc-Add/Update
     * @apiParam {Integer{required}} id ID
     * @apiParam {String{required}} name name
     * @apiParam {String{required,1,2,3...}} roles roles
     * @apiParam {Integer{required}} user user_id
     * @apiParam {String{required}} body body
     * @apiParamExample {json} Request-Example:
     * {"query":"mutation { AddDocMutation (id: 0,name:"name") { id } }"}
     * @apiSuccess {Array} id ['id' => trans('data.notifyOK')]
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
        $doc          = Doc::findOrNew($args['id']);
        $doc->name    = $args['name'];
        $doc->body    = $args['body'];
        $doc->user_id = $args['user'];
        $doc->save();
        $doc->roles()->detach();

        $roles = explode(',', $args['roles']);

        foreach ($roles as $val) {
            $role = Role::find($val);
            $doc->roles()->save($role, ['access' => 1]);
        }

        return ['id' => trans('data.notifyOK')];

    }
}