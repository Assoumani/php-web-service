<?php 

// Création du client SOAP
$options = [
    'location' => 'http://localhost/PHP-WEB-SERVICE/TP/soapServer.php',
    'uri' => 'http://localhost/PHP-WEB-SERVICE/TP'
];
$client = new SoapClient(null, $options);
// Appel de la fonction du service pour supprimer le produit
$result  = $client->delete(2);
// Affichage du résultat
echo '<pre>';
var_dump($result);
echo '</pre>';