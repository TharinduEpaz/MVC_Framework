<?php

// require '../App/Controllers/Posts.php';
//require must be used instead of include because the router is essential for the framwork
// require '../Core/router.php';

//this autoload function will be auto load  and require the necessary files when a new object is created
spl_autoload_register(function($class){
    $root = dirname(__DIR__);
    $file = $root . '/' . str_replace('\\','/',$class) . '.php';
    if(is_readable($file)){
        require $root . '/' . str_replace('\\','/',$class) . '.php';
    }

});

$router = new Core\router;

//calling the add methods defined in the router 
$router->add('',['controller'=> 'Home','action'=>'index']);
$router->add('posts',['controller'=> 'posts','action'=>'index']);
$router->add('login',['controller'=> 'login','action'=>'index']);

//$router->add('posts/new',['controller'=> 'Posts','action'=>'new']);
$router->add('{controller}/{action}');
$router->add('admin/{action}/{controller}');

$router->add('{controller}/{id:\d+}/{action}');

// $_SERVER is a PHP super global variable which holds information about headers, paths, and script locations.
// $_SERVER['QUERY_STRING']	Returns the query string if the page is accessed via a query string

$url = $_SERVER['QUERY_STRING'];

// if($router->match($url)){
//     echo '<pre>';
//     var_dump($router->getParams());
//     echo '</pre>';
// } 
// else{
//     echo 'NO route found';
// }

// echo '<pre>';
// echo htmlspecialchars(print_r($router->getRoutes(),true));
// echo '</pre>';

$router->dispatch($_SERVER['QUERY_STRING']); 

