<?php
$routes = [
    'home' => __DIR__ . '/../views/posts/index.php',
    'login' => __DIR__ . '/../views/auth/login.php',
    'register' => __DIR__ . '/../views/auth/register.php',
    'create' => __DIR__ . '/../views/posts/create.php',
    'viewpost' => __DIR__ . '/../views/posts/viewpost.php',
    'edit' => __DIR__ . '/../views/posts/edit.php',
];

$route = $_GET['page'] ?? 'home';

if (array_key_exists($route, $routes)) {
    require $routes[$route];
} else {
    // Optionally, show a 404 page
    http_response_code(404);
    // require __DIR__ . '/../views/errors/404.php';
}
