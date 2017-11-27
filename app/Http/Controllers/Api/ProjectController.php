<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

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

        return ProjectResource::collection($project->get());
    }

    /**
     *
     */
    public function saveProject()
    {

    }

    /**
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
