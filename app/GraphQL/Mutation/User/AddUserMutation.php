<?php
declare(strict_types=1);

namespace App\GraphQL\Mutation\User;

use App\GraphQL\Serialize\UserSerialize;
use App\Models\User;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

/**
 * Class AddUserMutation
 *
 * @package App\GraphQL\Mutation
 */
class AddUserMutation extends Mutation
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'AddUserMutation',
        'description' => 'A mutation',
    ];

    /**
     * @return mixed
     */
    public function type()
    {
        return \GraphQL::type('UserType');
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
            'surname'  => [
                'name' => 'surname',
                'type' => Type::string(),
            ],
            'email'    => [
                'name'  => 'email',
                'type'  => Type::string(),
                'rules' => ['required', 'email', 'unique:users'],
            ],
            'role'     => [
                'name'  => 'role',
                'type'  => Type::string(),
                'rules' => ['required'],
            ],
            'password' => [
                'name'  => 'password',
                'type'  => Type::string(),
                'rules' => ['required', 'min:6'],
            ],
            'confirm'  => [
                'name' => 'confirm',
                'type' => Type::int(),
            ],
        ];
    }

    /**
     * @apiVersion    0.1.0
     * @apiGroup      User
     * @apiPermission admin
     * @api           {post} v1 User-Add
     * @apiName       User-Add
     * @apiParam {Integer{required,>=0}} id ID
     * @apiParam {String{required}} name name
     * @apiParam {String} surname surname
     * @apiParam {String{required,email,unique}} email email
     * @apiParam {String{required}} role role (1,2,3)
     * @apiParam {String{required,min:6}} password password
     * @apiParam {String} confirm confirm
     * @apiParamExample {json} Request-Example:
     * {"query":"mutation { AddUserMutation (id: 0,name:"name",surname:"surname",email:"email",role: "1,2",confirm:
     * 1,password: "password" ) { id } }"}
     * @apiSuccess {Object} user [User]
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
        $user = new User();

        $user->name     = $args['name'];
        $user->surname  = $args['surname'] ?? '';
        $user->email    = $args['email'];
        $user->confirm  = $args['confirm'];
        $user->password = bcrypt($args['password']);

        $user->save();

        $user->roles()->createMany($this->cleanRole($args['role']));

        return UserSerialize::serialize($user);

    }

    /**
     * clean role for createMany
     *
     * @param $roles
     *
     * @return array
     */
    private function cleanRole($roles): array
    {
        $rolls = array_unique(explode(',', $roles));

        if ( ! in_array(1, $rolls)) {
            foreach ($rolls as $val) {
                $array[]['role_id'] = $val;
            }

            return $array;
        }

        return [['role_id' => 1]];
    }
}