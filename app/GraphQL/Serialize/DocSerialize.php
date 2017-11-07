<?php
declare(strict_types=1);

namespace App\GraphQL\Serialize;

use App\Models\Menu;

/**
 * Class DocSerialize
 *
 * @package App\GraphQL\Serialize
 */
class DocSerialize extends Serialize
{
    /**
     * @param Menu $menu
     *
     * @return array
     */
    public function toArray($menu): array
    {
        return [
            'id'         => $menu->id,
            'name'       => $menu->name,
            'body'       => $menu->body,
            'user'       => $menu->user,
            'roles'      => $menu->roles,
            'created_at' => $menu->created_at->format('d-m-Y H:m:s'),
            'updated_at' => $menu->updated_at->format('d-m-Y H:m:s'),
        ];
    }
}