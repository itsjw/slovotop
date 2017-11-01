<?php
declare(strict_types=1);

use Illuminate\Routing\Router;

/**
 * @var Router $router
 */

$router->group(['namespace' => 'Site'], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

});

require __DIR__.'/web.crm.php';
require __DIR__.'/web.auth.php';


$router->get('test','TestController@index');