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
});

$router->get('/', fn() => $controller->fetch());

$router->get('/edit/' . $id, fn() => $controller->edit());


$action = $segments[0] ?? ''; // 'update', 'edit', etc.
$id = $segments[1] ?? null;

if($id && is_numeric($id)) {
    $router->post('/update/' . $id, function () use ($controller) {
        $controller->update();
        Response::redirect('/');
    });
}

$router->post('/posts/store', function () use ($controller) {
    $controller->store();
    Response::redirect('/');
});


if ($segments[0] === 'post' && isset($segments[1])) {
    $currentId = $segments[1];
    $router->get('/post/' . $currentId, function () use ($controller) {
        $controller->fetchViaID();
    });
}

$router->post('/create', fn() => $controller->store());

$action = $router->resolve($_SERVER['REQUEST_URI'], method: $_SERVER['REQUEST_METHOD']);
if (is_callable($action)) {
    $action();
} else {
    http_response_code(404);
    echo "404 - Page Not Found";
    exit;
}

http_response_code(404);
echo "404 - Page Not Found";



