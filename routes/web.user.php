<?php
declare(strict_types=1);

use Illuminate\Routing\Router;

/**
 * @var Router $router
 */

$router->group(['namespace' => 'User', 'prefix' => 'user', 'middleware' => ['auth']], function (Router $router) {

    $router->get('home', 'UserController@index')->name('userHome');

});

