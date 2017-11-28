<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\Stages\Stage;
use App\Models\TaskStage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class StageController
 * @package App\Http\Controllers\Api
 */
class StageController extends Controller
{
    //
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getStages(Request $request)
    {
        $stage = TaskStage::query();

        if (isset($request->id)) {
            $stage->where('id', $request->id);
        }

        return Stage::collection($stage->get());
    }
}
