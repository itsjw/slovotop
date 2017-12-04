<?php
declare(strict_types=1);

namespace App\Http\Controllers;


use App\Models\Setting;
use App\Models\TaskStage;
use App\Models\User;
use App\Http\Resources\Users\User as UserResourse;
use Carbon\Carbon;

class TestController extends Controller
{

    public function index()
    {
        $stage = 4;

        $data = TaskStage::min('priority');

        dd($data);

    }

}