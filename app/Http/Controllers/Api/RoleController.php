<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\RoleSaveValidation;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Resources\Roles\Role as RoleResource;
use App\Http\Controllers\Controller;

/**
 * Class RoleController
 * @package App\Http\Controllers\Api
 */
class RoleController extends Controller
{

    /**
     * @apiVersion    0.2.0
     * @apiGroup      Role
     * @apiPermission auth
     * @api           {post} getRoles getRole(s)
     * @apiName       getRoles
     * @apiParam {Integer} id ID if need one
     * @apiParamExample {json} Request-Example:
     * {id: 1}
     * @apiSuccess {Integer} id ID
     * @apiSuccess {String} name name
     * @apiSuccess {Integer} count count
     * @apiSuccess {Datetime} created_at created_at format('d-m-Y H:m:s')
     * @apiSuccess {Datetime} updated_at updated_at format('d-m-Y H:m:s')
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getRoles(Request $request)
    {
        $role = Role::query();

        if (isset($request->id)) {
            $role->where('id', $request->id);
        }

        return RoleResource::collection($role->get());
    }

    /**
     * @apiVersion    0.2.0
     * @apiGroup      Role
     * @apiPermission auth
     * @api           {post} saveRole saveRole
     * @apiName       saveRole
     * @apiParam {String{Required}} name name
     * @apiParamExample {json} Request-Example:
     * {name:'xxx'}
     * @apiSuccess {String} success trans('data.notifyOK')
     * @apiError {Array} errors errors{name:'error xxx',...}
     *
     * @param RoleSaveValidation $request
     *
     * @return array
     */
    public function saveRole(RoleSaveValidation $request)
    {
        $role = Role::findOrNew($request->id);

        $role->name = $request->name;
        $role->save();

        return ['success' => trans('data.notifyOK')];
    }

    /**
     * @apiVersion    0.2.0
     * @apiGroup      Role
     * @apiPermission auth
     * @api           {post} deleteRole deleteRole(s)
     * @apiName       deleteRole
     * @apiParam {Array} items subject's ID [1,2,3...]
     * @apiParamExample {json} Request-Example:
     * {items:{1,2,3}}
     * @apiSuccess {String} success trans('data.notifyOK')
     *
     * @param Request $request
     *
     * @return array
     */
    public function deleteRole(Request $request)
    {
        foreach ($request->items as $key) {
            $role = Role::find($key['id']);
            if (!$role->users()->count()) {
                $role->delete();
            }
        }

        return ['success' => trans('data.notifyOK')];
    }
}
