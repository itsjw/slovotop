<?php
declare(strict_types=1);

namespace App\GraphQL\Serialize;

use App\Models\Project;

/**
 * Class ProjectSerialize
 *
 * @package App\GraphQL\Serialize
 */
class ProjectSerialize extends Serialize
{
    /**
     * @param Project $project
     *
     * @return array
     */
    public function toArray($project): array
    {
        return [
            'id'         => $project->id,
            'name'       => $project->name,
            'site'       => $project->site,
            'user'       => UserSerialize::serialize($project->user),
            'created_at' => $project->created_at->format('d-m-Y H:m:s'),
            'updated_at' => $project->updated_at->format('d-m-Y H:m:s'),
        ];
    }
}