<?php

namespace Thomas\PhpBlog\Services;

class ImageService
{
    public function handleUpload(array $file)
    {
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $tmp_name = $_FILES["cover_photo"]["tmp_name"];


        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $tmp_name);
        finfo_close($finfo);

        $allowed = ["image/jpeg", "image/png"];
        if (!in_array($mimeType, $allowed)) {
            die("Invalid file type. Only JPG and PNG allowed.");
        }

        $upload_dir = __DIR__ . "/../../public/uploads/";
        $original_name = basename($_FILES["cover_photo"]["name"]);
        $extension = pathinfo($original_name, PATHINFO_EXTENSION);

        $newName = bin2hex(random_bytes(10)) . "." . $extension;

        $success = move_uploaded_file($tmp_name, $upload_dir . $newName);

        if ($success) {
            return $newName;
        }
    }
}
