<?php

namespace Thomas\PhpBlog\Controllers;

use Thomas\PhpBlog\Config\Flash;
use Thomas\PhpBlog\Models\PostModel;

use Thomas\PhpBlog\Services\ImageService;
use Thomas\PhpBlog\Config\Redirector as Redirector;

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
        $posts = $this->model->linkPostsWithCategory();

        require_once __DIR__ . "/../../views/posts/index.php";

    }

    public function update(int $id)
    {
        $filteredData = filter_input_array(INPUT_POST, [
            'title' => FILTER_SANITIZE_SPECIAL_CHARS,
            'content' => FILTER_SANITIZE_SPECIAL_CHARS,
            'category_id' => FILTER_VALIDATE_INT
        ]);


        if (isset($_FILES['cover_photo']) && $_FILES['cover_photo']['error'] === UPLOAD_ERR_OK) {
            $filteredData['image'] = $this->imageService->handleUpload($_FILES['cover_photo']);
        }


        $updateData = array_filter($filteredData, fn($value) => !is_null($value));


        $this->model->update($id, $updateData);

        Flash::setValue("notification", ["type" => "success", "message" => "Post updated!"]);
        Redirector::redirect('/');
    }

    public function edit(int $id)
    {
        $post = $this->model->findId($id);
        $categories = $this->model->getAllCategories();

        if (!$post) {
            Redirector::redirect('/');
        }

        require_once __DIR__ . "/../../views/posts/edit.php";
    }

    public function fetchViaID(int $id)
    {
        $post = $this->model->findId($id);

        if (!$post) {
            http_response_code(404);
            require_once __DIR__ . "/../../views/404.php";
            return;
        }


        require_once __DIR__ . "/../../views/posts/viewpost.php";
    }

    public function store(): void
    {
        $error = [];

        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            Redirector::redirect("/create");

        }

        $filteredData = filter_input_array(INPUT_POST, [
            "title" => FILTER_SANITIZE_SPECIAL_CHARS,
            "content" => FILTER_SANITIZE_SPECIAL_CHARS,


        ]);

        $filteredOptions = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_SPECIAL_CHARS);

        $imagePath = $this->imageService->handleUpload($_FILES['cover_photo'] ?? null);

        $userid = $_SESSION['user_id'];


        if (!$filteredData['title']) {
            $error['title'] = "Title is required.";
        }

        if (!$filteredData['content']) {
            $error['content'] = "Content is required.";
        }

        if (!$imagePath) {
            $error['cover_photo'] = "Image is required.";
        }

        if (!empty($error)) {
            Redirector::redirect("/create");
        }
        $selectedId = $this->model->insertcategories(['name' => $filteredOptions]);

        $postData = [
            "title" => $filteredData["title"],
            "content" => $filteredData["content"],
            "image" => $imagePath,
            "user_id" => $userid,
            "category_id" => $selectedId,

        ];

        $this->model->create($postData);

        Flash::setValue("notification", [
            "type" => "success",
            "message" => "Successfully created post!"
        ]);

        Redirector::redirect("/");


    }



}


