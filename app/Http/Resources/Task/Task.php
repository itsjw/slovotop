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
            'id'           => $this->id,
            'owner'        => new UserLittle($this->user),
            'name'         => [
                'data'   => $this->name,
                'access' => $stageTask->where('field', 'name')->first()->access ?? 0,
            ],
            'project'      => [
                'data'   => new ProjectLittle($this->editor),
                'access' => $stageTask->where('field', 'project_id')->first()->access ?? 0,
            ],
            'status'       => $this->status_id,
            'stage'        => $this->stage_id,
            'editor'       => [
                'date'   => new ProjectLittle($this->user),
                'access' => $stageTask->where('field', 'editor_id')->first()->access ?? 0,
            ],
            'author'       => [
                'data'   => new ProjectLittle($this->author),
                'access' => $stageTask->where('field', 'author_id')->first()->access ?? 0,
            ],
            'subject'      => [
                'data'   => $this->subject,
                'access' => $stageTask->where('field', 'subject_id')->first()->access ?? 0,
            ],
            'date_end'     => '',
            'price'        => '',
            'title'        => '',
            'desc'         => '',
            'words'        => '',
            'more_data'    => '',
            'task'         => '',
            'text_body'    => '',
            'text_preview' => '',
            'text_url'     => '',
            'text_min'     => '',
            'text_max'     => '',
            'text_unique'  => '',
            'created_at'   => $this->created_at->format('d-m-Y H:m:s'),
            'updated_at'   => $this->updated_at->format('d-m-Y H:m:s'),
        ];
    }
}
