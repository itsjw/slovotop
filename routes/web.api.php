<?php
declare(strict_types=1);

use Illuminate\Routing\Router;

/**
 * @var Router $router
 */

$router->group(['namespace' => 'Crm', 'prefix' => 'api', 'middleware' => ['auth']], function (Router $router) {

    $router->post('getStageAccess', 'StageTaskController@getStageTaskAccess');

});