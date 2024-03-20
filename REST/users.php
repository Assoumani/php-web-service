<?php
// Données simulées pour les utilisateurs
$users = [
    [
        "id" => 1,
        "firstname" => "Martin",
        "lastname" => "Smith",
        "email" => "martin.smith@gmail.com",
        "password" => "martin56@",
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
function getAll(){
    global $users;
    return $users;
}

// Fonction pour récupérer un utilisateur spécifique
function getOne(int $id){
    global $users;
    foreach ($users as $key => $user) {
        if ($user["id"] === $id){
            return $user;
        }
    }
    return null;
}
// Fonction pour créer un nouvel utilisateur
function create(array $user){
    global $users;
    $users[] = $user;
    return $user;
}

// Fonction pour mettre à jour un utilisateur existant
function update(int $id, $updates){
    global $users;
    foreach ($users as $k => $user) {
        if ($user["id"] === $id){
            foreach ($updates as $i => $update) {
                $users[$k][$i] = $update;
            }
            return $user;
        }
    }
}

// Fonction pour supprimer un utilisateur existant
function delete($id){
    global $users;
    foreach ($users as $key => $user) {
        if ($user["id"] === $id) {
            unset($users[$key]);
            return "L'utilisateur avec ID: $id a bien été supprimé";
        }
    }
    return null;
}
