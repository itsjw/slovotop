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

    $router->post('getRoles', 'RoleController@getRoles');

});
