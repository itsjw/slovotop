<?php
declare(strict_types=1);

namespace App\GraphQL\Serialize;

use App\Models\Menu;

/**
 * Class MenuSerialize
 *
 * @package App\GraphQL\Serialize
 */
class MenuSerialize extends Serialize
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
            'slug'       => $menu->slug,
            'icon'       => $menu->icon,
            'refer'      => $menu->refer,
            'accessMenu' => $menu->accessMenu ?? ['id' => 0],
            'created_at' => $menu->created_at->format('d-m-Y H:m:s'),
            'updated_at' => $menu->updated_at->format('d-m-Y H:m:s'),
        ];
    }
}