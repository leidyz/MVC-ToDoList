<?php 

/**
 * Used to define the routes in the system.
 * 
 * A route should be defined with a key matching the URL and an
 * controller#action-to-call method. E.g.:
 * 
 * '/' => 'index#index',
 * '/calendar' => 'calendar#index'
 */
$routes = array(
    '/' => 'App_#index',
    '/getAllTask' => 'App_#getAllTask',
    '/createTask' => 'App_#createTask',
    '/editTask' => 'App_#editTask',
    '/deleteTask' => 'App_#deleteTask',
    '/saveTask' => 'App_#saveTask',
	'/editTaskModal' => 'App_#editTaskModal',
	
);

	