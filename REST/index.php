<?php
// Inclure le fichier de logique des utilisateurs
require "./users.php";

// Récupérer la méthode HTTP et l'URI
$uri = $_SERVER["REQUEST_URI"];
$method = $_SERVER["REQUEST_METHOD"];
// Routeur pour les différentes opérations CRUD
switch ($method) {
    case 'GET':
        preg_match("/^\/PHP-WEB-SERVICE\/REST\/users\/?(\d+)?$/", $uri, $matches);
        if (!empty ($matches) && !array_key_exists(1, $matches)) {
            $users = getAll();
            var_dump("getAll", $matches);
            echo '<pre>';
            var_dump($users);
            echo '</pre>';
        }
        if(array_key_exists(1, $matches)){
            $user = getOne((int)$matches[1]);
            var_dump("getOne", $matches);
            echo '<pre>';
            var_dump($user);
            echo '</pre>';
        }
        break;

    default:
        http_response_code(404);
        echo 'ressource introuvable';
        break;
}


// echo '<pre>';
// var_dump($uri, $method);
// echo '</pre>';