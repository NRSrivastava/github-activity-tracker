<?php
session_start();
if(isset($_GET['error'])||(!isset($_GET['code']))){
    header('Location: http://localhost');
    die();
}
$url = 'https://github.com/login/oauth/access_token';
$data = array('client_id' => file_get_contents("../cID"), 
                'client_secret' => file_get_contents("../cSecret"),
                'code' =>htmlentities($_GET['code'])
            );

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) {
    header("HTTP/1.1 418 I'm a teapot");
    die();
}

$got=explode('&',$result);
$user=array();

foreach($got as $k => $v){
    $temp=explode('=',$v);
    $user[$temp[0]]=$temp[1];
}

$_SESSION['user']=$user;

// print_r($user);

$curl_h=curl_init("https://api.github.com/user");
curl_setopt($curl_h,CURLOPT_HTTPHEADER,
            array(
                'User-Agent: Activity Tracker',
                'Authorization: token '.$_SESSION['user']['access_token']
            ));
curl_setopt($curl_h,CURLOPT_RETURNTRANSFER,true);


$response=curl_exec($curl_h);

$_SESSION['userData']=json_decode($response,true);

header("Location: activities.php");
// print_r($response);