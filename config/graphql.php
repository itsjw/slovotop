<?php
return [
    // The prefix for routes
    'prefix'          => 'apps',
    'routes'          => '{graphql_schema?}',
    'controllers'     => \Rebing\GraphQL\GraphQLController::class.'@query',
    'middleware'      => ['web'],
    'schemas'         => [
        'v1' => [
            'query'      => [],
            'mutation'   => [],
            'middleware' => ['auth'],
        ],
        'v2' => [
            'query'      => [
                // menu
                'MenuQuery'        => App\GraphQL\Query\Menu\MenuQuery::class,
                // user
                'UserQuery'        => App\GraphQL\Query\User\UserQuery::class,
                // role
                'RoleQuery'        => App\GraphQL\Query\Role\RoleQuery::class,
                // project
                'ProjectQuery'     => App\GraphQL\Query\Project\ProjectQuery::class,
                // doc
                'DocQuery'         => App\GraphQL\Query\Doc\DocQuery::class,
                // task subject
                'TaskSubjectQuery' => App\GraphQL\Query\TaskSubject\TaskSubjectQuery::class,
                // task stage
                'TaskStageQuery'   => App\GraphQL\Query\TaskStage\TaskStageQuery::class,
            ],
            'mutation'   => [
                // user
                'AddUserMutation'           => App\GraphQL\Mutation\User\AddUserMutation::class,
                'UpdateUserMutation'        => App\GraphQL\Mutation\User\UpdateUserMutation::class,
                'DeleteUserMutation'        => App\GraphQL\Mutation\User\DeleteUserMutation::class,
                'ApproveUserMutation'       => App\GraphQL\Mutation\User\ApproveUserMutation::class,
                // role
                'AddRoleMutation'           => App\GraphQL\Mutation\Role\AddRoleMutation::class,
                'DeleteRoleMutation'        => App\GraphQL\Mutation\Role\DeleteRoleMutation::class,
                // project
                'AddProjectMutation'        => App\GraphQL\Mutation\Project\AddProjectMutation::class,
                'DeleteProjectMutation'     => App\GraphQL\Mutation\Project\DeletProjectMutation::class,
                // access
                'ChangeAccessMenuMutation'  => App\GraphQL\Mutation\Access\ChangeAccessMenuMutation::class,
                // doc
                'AddDocMutation'            => App\GraphQL\Mutation\Doc\AddDocMutation::class,
                'DeleteDocMutation'         => App\GraphQL\Mutation\Doc\DeleteDocMutation::class,
                // task subject
                'AddTaskSubjectMutation'    => App\GraphQL\Mutation\TaskSubject\AddTaskStageMutation::class,
                'DeleteTaskSubjectMutation' => App\GraphQL\Mutation\TaskSubject\DeleteTaskStageMutation::class,
                // task stage
                'AddTaskStageMutation'      => App\GraphQL\Mutation\TaskStage\AddTaskStageMutation::class,
                'DeleteTaskStageMutation'   => App\GraphQL\Mutation\TaskStage\DeleteTaskStageMutation::class,
            ],
            'middleware' => ['auth'],
        ],
    ],
    'types'           => [
        'MenuType'        => App\GraphQL\Type\MenuType::class,
        'RoleType'        => App\GraphQL\Type\RoleType::class,
        'UserType'        => App\GraphQL\Type\UserType::class,
        'UserRoleType'    => App\GraphQL\Type\UserRoleType::class,
        'ProjectType'     => App\GraphQL\Type\ProjectType::class,
        'LastLoginType'   => App\GraphQL\Type\LastLoginType::class,
        'AccessType'      => App\GraphQL\Type\AccessType::class,
        'DocType'         => App\GraphQL\Type\DocType::class,
        'TaskSubjectType' => App\GraphQL\Type\TaskSubjectType::class,
        'TaskStageType'   => App\GraphQL\Type\TaskStageType::class,
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
