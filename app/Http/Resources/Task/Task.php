<?php
declare(strict_types=1);

namespace App\Http\Resources\Task;

use App\Http\Resources\Projects\ProjectLittle;
use App\Http\Resources\Users\UserLittle;
use App\Models\StageTaskAccess;
use Illuminate\Http\Resources\Json\Resource;

/**
 * Class Task
 * @package App\Http\Resources\Task
 */
class Task extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $stageTask = StageTaskAccess::where('stage_id', $this->stage_id)->select('field', 'access')->get();

        return [
            'id'          => $this->id,
            'owner'       => new UserLittle($this->user),
            'name'        => [
                'data'   => $this->name,
                'access' => $stageTask->where('field', 'name')->first()->access ?? 0,
            ],
            'project'     => [
                'data'   => new ProjectLittle($this->project),
                'access' => $stageTask->where('field', 'project_id')->first()->access ?? 0,
            ],
            'subject'     => [
                'data'   => $this->subject,
                'access' => $stageTask->where('field', 'subject_id')->first()->access ?? 0,
            ],
            'dateEnd'     => [
                'data'   => $this->date_end->format('Y-d-m'),
                'access' => $stageTask->where('field', 'date_end')->first()->access ?? 0,
            ],
            'price'       => [
                'data'   => $this->price,
                'access' => $stageTask->where('field', 'price')->first()->access ?? 0,
            ],
            'title'       => [
                'data'   => $this->title,
                'access' => $stageTask->where('field', 'title')->first()->access ?? 0,
            ],
            'desc'        => [
                'data'   => $this->desc,
                'access' => $stageTask->where('field', 'desc')->first()->access ?? 0,
            ],
            'words'       => [
                'data'   => $this->words,
                'access' => $stageTask->where('field', 'words')->first()->access ?? 0,
            ],
            'moreData'    => [
                'data'   => $this->more_data,
                'access' => $stageTask->where('field', 'more_data')->first()->access ?? 0,
            ],
            'task'        => [
                'data'   => $this->task,
                'access' => $stageTask->where('field', 'task')->first()->access ?? 0,
            ],
            'textBody'    => [
                'data'   => $this->text_body,
                'access' => $stageTask->where('field', 'text_body')->first()->access ?? 0,
            ],
            'textPreview' => [
                'data'   => $this->text_preview,
                'access' => $stageTask->where('field', 'text_preview')->first()->access ?? 0,
            ],
            'textUrl'     => [
                'data'   => $this->text_url,
                'access' => $stageTask->where('field', 'text_url')->first()->access ?? 0,
            ],
            'textMin'     => [
                'data'   => $this->text_min,
                'access' => $stageTask->where('field', 'text_min')->first()->access ?? 0,
            ],
            'textMax'     => [
                'data'   => $this->text_max,
                'access' => $stageTask->where('field', 'text_max')->first()->access ?? 0,
            ],
            'textUnique'  => [
                'data'   => $this->text_unique,
                'access' => $stageTask->where('field', 'text_unique')->first()->access ?? 0,
            ],
            'created_at'  => $this->created_at->format('d-m-Y H:m:s'),
            'updated_at'  => $this->updated_at->format('d-m-Y H:m:s'),
        ];
    }
}
