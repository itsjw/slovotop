<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\DocSaveValidation;
use App\Models\Doc;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Docs\Doc as DocResource;

/**
 * Class DocController
 * @package App\Http\Controllers\Api
 */
class DocController extends Controller
{
    /**
     * @apiVersion    0.2.0
     * @apiGroup      Doc
     * @apiPermission auth,accessRoute:docs
     * @api           {post} getDocs getDoc(s)
     * @apiName       getDocs
     * @apiParam {Integer} id ID if need one
     * @apiParam {String} name Search name
     * @apiParamExample {json} Request-Example:
     * {id: 1,name:'xxx'}
     * @apiSuccess {Integer} id ID
     * @apiSuccess {String} name name
     * @apiSuccess {String} body body
     * @apiSuccess {Object} user user{id,name}
     * @apiSuccess {Object} roles roles
     * @apiSuccess {Datetime} created_at created_at format('d-m-Y H:m:s')
     * @apiSuccess {Datetime} updated_at updated_at format('d-m-Y H:m:s')
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getDocs(Request $request)
    {
        $doc = Doc::query();

        if (!\Auth::user()->isAdmin()) {
            $doc->whereHas('roles', function ($request) {
                $request->whereIn('role_id', \Auth::user()->getRoles())->where('access', '>', 0);
            });
        }

        if (isset($request->id)) {
            $doc->where('id', $request->id);
        }
        if (isset($request->name)) {
            $doc->where('name', 'like', '%' . $request->name . '%');
        }

        return DocResource::collection($doc->get());
    }

    /**
     * @apiVersion    0.2.0
     * @apiGroup      Doc
     * @apiPermission auth,accessRoute:docs
     * @api           {post} saveDoc saveDoc
     * @apiName       saveDoc
     * @apiParam {Integer} id ID
     * @apiParam {String{Required}} name name
     * @apiParam {Array{Required}} roles roles[1,2,3..]
     * @apiParam {Integer{Required}} user user
     * @apiParam {String{Required}} body body
     * @apiParamExample {json} Request-Example:
     * {id:2,name:'xxx',roles{1,2,4},body:'test'}
     * @apiSuccess {String} success trans('data.notifyOK')
     * @apiError {Array} errors errors{name:'error xxx',...}
     *
     * @param DocSaveValidation $request
     *
     * @return array
     */
    public function saveDoc(DocSaveValidation $request)
    {
        $doc = Doc::findOrNew($request->id);

        $doc->name = $request->name;
        $doc->body = $request->body;
        $doc->user_id = $request->user;
        $doc->save();
        $doc->roles()->detach();

        foreach ($request->roles as $val) {
            $role = Role::find($val);
            $doc->roles()->save($role, ['access' => 1]);
        }

        return ['success' => trans('data.notifyOK'), 'id' => $doc->id];
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function deleteDoc(Request $request)
    {
        foreach ($request->items as $item) {
            $doc = Doc::findOrfail($item['id']);
            $doc->roles()->detach();
            $doc->delete();
        }

        return ['success' => trans('data.notifyOK')];
    }
}
