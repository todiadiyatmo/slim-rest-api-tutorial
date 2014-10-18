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
 
$app->run();