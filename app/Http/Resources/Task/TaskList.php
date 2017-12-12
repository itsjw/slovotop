<?php
declare(strict_types=1);

namespace App\Http\Resources\Task;

use App\Http\Resources\Projects\ProjectLittle;
use App\Http\Resources\Stages\StageLittle;
use App\Http\Resources\Subjects\SubjectLittle;
use App\Http\Resources\Users\UserLittle;
use Illuminate\Http\Resources\Json\Resource;

/**
 * Class Task
 * @package App\Http\Resources\Task
 */
class TaskList extends Resource
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

        return [
            'id'         => $this->id,
            'owner'      => new UserLittle($this->user),
            'name'       => $this->name,
            'project'    => new ProjectLittle($this->project),
            'status'     => $this->status_id,
            'stage'      => new StageLittle($this->stage),
            'editor'     => new UserLittle($this->editor),
            'author'     => new UserLittle($this->author),
            'subject'    => new SubjectLittle($this->subject),
            'price'      => $this->price,
            'task'       => $this->task,
            'created_at' => $this->created_at->format('d-m-Y H:m:s'),
            'updated_at' => $this->updated_at->format('d-m-Y H:m:s'),
        ];
    }
}
