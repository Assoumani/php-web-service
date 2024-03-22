<?php
require "./vendor/autoload.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Clé secrète(mote de passe) pour signer le token (à conserver en sécurité)
// Fonction pour générer un token JWT
function generateToken(string $secret_key, string $email): string
{
    $payload = [
        "user_id" => 1,
        "email" => $email,
        "user_role" => "ADMIN",
        "expiration" => time() + (60 * 60)
    ];
    try {
        return JWT::encode($payload, $secret_key, "HS256");
    } catch (\Throwable $th) {
        throw $th;
    }
}


// Fonction pour valider et décoder un token JWT
function validate_token(string $token, string $secret_key)
{
    try {
        return JWT::decode(
            $token,
            new Key($secret_key, 'HS256')
        );
    } catch (\Throwable $th) {
        throw $th;
    }
}

// Exemple d'utilisation : Authentification et génération du token

// Exemple d'utilisation : Validation du token et accès à l'API
