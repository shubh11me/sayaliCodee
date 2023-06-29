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


if ($_SERVER["REQUEST_METHOD"] == "GET") {


  

    $sql="select * from usersssss";
    $res=mysqli_query($conn,$sql);
    if ($res) {
      $r=mysqli_fetch_all($res,MYSQLI_ASSOC);

        echo json_encode(array("Status"=>true,"users"=>$r));
      

    }else{
        http_response_code(401);
        echo json_encode(array("Status"=>false,"msg"=>"No Account found"));
    }





}
