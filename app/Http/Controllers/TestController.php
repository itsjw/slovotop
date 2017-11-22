<?php
declare(strict_types=1);

namespace App\Http\Controllers;


use App\Models\User;

class TestController extends Controller
{

    public function index()
    {
        $user = User::find(1);


    }

}