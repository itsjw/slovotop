<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProjectSaveValidation;
use App\Models\Project;
use App\Http\Resources\Projects\Project as ProjectResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class ProjectController
 * @package App\Http\Controllers\Api
 */
class ProjectController extends Controller
{
    /**
     * @apiVersion    0.2.0
     * @apiGroup      Project
     * @apiPermission auth,accessRoute:projects
     * @api           {post} getProjects getProject(s)
     * @apiName       getProjects
     * @apiParam {Integer} id ID if need getProject
     * @apiParam {String} name Search name
     * @apiParamExample {json} Request-Example:
     * {id: 1,name:'xxx'}
     * @apiSuccess {Integer} id ID
     * @apiSuccess {String} name name
     * @apiSuccess {String} site site
     * @apiSuccess {Object} user user{id,name}
     * @apiSuccess {Datetime} created_at created_at format('d-m-Y H:m:s')
     * @apiSuccess {Datetime} updated_at updated_at format('d-m-Y H:m:s')
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getProjects(Request $request)
    {
        $project = Project::query();

        if (isset($request->id)) {
            $project->where('id', $request->id);
        }
        if (!\Auth::user()->isAdmin()) {
            $project->where('user_id', \Auth::id());
        }
        if (isset($request->name)) {
            $project->where('name', 'like', '%' . $request->name . '%');
        }

        return ProjectResource::collection($project->get());
    }

    /**
     * @apiVersion    0.2.0
     * @apiGroup      Project
     * @apiPermission auth,accessRoute:projects
     * @api           {post} saveProject saveProject
     * @apiName       saveProject
     * @apiParam {String{Required}} name name
     * @apiParam {Integer{Required,not Admin}} user_id user_id
     * @apiParamExample {json} Request-Example:
     * {name:'xxx',user_id:2}
     * @apiSuccess {String} success trans('data.notifyOK')
     * @apiError {Array} errors errors{name:'error xxx',...}
     *
     * @param ProjectSaveValidation $request
     *
     * @return array
     */
    public function saveProject(ProjectSaveValidation $request)
    {
        $project = Project::findOrNew($request->id);

        $project->name = $request->name;
        $project->site = $request->site;
        $project->user_id = $request->user_id;

        $project->save();

        return ['success' => trans('data.notifyOK')];
    }

    /**
     * @apiVersion    0.2.0
     * @apiGroup      Project
     * @apiPermission auth,accessRoute:projects
     * @api           {post} deleteProject deleteProject(s)
     * @apiName       deleteProject
     * @apiParam {Array} items project's ID [1,2,3...]
     * @apiParamExample {json} Request-Example:
     * {items:{1,2,3}}
     * @apiSuccess {String} success trans('data.notifyOK')
     *
     * @param Request $request
     *
     * @return array
     */
    public function deleteProject(Request $request)
    {
        foreach ($request->items as $item) {
            Project::find($item['id'])->delete();
        }

        return ['success' => trans('data.notifyOK')];
    }
}
