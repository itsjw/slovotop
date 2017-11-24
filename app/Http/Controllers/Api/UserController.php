<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\User as UserResourse;
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
}