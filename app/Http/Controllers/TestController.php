<?php
declare(strict_types=1);

namespace App\Http\Controllers;


use App\Models\User;
use App\Http\Resources\Users\User as UserResourse;

class TestController extends Controller
{

    public function index()
    {
        $users = User::query()->with('roles.role:id,name');

        /*$user->with(['roles' => function($query){
            $query->with('role:id,name')->select('user_id','role_id');
        }]);*/

        return UserResourse::collection($users->get());
    }

}