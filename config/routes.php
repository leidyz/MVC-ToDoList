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
	'/' => 'index#index',
	'/createTask'=>'options#createTask',
	'/getAllTaskWithDetails'=> 'options#getAllTaskWithDetails',
	'/deleteTask'=> 'options#deleteTask',
	'/editTask'=> 'options#editTask',
	'/saveTask'=> 'options#saveTask',

);

	