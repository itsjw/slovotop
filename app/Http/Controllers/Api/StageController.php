<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\StageSaveValidation;
use App\Http\Resources\Stages\Stage;
use App\Models\TaskStage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class StageController
 * @package App\Http\Controllers\Api
 */
class StageController extends Controller
{

    /**
     * @apiVersion    0.2.0
     * @apiGroup      Stage
     * @apiPermission auth,accessRoute:settings
     * @api           {post} getStages getStage(s)
     * @apiName       getStages
     * @apiParam {Integer} id ID if need one
     * @apiParamExample {json} Request-Example:
     * {id: 1}
     * @apiSuccess {Integer} id ID
     * @apiSuccess {String} name name
     * @apiSuccess {Integer} priority priority
     * @apiSuccess {Integer} price price
     * @apiSuccess {Array} roles roles{access}
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getStages(Request $request)
    {
        $stage = TaskStage::query();

        if (isset($request->id)) {
            $stage->where('id', $request->id);
        }
        if (isset($request->role)) {
            $role = $request->role;
            $stage->with([
                'roles' => function ($query) use ($role) {
                    $query->where('role_id', $role)->select('access');
                },
            ]);
        }

        return Stage::collection($stage->get());
    }

    /**
     * @apiVersion    0.2.0
     * @apiGroup      Stage
     * @apiPermission auth,accessRoute:settings
     * @api           {post} saveStage saveStage
     * @apiName       saveStage
     * @apiParam {Integer} id ID
     * @apiParam {String{Required}} name name
     * @apiParam {Integer{Required,Unique,Integer,Min:0}} priority priority
     * @apiParam {Integer{Integer,Min:0}} price price
     * @apiParamExample {json} Request-Example:
     * {name:'xxx',priority:1,price:100}
     * @apiSuccess {String} success trans('data.notifyOK')
     * @apiError {Array} errors errors{name:'error xxx',...}
     *
     * @param StageSaveValidation $request
     *
     * @return array
     */
    public function saveStage(StageSaveValidation $request)
    {
        $stage = TaskStage::findOrNew($request->id);

        $stage->name = $request->name;
        $stage->priority = $request->priority;
        $stage->price = $request->price;
        $stage->time = $request->time;

        $stage->save();

        return ['success' => trans('data.notifyOK')];
    }

    /**
     * @apiVersion    0.2.0
     * @apiGroup      Stage
     * @apiPermission auth,accessRoute:settings
     * @api           {post} deleteStage deleteStage(s)
     * @apiName       deleteStage
     * @apiParam {Array} items items[1,2,3...] (ID's)
     * @apiParamExample {json} Request-Example:
     * {items:{1,2,3}}
     * @apiSuccess {String} success trans('data.notifyOK')
     *
     * @param Request $request
     *
     * @return array
     */
    public function deleteStage(Request $request)
    {
        foreach ($request->items as $item) {
            $stage = TaskStage::find($item['id']);
            $stage->roles()->detach();
            $stage->task()->delete();
            $stage->delete();
        }

        return ['success' => trans('data.notifyOK')];
    }
}
