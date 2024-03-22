<?php
// Définir un modèle
$model = ["id", "firstname", "lastname", "email", "password"];
// Données simulées pour les utilisateurs
$users = [
    [
        "id" => 1,
        "firstname" => "Martin",
        "lastname" => "Smith",
        "email" => "martin.smith@gmail.com",
        "password" => "martin56@",
        "secret_ket" => "bWFydGluNTZA"
    ],
    [
        "id" => 2,
        "firstname" => "Paul",
        "lastname" => "Dupont",
        "email" => "paul.dupont@gmail.com",
        "password" => "paul56@",
    ],
    [
        "id" => 3,
        "firstname" => "Alice",
        "lastname" => "Delarue",
        "email" => "alice.delarue@gmail.com",
        "password" => "alice56@",
    ],
    [
        "id" => 4,
        "firstname" => "Marie",
        "lastname" => "Louise",
        "email" => "marie.louise@gmail.com",
        "password" => "loulou56@",
    ],
];

// Fonction pour récupérer tous les utilisateurs
function getAll()
{
    global $users;
    if (empty($users)) {
        return [
            "code" => 200,
            "message" => "Aucun utilisateur n'a été trouvé"
        ];
    }
    return $users;

}

// Fonction pour récupérer un utilisateur spécifique
function getOne(int $id)
{
    global $users;
    foreach ($users as $key => $user) {
        if ($user["id"] === $id) {
            return $user;
        }
    }
    return [
        "code" => 200,
        "message" => "L'utilisateur avec id: $id n'existe pas!"
    ];
}
// Fonction pour créer un nouvel utilisateur
function create(array $user)
{
    global $users;
    global $model;
    $keys = array_keys($user);
    $diff = array_diff($model, $keys);
    if (empty($user)){
        http_response_code(400);
        return [
            "code" => 400,
            "message" => "Aucun utilisateur n'a été renseigné!"
        ];
    }
    if (count($diff) > 0){
        $message = "Il manque les valeurs:";
        $i = 0;
        foreach ($diff as $key => $value) {
            if ($key === array_keys($model, $value)[0] && $i===0){
                $message .= " $value";
                $i++;
                continue;
            }
            $message .= ", $value";
        }
        http_response_code(400);
        return [
            "code" => 400,
            "message" => $message
        ];
    } 
    http_response_code(201);
    $users[] = $user;
    return $user;
}

// Fonction pour mettre à jour un utilisateur existant
function update(int $id, array $updates)
{
    global $users;
    foreach ($users as $k => $user) {
        if ($user["id"] === $id) {
            foreach ($updates as $i => $update) {
                $users[$k][$i] = $update;
            }
            return $users;
        }
    }
    http_response_code(404);
    return [
        "code" => 404,
        "message" => "L'utilisateur avec ID: $id n'existe pas!"
    ];
}

// Fonction pour remplacer un utilisateur existant
function replace(int $id, array $puts){
    global $users;
    global $model;
    $keys = array_keys($puts);
    $diff = array_diff($model, $keys);
    if(count($diff) > 0){
        $message = "Il manque les valeurs:";
        $i = 0;
        foreach ($diff as $key => $value) {
            if ($key === array_keys($model, $value)[0] && $i === 0) {
                $message .= " $value";
                $i++;
                continue;
            }
            $message .= ", $value";
        }
        http_response_code(400);
        return [
            "code" => 400,
            "message" => $message
        ];
    }
    foreach ($users as $k => $user) {
        if ($user["id"] === $id) {
            $users[$k] = $puts;
            return $users;
        }
    }
    http_response_code(404);
    return [
        "code" => 404,
        "message" => "L'utilisateur avec ID: $id n'existe pas!"
    ];
}

// Fonction pour supprimer un utilisateur existant
function deleteOne($id)
{
    global $users;
    foreach ($users as $key => $user) {
        if ($user["id"] === $id) {
            unset($users[$key]);
            return $users;
        }
    }
    return [
        "code" => 404,
        "message" => "L'utilisateur avec ID: $id n'existe pas"
    ];
}
