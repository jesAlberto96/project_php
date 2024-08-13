<?php

// require_once 'controllers/UserController.php';
// require_once 'controllers/ProductController.php';
// require_once 'controllers/HomeController.php';

// function route($url, $method) {
//     $url = trim($url, '/');
//     $identity = $url;
//     if ($url == ''){
//         $identity = 'home';
//     }

//     // Definir rutas y métodos
//     $routes = require_once "$identity/routes.php";

//     // $routes = [
//     //     'GET' => [
//     //         '' => 'HomeController@index',
//     //         'home' => 'HomeController@index',
//     //     ],
//     //     // 'POST' => [
//     //     //     'user' => 'UserController@create', // Expecting /user
//     //     //     'product' => 'ProductController@create' // Expecting /product
//     //     // ],
//     //     // 'PUT' => [
//     //     //     'user' => 'UserController@update', // Expecting /user/{id}
//     //     //     'product' => 'ProductController@update' // Expecting /product/{id}
//     //     // ],
//     //     // 'DELETE' => [
//     //     //     'user' => 'UserController@delete', // Expecting /user/{id}
//     //     //     'product' => 'ProductController@delete' // Expecting /product/{id}
//     //     // ]
//     // ];

//     $parts = explode('/', $url);
//     $controller = $parts[0] . 'Controller';
//     $methodName = 'index';

//     if (isset($routes[$method][$parts[0]])) {
//         list($controller, $methodName) = explode('@', $routes[$method][$parts[0]]);
//     }

//     if (class_exists($controller) && method_exists($controller, $methodName)) {
//         $controllerInstance = new $controller();

//         // Pasar parámetros si existen
//         if (isset($parts[1])) {
//             $controllerInstance->$methodName($parts[1]);
//         } else {
//             $controllerInstance->$methodName();
//         }
//     } else {
//         http_response_code(404);
//         echo "Página no encontrada";
//     }
// }


function route($url, $method) {
    $url = trim($url, '/');

    $identity = $url;
    if ($url == ''){
        $identity = 'home';
    } else {
        $identity = explode("/", $url)[0];
    }

    if (!file_exists(__DIR__ . "/$identity/routes.php")){
        http_response_code(404);
        echo "Página no encontrada";
        return false;
    }

    // Definir rutas y métodos
    $routes = require_once "$identity/routes.php";

    // Convertir la URL en partes
    $parts = explode('/', $url);

    // Encontrar la ruta que coincida
    $matchedRoute = null;
    $parameters = [];

    foreach ($routes[$method] as $routePattern => $action) {
        // Dividir la ruta en partes
        $routeParts = explode('/', $routePattern);

        // Verificar si la ruta coincide
        if (count($routeParts) === count($parts)) {
            $match = true;
            $parameters = [];

            foreach ($routeParts as $i => $part) {
                if (strpos($part, '{') === 0 && strpos($part, '}') === strlen($part) - 1) {
                    $parameters[] = $parts[$i];
                } elseif ($part !== $parts[$i]) {
                    $match = false;
                    break;
                }
            }

            if ($match) {
                $matchedRoute = $action;
                break;
            }
        }
    }

    if ($matchedRoute) {
        list($controller, $methodName) = explode('@', $matchedRoute);
        $controllerInstance = new $controller();

        // Pasar parámetros al método del controlador
        call_user_func_array([$controllerInstance, $methodName], $parameters);
    } else {
        http_response_code(404);
        echo "Página no encontrada";
    }
}