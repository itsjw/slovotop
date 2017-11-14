<?php
declare(strict_types=1);

namespace App\GraphQL\Mutation\User;

use App\GraphQL\Serialize\UserSerialize;
use App\Jobs\SendUserMailJob;
use App\Models\Menu;
use App\Models\User;
use Bus;
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
                'name' => 'password',
                'type' => Type::string(),
            ],
            'confirm'  => [
                'name' => 'confirm',
                'type' => Type::int(),
            ],
            'up_price' => [
                'name'  => 'up_price',
                'type'  => Type::float(),
                'rules' => ['numeric'],
            ],
            'note'     => [
                'name' => 'note',
                'type' => Type::string(),
            ],
        ];
    }

    /**
     * @apiVersion    0.1.0
     * @apiGroup      User
     * @apiPermission auth
     * @api           {post} v1 User-Add
     * @apiName       User-Add
     * @apiParam {Integer{required,>=0}} id ID
     * @apiParam {String{required}} name name
     * @apiParam {String} surname surname
     * @apiParam {String{required,email,unique}} email email
     * @apiParam {String{required}} role role (1,2,3)
     * @apiParam {String{required,min:6}} password password
     * @apiParam {String} confirm confirm
     * @apiParam {Float} up_price up_price
     * @apiParam {String} note note
     * @apiParamExample {json} Request-Example:
     * {"query":"mutation { AddUserMutation (id: 0,name:"name",email:"email",role: "1,2",confirm:
     * 1,password: "password" ) { id } }"}
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
        if (Menu::getAccessMenu('users') == 2) {

            $user = new User();

            $user->name     = $args['name'];
            $user->email    = $args['email'];
            $user->up_price = $args['up_price'];
            $user->note     = $args['note'];
            $user->confirm  = $args['confirm'];

            if (isset($args['password'])) {
                $user->password = bcrypt($args['password']);
            } else {
                $pass           = str_random(8);
                $user->password = bcrypt($pass);
            }

            $user->save();

            $user->roles()->createMany($this->cleanRole($args['role']));

            /**
             * TODO
             * need test mail sent
             * Bus::dispatch(new SendUserMailJob($user, $pass));
             */

            return [
                'id'     => $user->id,
                'notify' => trans('data.notifyOK'),
            ];
        }

        return [];

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