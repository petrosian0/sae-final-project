<?php
    
    $uri = $_SERVER['REQUEST_URI'];
    
    // place to store all routes
    $routes = [];
    
    // abort function
    function abort($code = 404) {
        http_response_code($code);
        die();
    }
    
    // check if the route exists
    function routeToController($uri, $routes) {
        if(array_key_exists($uri, $routes)) {
            require $routes[$uri];
        } else {
            abort();
        }
    }
    
    routeToController($uri, $routes);