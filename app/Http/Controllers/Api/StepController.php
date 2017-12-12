<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Steps\Step;
use App\Models\TaskStep;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class StepController
 * @package App\Http\Controllers\Api
 */
class StepController extends Controller
{
    /**
     * @param Request $request
     *
     * @return ResourceCollection
     */
    public function getSteps(Request $request): ResourceCollection
    {
        $steps = TaskStep::where('task_id', $request->task);

        return Step::collection($steps->get());
    }
}