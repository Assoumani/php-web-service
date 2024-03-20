<?php 

// Création du client SOAP
    // création d'un tableau d'options (uri, location)
    $options = [
        'location' => 'http://localhost/PHP-WEB-SERVICE/server.php',
        'uri' => 'http://localhost/PHP-WEB-SERVICE/client2'
    ];
    // création du client avec la classe PHP SoapClient
    $client = new SoapClient(null, $options);
// Appel de la fonction du service avec la méthode __soapCall
$result = $client->__soapCall('soustraction', [5, 10]);
// Affichage des résultats
echo $result;