<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\SubjectSaveValidation;
use App\Http\Resources\Subjects\Subject;
use App\Http\Resources\Subjects\SubjectLittle;
use App\Models\TaskSubject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class SubjectController
 * @package App\Http\Controllers\Api
 */
class SubjectController extends Controller
{
    /**
     * @apiVersion    0.2.0
     * @apiGroup      Subject
     * @apiPermission auth,accessRoute:subjects
     * @api           {post} getSubjects getSubject(s)
     * @apiName       getSubjects
     * @apiParam {Integer} id ID if need one
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
    public function getSubjects(Request $request): ResourceCollection
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
     * @apiVersion    0.2.0
     * @apiGroup      Subject
     * @apiPermission auth
     * @api           {post} getSubjectList getSubjectList
     * @apiName       getSubjectList
     * @apiSuccess {Integer} id ID
     * @apiSuccess {String} name name
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getSubjectList(): ResourceCollection
    {
        return SubjectLittle::collection(TaskSubject::all());
    }

    /**
     * @apiVersion    0.2.0
     * @apiGroup      Subject
     * @apiPermission auth,accessRoute:subjects
     * @api           {post} saveSubject saveSubject
     * @apiName       saveSubject
     * @apiParam {Integer} id ID
     * @apiParam {String{Required}} name name
     * @apiParam {String{Required,Integer,Not_in:0,Min:0}} price price
     * @apiParamExample {json} Request-Example:
     * {name:'xxx',price:100}
     * @apiSuccess {String} success trans('data.notifyOK')
     * @apiError {Array} errors errors{name:'error xxx',...}
     *
     * @param SubjectSaveValidation $request
     *
     * @return array
     */
    public function saveSubject(SubjectSaveValidation $request): array
    {
        $subject = TaskSubject::findOrNew($request->id);

        $subject->name = $request->name;
        $subject->price = $request->price;

        $subject->save();

        return ['success' => trans('data.notifyOK')];
    }

    /**
     * @apiVersion    0.2.0
     * @apiGroup      Subject
     * @apiPermission auth,accessRoute:subjects
     * @api           {post} deleteSubject deleteSubject(s)
     * @apiName       deleteSubject
     * @apiParam {Array} items items[1,2,3...] (ID's)
     * @apiParamExample {json} Request-Example:
     * {items:{1,2,3}}
     * @apiSuccess {String} success trans('data.notifyOK')
     *
     * @param Request $request
     *
     * @return array
     */
    public function deleteSubject(Request $request): array
    {
        foreach ($request->items as $item) {
            TaskSubject::find($item['id'])->delete();
        }

        return ['success' => trans('data.notifyOK')];
    }
}
