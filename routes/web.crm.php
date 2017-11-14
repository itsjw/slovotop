<?php
declare(strict_types=1);

use Illuminate\Routing\Router;

/**
 * @var Router $router
 */

$router->group(['namespace' => 'Crm', 'prefix' => 'crm', 'middleware' => ['auth', 'accessRoute']],
    function (Router $router) {

        $router->get('home', 'CrmController@index')->name('crmHome');
        $router->get('settings', 'CrmController@settings')->name('crmSettings');
        $router->get('subjects', 'CrmController@subjects')->name('crmSubjects');
        $router->get('roles', 'CrmController@roles')->name('crmRoles');
        $router->get('users', 'CrmController@users')->name('crmUsers');
        $router->get('projects', 'CrmController@projects')->name('crmProjects');
        $router->get('tasks', 'CrmController@tasks')->name('crmTasks');
        $router->get('tasks/task/{id?}', 'CrmController@taskEdit')->name('crmTask');
        $router->get('docs', 'CrmController@docs')->name('crmDocs');
        $router->get('docs/doc/{id?}', 'CrmController@docEdit')->name('crmDoc');
        $router->get('reports', 'CrmController@reports')->name('crmReports');

    });

