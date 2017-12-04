<?php
declare(strict_types=1);

namespace App\Http\Controllers;


use App\Models\Setting;
use App\Models\User;
use App\Http\Resources\Users\User as UserResourse;
use Carbon\Carbon;

class TestController extends Controller
{

    public function index()
    {
        $date = '2017-12-04T17:00:00.000Z';

        dd(Carbon::parse($date));

    }

}