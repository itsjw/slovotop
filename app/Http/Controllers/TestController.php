<?php
declare(strict_types=1);

namespace App\Http\Controllers;


use App\Models\Setting;
use App\Models\StageTaskAccess;
use App\Models\TaskStage;
use App\Models\User;
use App\Http\Resources\Users\User as UserResourse;
use Carbon\Carbon;

class TestController extends Controller
{

    public function index()
    {
        $stage = 'name';

        $t = StageTaskAccess::where('stage_id', 1)->select('field', 'access')->get();

        foreach ($t as $item) {
            if($item->field == 'name'){
                echo $item->access;
            }
        }

        dd($t->where('field','name')->first()->access);

    }

}