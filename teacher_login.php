<?php

require('./vendor/autoload.php');
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *");

header('Access-Control-Allow-Methods: POST');

header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');




include('./conn.php');
include('./function.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
  $email=$data['email'];
  $pass=$data['pass'];

  if (!empty($email) && !empty($pass)) {
   
    $sql="select * from teacher where teacher_email='$email'";
    $res=mysqli_query($conn,$sql);
    if ($res) {
      $r=mysqli_fetch_assoc($res);
      if ($pass==$r['teacher_password']) {

        $key = 'tumbed';
        $payload = [
            'iss' => 'https://cliqlearn.com',
            'aud' => 'https://cliqlearn.com',
            'iat' => time(),
            'nbf' => time()+10,
            'exp' => time()+1800,
            'data'=>$r
        ];


        $jwt = JWT::encode($payload, $key, 'HS256', null);
        http_response_code(401);
        echo json_encode(array("Status"=>true,"msg"=>"User logged in","jwt"=>$jwt));
      }else{
        http_response_code(401);
        echo json_encode(array("Status"=>false,"msg"=>"No Account found"));
      }

    }else{
        http_response_code(401);
        echo json_encode(array("Status"=>false,"msg"=>"No Account found"));
    }

  }else{
    http_response_code(404);
    echo json_encode(array("Status"=>false,"msg"=>"No data sent"));
  }



}
