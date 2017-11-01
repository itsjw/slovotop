<?php
declare(strict_types=1);

use Illuminate\Routing\Router;

/**
 * @var Router $router
 */

$router->group(['namespace' => 'Crm', 'prefix' => 'crm', 'middleware' => ['auth']], function (Router $router) {

    $router->get('home', 'CrmController@index')->name('crmHome');
    $router->get('settings', 'CrmController@settings')->name('crmSettings');
    $router->get('roles', 'CrmController@roles')->name('crmRoles');
    $router->get('users', 'CrmController@users')->name('crmUsers');
    $router->get('projects', 'CrmController@projects')->name('crmProjects');
    $router->get('tasks', 'CrmController@index')->name('crmTasks');

});

