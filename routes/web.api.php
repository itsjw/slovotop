<?php
declare(strict_types=1);

use Illuminate\Routing\Router;

/**
 * @var Router $router
 */

$router->group(['namespace' => 'Api', 'prefix' => 'v1', 'middleware' => ['auth']], function (Router $router) {

    // user
    $router->post('getUsers', 'UserController@getUsers');
    $router->post('saveUser', 'UserController@saveUser');
    $router->post('deleteUser', 'UserController@deleteUser');
    $router->post('approveUser', 'UserController@approveUser');
    // role
    $router->post('getRoles', 'RoleController@getRoles');
    $router->post('saveRole', 'RoleController@saveRole');
    $router->post('deleteRole', 'RoleController@deleteRole');
    // subject
    $router->post('getSubjects', 'SubjectController@getSubjects');
    $router->post('saveSubject', 'SubjectController@saveSubject');
    $router->post('deleteSubject', 'SubjectController@deleteSubject');
    // project
    $router->post('getProjects', 'ProjectController@getProjects');
    $router->post('saveProject', 'ProjectController@saveProject');
    $router->post('deleteProject', 'ProjectController@deleteProject');
    // doc
    $router->post('getDocs', 'DocController@getDocs');
    $router->post('saveDoc', 'DocController@saveDoc');
    $router->post('deleteDoc', 'DocController@deleteDoc');
    // menu
    $router->post('getMenus', 'MenuController@getMenus');
    // access
    $router->post('saveAccessMenu', 'AccessController@saveAccessMenu');
    $router->post('getTaskField', 'AccessController@getTaskField');
    $router->post('saveTaskFieldAccess', 'AccessController@saveTaskFieldAccess');
    // stage
    $router->post('getStages', 'StageController@getStages');
    $router->post('saveStage', 'StageController@saveStage');

});
