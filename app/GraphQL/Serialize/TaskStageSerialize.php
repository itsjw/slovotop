<?php
declare(strict_types=1);

namespace App\GraphQL\Serialize;

use App\Models\TaskStage;

/**
 * Class TaskStageSerialize
 *
 * @package App\GraphQL\Serialize
 */
class TaskStageSerialize extends Serialize
{
    /**
     * @param TaskStage $taskStage
     *
     * @return array
     */
    public function toArray($taskStage): array
    {
        return [
            'id'         => $taskStage->id,
            'name'       => $taskStage->name,
            'priority'   => $taskStage->priority,
            'price'      => $taskStage->price,
            'roles'      => count($taskStage->roles) > 0 ? $taskStage->roles : ['access' => 0],
            'created_at' => $taskStage->created_at->format('d-m-Y H:m:s'),
            'updated_at' => $taskStage->updated_at->format('d-m-Y H:m:s'),
        ];
    }
}