<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\StageTaskAccessSaveValidation;
use App\Models\Menu;
use App\Models\Role;
use App\Models\StageTaskAccess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class AccessController
 * @package App\Http\Controllers\Api
 */
class AccessController extends Controller
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function saveAccessMenu(Request $request)
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
     * @param StageTaskAccessSaveValidation $request
     *
     * @return array
     */
    public function saveTaskFieldAccess(StageTaskAccessSaveValidation $request)
    {
        $stage = StageTaskAccess::firstOrNew(['field' => $request->field]);

        $stage->stage_id = $request->stage;
        $stage->field = $request->field;
        $stage->access = $request->access;

        $stage->save();

        return ['success' => trans('data.notifyOK')];
    }
}