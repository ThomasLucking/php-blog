<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Thomas\PhpBlog\Config\Database;
use Thomas\PhpBlog\Models\PostModel;
use Thomas\PhpBlog\Services\ImageService;
use Thomas\PhpBlog\Controllers\PostController;
use Thomas\PhpBlog\Config\Router;

$pdo = Database::getConnection();
$postModel = new PostModel($pdo);
$imageService = new ImageService();
$router = new Router();

$controller = new PostController($postModel, $imageService);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];


$segments = explode('/', trim($uri, '/'));
$id = (isset($segments[1]) && is_numeric($segments[1])) ? (int) $segments[1] : null;


$router->get('/', fn() => $controller->fetch());
$router->get('/create', fn() => $controller->create());
$router->post('/posts/store', fn() => $controller->store());

if ($id) {
    $router->get("/post/$id", fn() => $controller->fetchViaID($id));
    $router->get("/edit/$id", fn() => $controller->edit($id));
    $router->post("/update/$id", fn() => $controller->update($id));
}


$action = $router->resolve($uri, $method);
if (is_callable($action)) {
    $action();
} else {
    http_response_code(404);
    echo "404 - Page Not Found";
    exit;

}







