<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserSaveValidation;
use App\Http\Resources\Users\User as UserResourse;
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
     * @param UserSaveValidation $request
     *
     * @return UserResourse
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
            $user->password = bcrypt($pass);
        }

        $user->save();
        $user->roles()->createMany($this->cleanRole($request->role));

        // $this->dispatch(new SendUserMailJob($user, $pass)); TODO send mail

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