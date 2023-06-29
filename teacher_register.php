<?php
header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *");

header('Access-Control-Allow-Methods: POST');

header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
include('./conn.php');
include('./function.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
  $name=$data['name'];
  $email=$data['email'];
  $pass=$data['pass'];

  if (!empty($name) && !empty($email) && !empty($pass)) {
   
    $sql="INSERT INTO `teacher`(`teacher_name`, `teacher_email`, `teacher_password`) VALUES ('$name','$email','$pass')";
    $res=mysqli_query($conn,$sql);
    if ($res) {
        $last_id=mysqli_insert_id($conn);
        $x=genID($last_id,'teacher','teacher_id','teach_');
        http_response_code(201);
        echo json_encode(array("Status"=>true,"msg"=>"Teacher is registered","id"=>$x));

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