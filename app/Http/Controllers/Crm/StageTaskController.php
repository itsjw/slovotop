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
     * @apiVersion    0.1.0
     * @apiGroup      Stage Task Access
     * @apiPermission auth
     * @api           {post} /api/stageAccess StageTaskAccess-Query
     * @apiName       StageTaskAccess-Query
     * @apiParam {Integer{required}} stage stage
     * @apiParamExample {json} Request-Example:
     * {"stage":"2"}
     * @apiSuccess {Array} fields ['access','name']
     * @apiExample {json} Example usage:
     * {"stage":"2"}
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Config\Repository|mixed
     */
    public function getStageTaskAccess(Request $request)
    {

        $stage = StageTaskAccess::where('stage_id', $request->stage)->get();
        $fields = config('access.taskFiled');

        foreach ($fields as $value) {
            foreach ($stage as $key) {
                if (in_array($key->field, $value, true)) {
                    $value['access'] = $key->access;
                }
            }
            $array[] = $value;
        }

        return $array;
    }
}