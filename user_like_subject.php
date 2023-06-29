<?php
header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *");

header('Access-Control-Allow-Methods: POST');

header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
include('./vendor/autoload.php');
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

include('./conn.php');
include('./function.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $headers=getallheaders();
if (!isset($headers['Authorization'])  || empty($headers['Authorization'])) {
  http_response_code(404);
  echo json_encode(array("Status"=>false,"msg"=>"No Authorization"));

}

$jwt=$headers['Authorization'];
$decoded = JWT::decode($jwt, new Key("tumbed", 'HS256'));



$user_id=$decoded->data->useri_id;

    $data = json_decode(file_get_contents("php://input"), true);
  $subj_id=$data['subj_id'];
  $level=$data['level'];


  if (!empty($subj_id) && !empty($level)) {
   
    $sql="INSERT INTO `user_like_subject`(`user_like_subject_subj`, `user_like_subject_like_level`,`user_like_subject_user`) VALUES ('$subj_id','$level','$user_id')";
    $res=mysqli_query($conn,$sql);
    if ($res) {
        $last_id=mysqli_insert_id($conn);
        http_response_code(201);
        echo json_encode(array("Status"=>true,"msg"=>"Subject for student is registered"));

    }else{
        http_response_code(401);
        echo json_encode(array("Status"=>false,"msg"=>"Something went wrong"));
    }

  }else{
    http_response_code(404);
    echo json_encode(array("Status"=>false,"msg"=>"No data sent"));
  }



}


?>