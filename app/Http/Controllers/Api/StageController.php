<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\StageSaveValidation;
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

    /**
     * @param StageSaveValidation $request
     *
     * @return array
     */
    public function saveStage(StageSaveValidation $request)
    {
        $stage = TaskStage::findOrNew($request->id);

        $stage->name = $request->name;
        $stage->priority = $request->priority;
        $stage->price = $request->price;

        $stage->save();

        return ['success' => trans('data.notifyOK')];
    }

}
