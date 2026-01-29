<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Thomas\PhpBlog\Config\Database;
use Thomas\PhpBlog\Models\PostModel;
use Thomas\PhpBlog\Services\ImageService;
use Thomas\PhpBlog\Controllers\PostController;
use Thomas\PhpBlog\Controllers\AuthController;
use Thomas\PhpBlog\Services\AuthService;
use Thomas\PhpBlog\Models\UserModel;

use Thomas\PhpBlog\Config\Router;

session_start();
$pdo = Database::getConnection();

$postModel = new PostModel($pdo);
$imageService = new ImageService();

$userModel = new UserModel($pdo);
$authService = new AuthService();
$userController = new AuthController($userModel, $authService);

$controller = new PostController($postModel, $imageService);


$router = new Router();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];


$segments = explode('/', trim($uri, '/'));
$id = (isset($segments[1]) && is_numeric($segments[1])) ? (int) $segments[1] : null;

// Post routes
$router->get('/', action: fn() => $controller->fetch());
$router->get('/create', fn() => $controller->create());
$router->post('/posts/store', fn() => $controller->store());

if ($id) {
    $router->get("/post/$id", fn() => $controller->fetchViaID($id));
    $router->get("/edit/$id", fn() => $controller->edit($id));
    $router->post("/update/$id", fn() => $controller->update($id));
}


// User routes
$router->get("/register", fn() => $userController->create());
$router->post('/users/store', fn() => $userController->storeUser());
$router->get('/login', fn() => $userController->login()); // shows the form
$router->post('/login', fn() => $userController->loginAuth()); // handle login
$router->post('/logout', fn() => $userController->logout()); // handles logout



$action = $router->resolve($uri, $method);
if (is_callable($action)) {
    $action();
} else {
    http_response_code(404);
    echo "404 - Page Not Found";
    exit;

}







