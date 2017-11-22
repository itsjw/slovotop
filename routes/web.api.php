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

    $router->post('getUser','UserController@getUser');

});
