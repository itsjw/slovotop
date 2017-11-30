<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\SubjectSaveValidation;
use App\Http\Resources\Subjects\Subject;
use App\Models\TaskSubject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class SubjectController
 * @package App\Http\Controllers\Api
 */
class SubjectController extends Controller
{
    /**
     * @apiVersion    0.2.0
     * @apiGroup      Subject
     * @apiPermission auth
     * @api           {post} getSubjects getSubject(s)
     * @apiName       getSubjects
     * @apiParam {Integer} id ID if need getUser
     * @apiParam {String} name Search name
     * @apiParamExample {json} Request-Example:
     * {id: 1,name:'xxx',email:'xxx'}
     * @apiSuccess {Integer} id ID
     * @apiSuccess {String} name name
     * @apiSuccess {Integer} price price
     * @apiSuccess {Datetime} created_at created_at format('d-m-Y H:m:s')
     * @apiSuccess {Datetime} updated_at updated_at format('d-m-Y H:m:s')
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getSubjects(Request $request)
    {
        $subject = TaskSubject::query();

        if (isset($request->id)) {
            $subject->where('id', $request->id);
        }
        if (isset($request->name)) {
            $subject->where('name', 'like', '%' . $request->name . '%');
        }

        return Subject::collection($subject->get());
    }

    /**
     * @param SubjectSaveValidation $request
     *
     * @return array
     */
    public function saveSubject(SubjectSaveValidation $request)
    {
        $subject = TaskSubject::findOrNew($request->id);

        $subject->name = $request->name;
        $subject->price = $request->price;

        $subject->save();

        return ['success' => trans('data.notifyOK')];
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function deleteSubject(Request $request)
    {
        foreach ($request->items as $item) {
            TaskSubject::find($item['id'])->delete();
        }

        return ['success' => trans('data.notifyOK')];
    }
}
