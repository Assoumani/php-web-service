<?php
// inclure le fichier "products.php"
require "./products.php";

// Définir les fonctions pemettant d'implémenter nos fonctionnalités
function getAll(){
    global $products;
    return $products;
}

function create(array $product){
    global $products;
    $products[] = $product;
    return $products;
}

function delete(int $id){
    global $products;
    foreach ($products as $key => $product) {
        if ($product["id"] === $id){
            unset($products[$key]);
        }
    }
    return $products;
}

function update(int $id, array $updates){
    global $products;
    // retrouver le produit à modifier via l'ID
    foreach ($products as $key => $product) {
        if ($product["id"] === $id) {
            // faire la modification
            foreach ($updates as $key2 => $value) {
                $products[$key][$key2] = $value;
            }
        }
    }
    return $products;
}
// Création du serveur SOAP
$options = [
    'uri' => 'http://localhost/PHP-WEB-SERVICE/TP',
    'encoding' => 'UTF8'
];
$server = new SoapServer(null, $options);
// Enregistrement des fonctions dans le serveur
$server->addFunction(['getAll', 'create', 'delete', 'update']);
// Lancement du serveur 
$server->handle();