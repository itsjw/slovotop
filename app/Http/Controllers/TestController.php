<?php
declare(strict_types=1);

namespace App\Http\Controllers;


use App\Http\Resources\Projects\ProjectLittle;
use App\Models\Comment;
use App\Models\Setting;
use App\Models\StageTaskAccess;
use App\Models\Task;
use App\Models\TaskStage;
use App\Models\User;
use App\Http\Resources\Users\User as UserResourse;
use Carbon\Carbon;

class TestController extends Controller
{

    public function index()
    {

        $time = 30*3600;

        //$t = Carbon::createFromFormat('H:i:s', $time);

        return gmdate('H:i:s', $time);
    }
}