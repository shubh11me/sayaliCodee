<?php
header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *");

header('Access-Control-Allow-Methods: POST');

header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
include('./conn.php');
include('./function.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
  $fname=$data['fname'];
  $lname=$data['lname'];
  $email=$data['email'];
  $div=$data['div'];
  $pass=$data['pass'];

  if (!empty($fname) && !empty($lname) && !empty($div) && !empty($email) && !empty($pass)) {
   
    $sql="INSERT INTO `usersssss`(`useri_fname`, `useri_lname`, `division`, `useri_email`, `useri_password`) VALUES ('$fname','$lname','$div','$email','$pass')";
    $res=mysqli_query($conn,$sql);
    if ($res) {
        $last_id=mysqli_insert_id($conn);
        http_response_code(201);
        echo json_encode(array("Status"=>true,"msg"=>"User is registered"));

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