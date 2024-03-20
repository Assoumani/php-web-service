<?php

// Définition des fonctions du service (ex. fonction addition)
function addition(int $a, int $b){
    return $a + $b;
}
function soustraction(int $a, int $b){
    return $a - $b;
}
// Création du serveur SOAP
// Définition du tableau d'options (uri, encoding, ...)
$options = [
    'uri' => 'http://localhost/PHP-WEB-SERVICE/client',
    'encoding' => "UTF8"
];
$options2 = [
    'uri' => 'http://localhost/PHP-WEB-SERVICE/client2',
    'encoding' => "UTF8"
];
// Instancier le serveur avec la classe SoapServer de PHP
$server = new SoapServer(null, $options);
$server2 = new SoapServer(null, $options2);
// Définition des méthodes du service avec la fonction addFunction
$server->addFunction('addition');
$server2->addFunction('soustraction');
// Lancement du serveur pour la gestion des requêtes SOAP
// $server->handle();
$server2->handle();