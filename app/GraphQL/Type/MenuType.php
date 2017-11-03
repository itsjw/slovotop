<?php
declare(strict_types=1);

namespace App\GraphQL\Type;

use App\Models\Menu;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

/**
 * Class MenuType
 *
 * @package App\GraphQL\Type
 */
class MenuType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'MenuType',
        'description' => 'A Menu type',
        'model'       => Menu::class,
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id'          => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'Menu ID',
            ],
            'name'        => [
                'type'        => Type::string(),
                'description' => 'Menu name',
            ],
            'slug'        => [
                'type'        => Type::string(),
                'description' => 'Menu slug',
            ],
            'icon'        => [
                'type'        => Type::string(),
                'description' => 'Menu icon',
            ],
            'refer'       => [
                'type'        => Type::int(),
                'description' => 'Menu refer',
            ],
            'created_at'  => [
                'type'        => Type::string(),
                'description' => 'Menu created_at',
            ],
            'updated_at'  => [
                'type'        => Type::string(),
                'description' => 'Menu updated_at',
            ]
        ];
    }
}