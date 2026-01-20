<?php
$route = $_GET['page'] ?? 'home';

switch($route) {
    case 'login': 
        require __DIR__ . '/../views/auth/login.php'; 
        break;
    case 'register': 
        require __DIR__ . '/../views/auth/register.php'; 
        break;
    case 'create': 
        require __DIR__ . '/../views/posts/create.php'; 
        break;
    case 'viewpost':
        require __DIR__ . '/../views/posts/viewpost.php';
        break;
    case 'edit':
        require __DIR__ . '/../views/posts/edit.php';
        break;
    default: 
        require __DIR__ . '/../views/posts/index.php'; 
        break;
}