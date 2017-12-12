<?php
declare(strict_types=1);

use Illuminate\Routing\Router;

/**
 * @var Router $router
 */

$router->group(['namespace' => 'Api', 'prefix' => 'v1', 'middleware' => ['auth']], function (Router $router) {

    $router->group(['middleware' => 'accessRoute:settings'], function (Router $router) {
        // access
        $router->post('getTaskField', 'AccessController@getTaskField');
        $router->post('saveTaskFieldAccess', 'AccessController@saveTaskFieldAccess');
        // stage
        $router->post('getStages', 'StageController@getStages');
        $router->post('saveStage', 'StageController@saveStage');
        $router->post('deleteStage', 'StageController@deleteStage');
        // general
        $router->post('getGeneralSetting', 'SettingController@getGeneralSetting');
        $router->post('saveGeneralSetting', 'SettingController@saveGeneralSetting');
    });
    $router->post('getStageList', 'StageController@getStageList');

    // user
    $router->group(['middleware' => 'accessRoute:users'], function (Router $router) {
        $router->post('getUsers', 'UserController@getUsers');
        $router->post('saveUser', 'UserController@saveUser');
        $router->post('deleteUser', 'UserController@deleteUser');
        $router->post('approveUser', 'UserController@approveUser');
    });
    $router->post('getUserList', 'UserController@getUserList');

    // subject
    $router->group(['middleware' => 'accessRoute:subjects'], function (Router $router) {
        $router->post('getSubjects', 'SubjectController@getSubjects');
        $router->post('saveSubject', 'SubjectController@saveSubject');
        $router->post('deleteSubject', 'SubjectController@deleteSubject');
    });
    $router->post('getSubjectList', 'SubjectController@getSubjectList');

    // role
    $router->group(['middleware' => 'accessRoute:roles'], function (Router $router) {
        $router->post('getRoles', 'RoleController@getRoles');
        $router->post('saveRole', 'RoleController@saveRole');
        $router->post('deleteRole', 'RoleController@deleteRole');
        $router->post('saveAccessMenu', 'AccessController@saveAccessMenu');
        $router->post('saveStageRoleAccess', 'AccessController@saveStageRoleAccess');
    });

    // project
    $router->group(['middleware' => 'accessRoute:projects'], function (Router $router) {
        $router->post('getProjects', 'ProjectController@getProjects');
        $router->post('saveProject', 'ProjectController@saveProject');
        $router->post('deleteProject', 'ProjectController@deleteProject');
    });

    // task
    $router->group(['middleware' => 'accessRoute:tasks'], function (Router $router) {
        $router->post('getTasks', 'TaskController@getTasks');
        $router->post('getTask', 'TaskController@getTask');
        $router->post('saveTask', 'TaskController@saveTask');
        $router->post('deleteTask', 'TaskController@deleteTask');

        $router->post('getTaskComments', 'TaskController@getTaskComments');
        $router->post('saveTaskComment', 'TaskController@saveTaskComment');

        $router->post('getSteps', 'StepController@getSteps');
        $router->post('saveStep', 'StepController@saveStep');
    });

    // doc
    $router->group(['middleware' => 'accessRoute:docs'], function (Router $router) {
        $router->post('getDocs', 'DocController@getDocs');
        $router->post('saveDoc', 'DocController@saveDoc');
        $router->post('deleteDoc', 'DocController@deleteDoc');
    });

    $router->group(['middleware' => 'accessRoute:reports'], function (Router $router) {
        // report

    });

    // menu
    $router->post('getMenus', 'MenuController@getMenus');

});
