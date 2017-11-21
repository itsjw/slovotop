<?php
declare(strict_types=1);

namespace App\GraphQL\Serialize;

use App\Models\Task;

/**
 * Class TaskSerialize
 *
 * @package App\GraphQL\Serialize
 */
class TaskSerialize extends Serialize
{
    /**
     * @param Task $task
     *
     * @return array
     */
    public function toArray($task): array
    {
        return [
            'id'           => $task->id,
            'name'         => $task->name,
            'user'         => $task->user,
            'project'      => $task->project,
            'status'       => $task->status,
            'stage'        => $task->stage,
            'editor'       => $task->user,
            'author'       => $task->user,
            'subject'      => $task->subject,
            'date_end'     => $task->date_end->format('d-m-Y H:m:s'),
            'price'        => $task->price,
            'title'        => $task->title,
            'desc'         => $task->desc,
            'words'        => $task->words,
            'more_data'    => $task->more_data,
            'rule_text'    => $task->rule_text,
            'text_body'    => $task->text_body,
            'text_preview' => $task->text_preview,
            'text_url'     => $task->text_url,
            'text_min'     => $task->text_min,
            'text_max'     => $task->text_max,
            'text_unique'  => $task->text_unique,
            'created_at'   => $task->created_at->format('d-m-Y H:m:s'),
            'updated_at'   => $task->updated_at->format('d-m-Y H:m:s'),
        ];
    }
}