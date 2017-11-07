<?php
declare(strict_types=1);

namespace App\GraphQL\Type;

use App\Models\LastLogin;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

/**
 * Class LastLoginType
 *
 * @package App\GraphQL\Type
 */
class LastLoginType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'LastLoginType',
        'description' => 'A type',
        'model'       => LastLogin::class,
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id'         => [
                'type'        => Type::nonNull(Type::id()),
                'description' => 'LastLogin ID',
            ],
            'user'       => [
                'type'        => \GraphQL::type('UserType'),
                'description' => 'LastLogin name',
            ],
            'created_at' => [
                'type'        => Type::string(),
                'description' => 'LastLogin created_at',
            ],
            'updated_at' => [
                'type'        => Type::string(),
                'description' => 'LastLogin updated_at',
            ],
            'notify'     => [
                'type'        => Type::string(),
                'description' => 'notify',
                'selectable'  => false,
            ],
        ];
    }
}