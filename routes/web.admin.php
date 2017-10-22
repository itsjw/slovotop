<?php
declare(strict_types=1);

use Illuminate\Routing\Router;

/**
 * @var Router $router
 */

$router->group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']],
    function (Router $router) {

        $router->get('home', 'AdminController@index')->name('adminHome');
        $router->get('settings', 'AdminController@index')->name('adminSettings');
        $router->get('users', 'AdminController@users')->name('adminUsers');
        $router->get('projects', 'AdminController@index')->name('adminProjects');
        $router->get('tasks', 'AdminController@index')->name('adminTasks');

    });

