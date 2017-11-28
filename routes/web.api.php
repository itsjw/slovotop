<?php
declare(strict_types=1);

use Illuminate\Routing\Router;

/**
 * @var Router $router
 */

$router->group(['namespace' => 'Crm', 'prefix' => 'api', 'middleware' => ['auth']], function (Router $router) {

    $router->post('getStageAccess', 'StageTaskController@getStageTaskAccess');

});

$router->group(['namespace' => 'Api', 'prefix' => 'v1', 'middleware' => ['auth']], function (Router $router) {

    $router->post('getUsers', 'UserController@getUsers');
    $router->post('saveUser', 'UserController@saveUser');
    $router->post('deleteUser', 'UserController@deleteUser');
    $router->post('approveUser', 'UserController@approveUser');

    $router->post('getRoles', 'RoleController@getRoles');

    $router->post('getSubjects', 'SubjectController@getSubjects');
    $router->post('saveSubject', 'SubjectController@saveSubject');
    $router->post('deleteSubject', 'SubjectController@deleteSubject');

    $router->post('getProjects', 'ProjectController@getProjects');
    $router->post('saveProject', 'ProjectController@saveProject');
    $router->post('deleteProject', 'ProjectController@deleteProject');

    $router->post('getDocs', 'DocController@getDocs');
    $router->post('saveDoc', 'DocController@saveDoc');
    $router->post('deleteDocs', 'DocController@deleteDocs');

});
