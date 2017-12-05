<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserSaveValidation;
use App\Http\Resources\Users\User as UserResourse;
use App\Http\Resources\Users\UserLittle;
use App\Jobs\SendUserMailJob;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 */
class UserController extends Controller
{
    /**
     * @apiVersion    0.2.0
     * @apiGroup      User
     * @apiPermission auth,accessRoute:users
     * @api           {post} getUsers getUser(s)
     * @apiName       getUser
     * @apiParam {Integer} id ID if need one
     * @apiParam {String} name Search name
     * @apiParam {String} email Search email
     * @apiParamExample {json} Request-Example:
     * {id: 1,name:'xxx',email:'xxx'}
     * @apiSuccess {Integer} id ID
     * @apiSuccess {String} name name
     * @apiSuccess {String} email email
     * @apiSuccess {Integer} confirm confirm
     * @apiSuccess {Integer} tasksCount tasksCount
     * @apiSuccess {Datetime} lastLogin lastLogin format('d-m-Y H:m:s')
     * @apiSuccess {Object} roles roles{id,name}
     * @apiSuccess {Datetime} created_at created_at format('d-m-Y H:m:s')
     * @apiSuccess {Integer} up_price price
     * @apiSuccess {String} note note
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getUsers(Request $request)
    {
        $users = User::query()->with('roles.role:id,name');

        if (isset($request->id)) {
            $users->where('id', $request->id);
        }
        if (isset($request->name)) {
            $users->where('name', 'like', '%' . $request->name . '%');
        }
        if (isset($request->email)) {
            $users->where('email', 'like', '%' . $request->email . '%');
        }

        return UserResourse::collection($users->get());
    }

    /**
     * @apiVersion    0.2.0
     * @apiGroup      User
     * @apiPermission auth
     * @api           {post} getUserList getUserList
     * @apiName       getUserList
     * @apiParam {String} editor get all editors
     * @apiParam {String} author get all authors
     * @apiParamExample {json} Request-Example:
     * {editor:'xxx',author:'xxx'}
     * @apiSuccess {Integer} id ID
     * @apiSuccess {String} name name
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getUserList(Request $request)
    {
        $users = User::query()->with('roles.role:id,name');

        if (isset($request->editor)) {
            $users->whereHas('roles', function ($query) {
                $query->where('role_id', \DB::table('settings')
                    ->where('name', 'editor')->first()->value);
            });
        }
        if (isset($request->author)) {
            $users->whereHas('roles', function ($query) {
                $query->where('role_id', \DB::table('settings')
                    ->where('name', 'author')->first()->value);
            });
        }

        return UserLittle::collection($users->get());
    }

    /**
     * @apiVersion    0.2.0
     * @apiGroup      User
     * @apiPermission auth,accessRoute
     * @api           {post} saveUser saveUser
     * @apiName       saveUser
     * @apiParam {String{Required}} name name
     * @apiParam {String{Required,Unique}} email email
     * @apiParam {Integer} up_price up_price
     * @apiParam {String} note note
     * @apiParam {Array{Required}} role role's ID [1,2,3..]
     * @apiParam {String} password password
     * @apiParamExample {json} Request-Example:
     * {name:'xxx',email:'xxx',up_price:1,note:'xxx',role:{1,2,3},password:'xxx'}
     * @apiSuccess {String} success trans('data.notifyOK')
     * @apiError {Array} errors errors{name:'error xxx',...}
     *
     * @param UserSaveValidation $request
     *
     * @return array
     */
    public function saveUser(UserSaveValidation $request)
    {
        $user = User::findOrNew($request->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->up_price = $request->up_price;
        $user->note = $request->note;
        $user->confirm = $request->confirm;

        if (isset($request->password)) {
            $user->password = bcrypt($request->password);
        } else {
            $pass = str_random(8);
            $user->password = $user->password ?? bcrypt($pass);
        }

        $user->save();
        $user->roles()->delete();
        $user->roles()->createMany($this->cleanRole($request->role));

        // $this->dispatch(new SendUserMailJob($user, $pass)); TODO send mail

        return ['success' => trans('data.notifyOK')];
    }


    /**
     * @apiVersion    0.2.0
     * @apiGroup      User
     * @apiPermission auth,accessRoute
     * @api           {post} deleteUser deleteUser(s)
     * @apiName       deleteUser
     * @apiParam {Array} items users's ID [1,2,3...]
     * @apiParamExample {json} Request-Example:
     * {items:{1,2,3}}
     * @apiSuccess {String} success trans('data.notifyOK')
     *
     * @param Request $request
     *
     * @return array
     */
    public function deleteUser(Request $request)
    {
        foreach ($request->items as $item) {

            $user = User::find($item['id']);

            if (!$user->hasRole(1)) {
                $user->delete();
                $user->roles()->delete();
            }
        }

        return ['success' => trans('data.notifyOK')];
    }


    /**
     * @apiVersion    0.2.0
     * @apiGroup      User
     * @apiPermission auth,accessRoute
     * @api           {post} approveUser approveUser(s)
     * @apiName       approveUser
     * @apiParam {Array} items users's ID [1,2,3...]
     * @apiParamExample {json} Request-Example:
     * {items:{1,2,3}}
     * @apiSuccess {String} success trans('data.notifyOK')
     *
     * @param Request $request
     *
     * @return array
     */
    public function approveUser(Request $request)
    {
        foreach ($request->items as $item) {

            $user = User::find($item['id']);
            $user->confirm = $user->confirm ? false : true;
            $user->save();

        }

        return ['success' => trans('data.notifyOK')];
    }

    /**
     * @param $roles
     *
     * @return array
     */
    private function cleanRole($roles): array
    {
        $rolls = array_unique($roles);

        if (!in_array(1, $roles)) {
            foreach ($rolls as $val) {
                $array[]['role_id'] = $val;
            }

            return $array;
        }

        return [['role_id' => 1]];
    }
}