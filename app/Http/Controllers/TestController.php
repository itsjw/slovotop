<?php
declare(strict_types=1);

namespace App\Http\Controllers;


use App\Models\Setting;
use App\Models\User;
use App\Http\Resources\Users\User as UserResourse;

class TestController extends Controller
{

    public function index()
    {
        $users = User::query()->with('roles.role:id,name');

        $users->whereHas('roles', function ($query) {
            $query->where('role_id', \DB::table('settings')
                ->where('name', 'editor')->first()->value);
        });

        return UserResourse::collection($users->get());
    }

}