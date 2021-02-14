<?php
session_start();

$host = 'https://api.github.com/users/'.$_SESSION['userData']['login'].'/events?per_page=10&page='.htmlentities($_GET['page']);

$ch = curl_init();

// endpoint url
curl_setopt($ch, CURLOPT_URL,$host);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// echo $_SESSION['user']['access_token'];

// set header
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'User-Agent:Mozilla/5.0 Gecko/20100101 Firefox/85.0'));//,
    //"Authorization: token ".$_SESSION['user']['access_token']));


$response = curl_exec($ch);

curl_close($ch);

echo $response;
// header("HTTP/1.1 200 OK");
// header('Content-Type: application/JSON');
// echo json_encode($response);