<?php

/**
 * Define your routes here.
 * Format: $router->get('uri', 'Controller@method');
 */

$router->get('home', 'PostController@index');
$router->get('post/create', 'PostController@create');
$router->post('post/store', 'PostController@store');
$router->get('post/edit/{id}', 'PostController@edit');
$router->post('post/update', 'PostController@update');
$router->get('post/delete/{id}', 'PostController@delete');