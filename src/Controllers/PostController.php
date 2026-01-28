<?php

namespace Thomas\PhpBlog\Controllers;

use Thomas\PhpBlog\Models\PostModel;
use Thomas\PhpBlog\Services\ImageService;
use Thomas\PhpBlog\Config\Response;
class PostController
{
    public function __construct(
        private PostModel $model,
        private ImageService $imageService,

    ) {
    }

    

    public function create()
    {
        require_once __DIR__ . "/../../views/posts/create.php";
    }
    public function fetch()
    {
        $posts = $this->model->fetchall();
        require_once __DIR__ . "/../../views/posts/index.php";


    }
    public function update()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $segments = explode('/', trim($uri, '/'));

        $id = filter_var($segments[1], FILTER_SANITIZE_NUMBER_INT);
        $updateData = [];

        
        if (!empty($_POST['title'])) {
            $updateData['title'] = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        }

        if (!empty($_POST['content'])) {
            $updateData['content'] = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if (isset($_FILES['cover_photo']) && $_FILES['cover_photo']['error'] === UPLOAD_ERR_OK) {
            $updateData['image'] = $this->imageService->handleUpload($_FILES['cover_photo']);
        }


        $this->model->update($id, $updateData);
        Response::redirect('/');

    }

    public function edit()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $segments = explode('/', trim($uri, '/'));

        $id = filter_var($segments[1], FILTER_SANITIZE_NUMBER_INT);

        $post = $this->model->findId($id);

        if (!$post) {
            header("Location: /");
            exit;
        }

        require_once __DIR__ . "/../../views/posts/edit.php";
    }

    public function fetchViaID()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $segments = explode('/', trim($uri, '/'));

        $id = filter_var($segments[1], FILTER_SANITIZE_NUMBER_INT);

        $post = $this->model->findId($id);
        require_once __DIR__ . "/../../views/posts/viewpost.php";
        

    }

    public function store(): never
    {
        $error = [];


        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            header("Location: /posts/create");

        }

        $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS);
        if (!$title) {
            $error['title'] = "Title is required.";

        }
        $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_SPECIAL_CHARS);
        if (!$content) {
            $error["content"] = "content is required";

        }

        $imagePath = $this->imageService->handleUpload($_FILES['cover_photo'] ?? null);

        if (!$imagePath) {
            $error["cover_photo"] = 'image is required';

        }
        if (!empty($error)) {
            require_once __DIR__ . "/../../views/posts/create.php";
            exit;
        }

        $postData = [
            "title" => $title,
            "content" => $content,
            "image" => $imagePath,
            "user_id" => 1,

        ];

        $this->model->create($postData);
        header("Location: /");
        exit;

    }

}


