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




    $sql = "select * from usersssss";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $users = mysqli_fetch_all($res, MYSQLI_ASSOC);
$result=[];
        foreach ($users as $user) {

            $u_id = $user['useri_id'];
            $sq = "SELECT * FROM `user_like_subject` INNER JOIN subject ON user_like_subject.user_like_subject_subj=subject.id  WHERE `user_like_subject`.`user_like_subject_user`=$u_id";
            // echo $sq;
            // die();
            $rd = mysqli_query($conn, $sq);
            $r = mysqli_fetch_all($rd, MYSQLI_ASSOC);
            // echo "Hello I am user ".$u_id;
            // echo json_encode($r);
            $user['subs']=$r;
            
            array_push($result,$user);
            
        }
        
        echo json_encode($result);
        //  echo json_encode(array("Status"=>true,"users"=>$r));


    } else {
        http_response_code(401);
        echo json_encode(array("Status" => false, "msg" => "No Account found"));
    }
}
