<?php
declare(strict_types=1);

use Illuminate\Routing\Router;

/**
 * @var Router $router
 */

$router->group(['namespace' => 'Auth'], function (Router $router) {

    $router->get('login', 'LoginController@index')->name('login');
    $router->post('auth', 'LoginController@auth')->name('auth');

    $router->group(['middleware' => ['auth']], function (Router $router) {
        $router->get('logout', 'LoginController@logout')->name('logout');
    });

});

