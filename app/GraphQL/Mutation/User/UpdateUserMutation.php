<?php
declare(strict_types=1);

namespace App\GraphQL\Mutation\User;

use App\GraphQL\Serialize\UserSerialize;
use App\Models\Menu;
use App\Models\User;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Validation\Rule;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

/**
 * Class UpdateUserMutation
 *
 * @package App\GraphQL\Mutation
 */
class UpdateUserMutation extends Mutation
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'UpdateUserMutation',
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
                'rules' => ['required'],
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
     * @api           {post} /apps/v2 User-Update
     * @apiName       User-Update
     * @apiParam {Integer{required,1..}} id ID
     * @apiParam {String{required}} name name
     * @apiParam {String} surname surname
     * @apiParam {String{required,email,unique}} email email
     * @apiParam {String{required}} role role (1,2,3)
     * @apiParam {String} password password
     * @apiParam {String} confirm confirm
     * @apiParam {Float} up_price up_price
     * @apiParam {String} note note
     * @apiParamExample {json} Request-Example:
     * {"query":"mutation { UpdateUserMutation (id: 1,name:"name",email:"email",role: "1,2",confirm:
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

        $user = User::findOrfail($args['id']);

        $user->name     = $args['name'];
        $user->email    = $this->validMail($args);
        $user->up_price = $args['up_price'];
        $user->note     = $args['note'];
        $user->confirm  = $user->hasRole(1) ? 1 : $args['confirm'];

        if ($args['password']) {
            $user->password = bcrypt($args['password']);
        }

        $user->save();

        $user->roles()->delete();
        $user->roles()->createMany($this->cleanRole($args['role']));

        /**
         * TODO
         * send email
         */

        return [
            'id'     => $user->id,
            'notify' => trans('data.notifyOK'),
        ];

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

    /**
     * valid mail
     *
     * @param array $args
     *
     * @return mixed
     */
    private function validMail(array $args)
    {
        $validator = \Validator::make($args, [
            'email' => Rule::unique('users')->ignore($args['id']),
        ]);
        if ($validator->fails()) {
            return User::find($args['id'])->email;
        }

        return $args['email'];
    }
}