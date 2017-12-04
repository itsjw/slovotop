<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskSaveValidation;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class TaskController
 * @package App\Http\Controllers\Api
 */
class TaskController extends Controller
{
    /**
     * @param Request $request
     */
    public function getTasks(Request $request)
    {
        $task = Task::query();

        if (isset($request->id)) {
            $task->where('id', $request->id);
        }
    }

    /**
     * @param TaskSaveValidation $request
     *
     * @return array
     */
    public function saveTask(TaskSaveValidation $request)
    {
        $task = Task::findOrNew($request->id);

        $task->name = $request->name;
        $task->user_id = $request->user_id;
        $task->project_id = $request->project;
        $task->status_id = $request->status ?? 1; // TODO
        $task->stage_id = $request->stage ?? 1; // TODO
        $task->editor_id = $request->editor;
        $task->author_id = $request->author;
        $task->subject_id = $request->subject;
        $task->date_end = Carbon::parse($request->dateEnd);
        $task->price = $request->price;
        $task->title = $request->title;
        $task->desc = $request->desc;
        $task->words = $request->words;
        $task->more_data = $request->moreData;
        $task->task = $request->task;
        $task->text_body = $request->textBody;
        $task->text_preview = $request->textPreview;
        $task->text_url = $request->textUrl;
        $task->text_min = $request->textMin;
        $task->text_max = $request->textMax;
        $task->text_unique = $request->textUnique;

        $task->save();

        return ['success' => trans('data.notifyOK'), 'id' => $task->id];
    }
}