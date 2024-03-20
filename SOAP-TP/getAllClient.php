<?php

// Création du client SOAP
$options = [
    'location' => 'http://localhost/PHP-WEB-SERVICE/TP/soapServer.php',
    'uri' => 'http://localhost/PHP-WEB-SERVICE/TP'
];

$client = new SoapClient(null, $options);
// Appel de la fonction du service pour récupérer la liste de produits
$result = $client->getAll();
// Affichage du résultat
echo json_encode($result);