<?php

include '../vendor/autoload.php';

// Database Connection
include 'database.php';

// Setting view folder
$app = new \Slim\Slim(array(
    'templates.path' => './view'
));
 

 // Default route
$app->get('/', function(){
    echo "Welcome to Slim";
}); 

// Using view 
$app->get('/test-page', function() use ($app) {
    $app->render('/test-page.php');
});

// Simple parameter
$app->get('/halo/:nama', function($nama){
	echo "Halo {$nama}";
});

// REST API

// List all cities
$app->get('/cities', function() use ($app) {

	// Set JSON Header
	$app->response()->header('Content-Type', 'application/json;charset=utf-8');

	// Get all cities from databases
	$query = "SELECT * FROM Cities";

	$rs = mysql_query($query);

	if (!$rs) {
	    echo "Could not execute query: $query";
	    trigger_error(mysql_error(), E_USER_ERROR); 
	} 

	// Temporary array to store all cities 
	$cities = array();

	while ($row = mysql_fetch_assoc($rs)) {
	    array_push($cities,$row);
	}

	mysql_close();

	// Encode result to JSON
	echo json_encode($cities);
});

// Get city by ID
$app->get('/cities/:id', function($id) use ($app) {

	// Set JSON Header
	$app->response()->header('Content-Type', 'application/json;charset=utf-8');

	// Prepare SQL Injection	
	$id = mysql_real_escape_string($id);

	// Get city with ID = $id
	$query = "SELECT * FROM Cities WHERE ID={$id}";

	$rs = mysql_query($query);

	if (!$rs) {
	    echo "Could not execute query: $query";
	    trigger_error(mysql_error(), E_USER_ERROR); 
	} 

	// Check if result exist
	if(!mysql_num_rows($rs))
	{
		echo json_encode(array("message"=>"City with ID = {$id} not found"));
	}
	else
	{
		$row = mysql_fetch_assoc($rs);

		// Encode result to JSON
		echo json_encode($row);
	}
	
	mysql_close();

});

 
$app->run();