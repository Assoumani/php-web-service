<?php
//http://localhost/PHP-WEB-SERVICE/TP/createClient.php?id=5&description=jolie+produit&price=49&name=iphone&model=15
// Définition du produit à rajouter
$product = [];
foreach ($_GET as $key => $value) {
    $product[$key] = $value;
}
// Création du client SOAP
$options = [
    'location' => 'http://localhost/PHP-WEB-SERVICE/TP/soapServer.php',
    'uri' => 'http://localhost/PHP-WEB-SERVICE/TP'
];
$client  = new SoapClient(null, $options);
// Appel de la fonction du service pour ajouter le produit
$result = $client->create($product);
// Affichage du résultat
echo json_encode($result);