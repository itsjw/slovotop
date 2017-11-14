<?php
declare(strict_types=1);

namespace App\GraphQL\Serialize;

use App\Models\TaskSubject;

/**
 * Class TaskSubjectSerialize
 *
 * @package App\GraphQL\Serialize
 */
class TaskSubjectSerialize extends Serialize
{
    /**
     * @param TaskSubject $taskSubject
     *
     * @return array
     */
    public function toArray($taskSubject): array
    {
        return [
            'id'         => $taskSubject->id,
            'name'       => $taskSubject->name,
            'price'      => $taskSubject->price,
            'created_at' => $taskSubject->created_at->format('d-m-Y H:m:s'),
            'updated_at' => $taskSubject->updated_at->format('d-m-Y H:m:s'),
        ];
    }
}