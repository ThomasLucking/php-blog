<?php


require_once __DIR__ . '/../vendor/autoload.php';
use Thomas\PhpBlog\Config\Database;
use Thomas\PhpBlog\Models\PostModel;
use Thomas\PhpBlog\Services\ImageService;
use Thomas\PhpBlog\Controllers\PostController;


$pdo = Database::getConnection();
$postModel = new PostModel($pdo);
$imageService = new ImageService();


$controller = new PostController($postModel, $imageService);


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$page = $_GET['page'];



if ($page === 'create' && $method === 'GET') {
    $controller->create();
    exit;
}
if ($uri === '/posts/store' && $method === 'POST') {
    $controller->store();
    exit;
}
if ($uri === '/') {
    $controller->fetch();
    exit;
}

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

    http_response_code(404);

}
