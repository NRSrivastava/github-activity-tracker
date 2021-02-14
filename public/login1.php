<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__.'/../random.php';
use \Firebase\JWT\JWT;
session_start();

$payload=array(
    "iat"=>time(),
    "exp"=>time()+(10*60),
    "iss"=>file_get_contents("../iss")
);

$ky=file_get_contents("../activiytracker.2021-02-13.private-key.pem");

$jwt = JWT::encode($payload,$ky,'RS256');


$x=getName(20);

header("Location: https://github.com/login/oauth/authorize?client_id=".file_get_contents("../cID")."&redirect_uri=http://localhost/login2.php");

