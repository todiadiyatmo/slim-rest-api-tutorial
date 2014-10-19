<?php

include '../vendor/autoload.php';

// Setting view folder
$app = new \Slim\Slim(array(
    'templates.path' => './view'
));
 
 // Default route
$app->get('/', function(){
    echo "Welcome to Slim";
}); 

 // Default route
$app->get('/cities', function(){

	$headers = array('Accept' => 'application/json');
	$options = array('auth' => array('user', 'pass'));
	$request = Requests::get('https://api.github.com/gists', $headers, $options);

	var_dump($request->status_code);
	// int(200)

	var_dump($request->headers['content-type']);
	// string(31) "application/json; charset=utf-8"

	var_dump($request->body);
	// string(26891) "[...]"
    
}); 




 
$app->run();