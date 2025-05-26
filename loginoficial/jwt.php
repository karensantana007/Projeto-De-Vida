composer require firebase/php-jwt

<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once "vendor/autoload.php";

$chaveSecreta = "minha_chave_secreta";

function criarToken($usuarioId) {
    global $chaveSecreta;
    $payload = [
        "iss" => "meusite.com",
        "aud" => "meusite.com",
        "iat" => time(),
        "exp" => time() + 3600,
        "sub" => $usuarioId
    ];

    return JWT::encode($payload, $chaveSecreta, 'HS256');
}

function verificarToken($token) {
    global $chaveSecreta;
    return JWT::decode($token, new Key($chaveSecreta, 'HS256'));
}