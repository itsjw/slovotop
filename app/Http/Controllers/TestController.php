<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Role;

class TestController extends Controller
{

    public function index()
    {
        $role = Role::where('id',1)->with('users.user');

        dd($role->get()->toArray());
    }

}