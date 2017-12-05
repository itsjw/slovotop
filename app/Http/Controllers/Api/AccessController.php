<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\AccessMenuSaveValidation;
use App\Http\Requests\StageAccessSaveValidation;
use App\Http\Requests\TaskFiledAccessSaveValidation;
use App\Models\Menu;
use App\Models\Role;
use App\Models\StageTaskAccess;
use App\Models\TaskStage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class AccessController
 * @package App\Http\Controllers\Api
 */
class AccessController extends Controller
{
    /**
     * @apiVersion    0.2.0
     * @apiGroup      Access
     * @apiPermission auth,accessRoute:roles
     * @api           {post} saveAccessMenu saveAccessMenu
     * @apiName       saveAccessMenu
     * @apiParam {Integer{Required}} menu  menu ID
     * @apiParam {Integer{Required}} role role
     * @apiParam {Mixed{Required}} access access
     * @apiParamExample {json} Request-Example:
     * {menu:1,role:2,access:3}
     * @apiSuccess {String} success trans('data.notifyOK')
     * @apiError {Array} errors errors{name:'error xxx',...}
     *
     * @param AccessMenuSaveValidation $request
     *
     * @return array
     */
    public function saveAccessMenu(AccessMenuSaveValidation $request)
    {
        $menu = Menu::find($request->menu)->roles()->where('role_id', $request->role);

        if ($menu->exists()) {
            $menu->updateExistingPivot($request->role, ['access' => $request->access]);
        } else {
            $role = Role::find($request->role);
            $menu->save($role, ['access' => $request->access]);
        }

        return ['success' => trans('data.notifyOK')];
    }

    /**
     * @apiVersion    0.2.0
     * @apiGroup      Access
     * @apiPermission auth,accessRoute:settings
     * @api           {post} getTaskField getTaskField
     * @apiName       getTaskField
     * @apiParam {Integer} stage stage
     * @apiParamExample {json} Request-Example:
     * {stage: 1}
     * @apiSuccess {Array} array [[name:'xxx',lang: 'xxx',access: 1],[...]]
     *
     * @param Request $request
     *
     * @return array
     */
    public function getTaskField(Request $request)
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

    /**
     * @apiVersion    0.2.0
     * @apiGroup      Access
     * @apiPermission auth,accessRoute:settings
     * @api           {post} saveTaskFieldAccess saveTaskFieldAccess
     * @apiName       saveTaskFieldAccess
     * @apiParam {String{Required}} field  field
     * @apiParam {Integer{Required}} stage stage
     * @apiParam {Mixed{Required}} access access
     * @apiParamExample {json} Request-Example:
     * {field:'xxx',stage:2,access:3}
     * @apiSuccess {String} success trans('data.notifyOK')
     * @apiError {Array} errors errors{name:'error xxx',...}
     *
     * @param TaskFiledAccessSaveValidation $request
     *
     * @return array
     */
    public function saveTaskFieldAccess(TaskFiledAccessSaveValidation $request)
    {
        $stage = StageTaskAccess::firstOrNew(['field' => $request->field, 'stage_id' => $request->stage]);

        $stage->stage_id = $request->stage;
        $stage->field = $request->field;
        $stage->access = $request->access;

        $stage->save();

        return ['success' => trans('data.notifyOK')];
    }

    /**
     * @apiVersion    0.2.0
     * @apiGroup      Access
     * @apiPermission auth,accessRoute:roles
     * @api           {post} saveStageRoleAccess saveStageRoleAccess
     * @apiName       saveStageRoleAccess
     * @apiParam {Integer{Required}} role  role
     * @apiParam {Integer{Required}} stage stage
     * @apiParam {Mixed{Required}} access access
     * @apiParamExample {json} Request-Example:
     * {role:2,stage:2,access:3}
     * @apiSuccess {String} success trans('data.notifyOK')
     * @apiError {Array} errors errors{name:'error xxx',...}
     *
     * @param StageAccessSaveValidation $request
     *
     * @return array
     */
    public function saveStageRoleAccess(StageAccessSaveValidation $request)
    {
        $stage = TaskStage::find($request->stage)->roles()->where('role_id', $request->role);

        if ($stage->exists()) {
            $stage->updateExistingPivot($request->role, ['access' => $request->access]);
        } else {
            $role = Role::find($request->role);
            $stage->save($role, ['access' => $request->access]);
        }

        return ['success' => trans('data.notifyOK')];
    }
}