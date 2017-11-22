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
     * @return UserResourse
     */
    public function getUser(Request $request)
    {
        $user = User::find($request->id);

        return new UserResourse($user);
    }
}