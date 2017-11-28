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
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getDocs(Request $request)
    {
        $doc = Doc::query();

        if (isset($request->id)) {
            $doc->where('id', $request->id);
        }

        return DocResource::collection($doc->get());
    }

    /**
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

        return ['success' => trans('data.notifyOK')];
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function deleteDoc(Request $request)
    {
        foreach ($request->items as $item) {
            $doc = Doc::findOrfail($item);
            $doc->roles()->detach();
            $doc->delete();
        }

        return ['success' => trans('data.notifyOK')];
    }
}
