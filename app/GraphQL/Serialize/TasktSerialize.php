<?php
declare(strict_types=1);

namespace App\GraphQL\Serialize;

use App\Models\Task;

/**
 * Class TasktSerialize
 *
 * @package App\GraphQL\Serialize
 */
class TasktSerialize extends Serialize
{
    /**
     * @param Task $task
     *
     * @return array
     */
    public function toArray($task): array
    {
        return [
            'id'         => $task->id,
            'name'       => $task->name,
            'created_at' => $task->created_at->format('d-m-Y H:m:s'),
            'updated_at' => $task->updated_at->format('d-m-Y H:m:s'),
        ];
    }
}