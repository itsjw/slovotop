<?php
declare(strict_types=1);

namespace App\GraphQL\Serialize;

use App\Models\LastLogin;

/**
 * Class LastLoginSerialize
 *
 * @package App\GraphQL\Serialize
 */
class LastLoginSerialize extends Serialize
{
    /**
     * @param LastLogin $last
     *
     * @return array
     */
    public function toArray($last): array
    {
        return [
            'id'         => $last->id,
            'user'       => $last->user,
            'created_at' => $last->created_at->format('d-m-Y H:m:s'),
            'updated_at' => $last->updated_at->format('d-m-Y H:m:s'),
        ];
    }
}