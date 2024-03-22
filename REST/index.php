<?php
use Firebase\JWT\JWT;

// Inclure le fichier de logique des utilisateurs
require "./users.php";
require "./security.php";
require "./test.php";
// var_dump(base64_decode("bWFydGluNTZA"));
// die();

// Récupérer la méthode HTTP et l'URI
$uri = $_SERVER["REQUEST_URI"];
$method = $_SERVER["REQUEST_METHOD"];
$check = false;

// ajouter le header "application/json" à destination des navigateurs
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

// vérification du JWT
function verify()
{
    global $check;
    $headers = getallheaders();
    $token = explode(" ", $headers["Authorization"])[1];
    $secret_key = "bWFydGluNTZA";
    try {
        $check = validate_token($token, $secret_key);
    } catch (\Throwable $th) {
        echo json_encode([
            "code" => 401,
            "message" => "Authentification échouée!"
        ]);
        die();
    }
}

// Routeur pour les différentes opérations CRUD
switch ($method) {
    case 'GET':
        global $check;
        verify();
        if ($check) {
            preg_match("/^\/PHP-WEB-SERVICE\/REST\/users\/?(\d+)?$/", $uri, $matches);
            if (!empty ($matches) && !array_key_exists(1, $matches)) {
                $users = getAll();
                echo json_encode($users);
                break;
            }
            if (array_key_exists(1, $matches)) {
                $user = getOne((int) $matches[1]);
                echo json_encode($user);
                break;
            }
        }
        echo json_encode([
            "code" => 403,
            "message" => "accès non autorisé"
        ]);
        break;
    case 'POST':
        $user = $_POST;
        preg_match("/^\/PHP-WEB-SERVICE\/REST\/(users||register||login)\/?(\d+)?$/", $uri, $matches);
        if ($matches[1] === "users") {
            $user = create($user);
            echo json_encode($user);
        }
        if ($matches[1] === "register") {
            $passwordEncoded = base64_encode($user['password']);
            try {
                $token = generateToken($passwordEncoded, $user['email']);
                echo json_encode([
                    "token" => $token
                ]);
            } catch (\Throwable $th) {
                echo json_encode([
                    "code" => 401,
                    "message" => "Authentification échouée!"
                ]);
            }
        }
        if ($matches[1] === "login") {
            $passwordEncoded = null;
            foreach ($users as $item) {
                if ($item["email"] === $user['email']){
                    if($item["password"] === $user['password']){
                        $passwordEncoded = base64_encode($user['password']);
                    }
                }
            }
            try {
                $token = generateToken($passwordEncoded, $user['email']);
                echo json_encode([
                    "token" => $token
                ]);
            } catch (\Throwable $th) {
                echo json_encode([
                    "code" => 401,
                    "message" => "Authentification échouée!"
                ]);
            }
        }

        break;

    case 'PATCH':
        preg_match("/^\/PHP-WEB-SERVICE\/REST\/users\/?(\d+)?$/", $uri, $matches);
        $id = (int) $matches[1];
        $updates = file_get_contents("php://input");
        $items = explode('&', $updates);
        $data = [];
        foreach ($items as $item) {
            $inputs = explode("=", $item);
            $data[$inputs[0]] = $inputs[1];
        }

        $result = update($id, $data);
        echo json_encode($result);
        break;

    case 'PUT':
        preg_match("/^\/PHP-WEB-SERVICE\/REST\/users\/?(\d+)?$/", $uri, $matches);
        $id = (int) $matches[1];
        $updates = file_get_contents("php://input");
        $items = explode('&', $updates);
        $data = [];
        foreach ($items as $item) {
            $inputs = explode("=", $item);
            $data[$inputs[0]] = $inputs[1];
        }
        $result = replace($id, $data);
        echo json_encode($result);
        break;
    case 'DELETE':
        preg_match("/^\/PHP-WEB-SERVICE\/REST\/users\/?(\d+)?$/", $uri, $matches);
        $id = (int) $matches[1];
        $result = deleteOne($id);
        echo json_encode($result);
        break;

    default:
        http_response_code(404);
        echo json_encode([
            'code' => 404,
            'message' => 'Ressource non trouvé'
        ]);
        break;
}


// echo '<pre>';
// var_dump($uri, $method);
// echo '</pre>';