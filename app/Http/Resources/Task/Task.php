<?php

namespace App\Http\Resources\Task;

use App\Http\Resources\Projects\ProjectLittle;
use App\Http\Resources\Users\UserLittle;
use Illuminate\Http\Resources\Json\Resource;

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
        return [
            'id'           => $this->id,
            'owner'        => new UserLittle($this->user),
            'name'         => $this->name,
            'project'      => new ProjectLittle($this->project),
            'status'       => $this->status_id,
            'stage'        => $this->stage_id,
            'editor'       => $this->editor_id,
            'author'       => $this->author_id,
            'subject_id'   => '',
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
