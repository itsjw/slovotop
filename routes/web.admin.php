<?php
declare(strict_types=1);

use Illuminate\Routing\Router;

/**
 * @var Router $router
 */

$router->group(['namespace' => 'Admin','prefix' => 'admin'], function (Router $router) {

    $router->get('/', 'AdminController@index');

});

