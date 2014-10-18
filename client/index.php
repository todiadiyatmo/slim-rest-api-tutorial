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
 
$app->run();