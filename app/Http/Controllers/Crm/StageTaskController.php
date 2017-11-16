<?php
declare(strict_types=1);

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\StageTaskAccess;
use Illuminate\Http\Request;

/**
 * Class StageTaskController
 *
 * @package App\Http\Controllers\Crm
 */
class StageTaskController extends Controller
{

    /**
     * get stage to task field access from config and DB
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Config\Repository|mixed
     */
    public function getStageTaskAccess(Request $request)
    {

        $stage  = StageTaskAccess::where('stage_id', $request->stage)->get();
        $fields = config('access.taskFiled');

        foreach ($stage as $value) {
            if (array_key_exists($value->field, $fields)) {
                $fields[$value->field]['access'] = $value->access;
            }
        }

        return array_values($fields);
    }
}