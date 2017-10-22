<?php
return [
    // The prefix for routes
    'prefix'          => 'apps',
    'routes'          => '{graphql_schema?}',
    'controllers'     => \Rebing\GraphQL\GraphQLController::class.'@query',
    'middleware'      => [],
    'schemas'         => [
        'v1' => [
            'query'      => [
                'UserQuery' => App\GraphQL\Query\UserQuery::class,
            ],
            'mutation'   => [],
            'middleware' => ['web','isAdmin'],
        ],
        'v2' => [
            'query'      => [],
            'mutation'   => [],
            'middleware' => ['web'],
        ],
    ],
    'types'           => [
        'RoleType'     => App\GraphQL\Type\RoleType::class,
        'UserType'     => App\GraphQL\Type\UserType::class,
        'UserRoleType' => App\GraphQL\Type\UserRoleType::class,
    ],

    // This callable will be passed the Error object for each errors GraphQL catch.
    // The method should return an array representing the error.
    // Typically:
    // [
    //     'message' => '',
    //     'locations' => []
    // ]
    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],

    // You can set the key, which will be used to retrieve the dynamic variables
    'params_key'      => 'params',

];
