<?php
declare(strict_types=1);

use Illuminate\Routing\Router;

/**
 * @var Router $router
 */

$router->group(['namespace' => 'User', 'prefix' => 'user', 'middleware' => ['auth', 'NoAdmin']],
    function (Router $router) {

        $router->get('home', 'UserController@index')->name('userHome');
        $router->get('settings', 'UserController@settings')->name('userSettings');
        $router->get('projects', 'UserController@projects')->name('userProjects');
        $router->get('tasks', 'UserController@index')->name('userTasks');

    });

