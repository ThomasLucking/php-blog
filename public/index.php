<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Thomas\PhpBlog\Config\Database;
use Thomas\PhpBlog\Config\Response;
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
$id = filter_var($segments[1], FILTER_SANITIZE_NUMBER_INT);

$router->get('/create', function () use ($controller) {
    $controller->create();
    Response::redirect('http://localhost:8000/create');

});

$router->get('/', fn() => $controller->fetch());

$router->get('/edit/' . $id, fn() => $controller->edit());


$router->post('/update/' . $id, function () use ($controller) {
    $controller->update();
    Response::redirect('/');
});

$router->post('/posts/store', function () use ($controller) {
    $controller->store();
    Response::redirect('/');
});


$router->post('/create', fn() => $controller->store());

$action = $router->resolve($_SERVER['REQUEST_URI'], method: $_SERVER['REQUEST_METHOD']);
$action();

http_response_code(404);
echo "404 - Page Not Found";



