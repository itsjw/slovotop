<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Http\Resources\Projects\Project as ProjectResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function getProjects(Request $request)
    {
        $project = Project::query();

        if (isset($request->id)) {
            $project->where('id', $request->id);
        }

        return ProjectResource::collection($project->get());
    }
}
