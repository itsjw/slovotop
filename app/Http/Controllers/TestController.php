<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\StageTaskAccess;

class TestController extends Controller
{

    public function index()
    {

        $stage = StageTaskAccess::where('stage_id', 3)->get();
        $fields = config('access.taskFiled');

        foreach ($fields as $value) {
            foreach ($stage as $key) {
                if(in_array($key->field,$value,true)){
                    $value['access'] = $key->access;
                }
            }
            $arr[] = $value;
        }

        dd($arr);

    }

}