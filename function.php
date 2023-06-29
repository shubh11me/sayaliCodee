
<?php

function genID($lastid, $tableName, $columnName, $prefix)
{
    global $conn;
    $generated_id = $prefix . $lastid . date("d") . date("m") . date("y");
    $idExist_result = mysqli_query($conn, "select * from " . $tableName . " where " . $columnName . "='$generated_id'");
    if (mysqli_num_rows($idExist_result) == 0) {
        mysqli_query($conn, "update " . $tableName . " set " . $columnName . "='$generated_id' where " . $tableName . ".id='$lastid'");
    } else {
        genID($lastid, $tableName, $columnName, $prefix);
    }
    return $generated_id;
}
function inssub($subj_id,$level,$user_id){
    global $conn;

    $sql="INSERT INTO `user_like_subject`(`user_like_subject_subj`, `user_like_subject_like_level`,`user_like_subject_user`) VALUES ('$subj_id','$level','$user_id')";
    $res=mysqli_query($conn,$sql);
    if($res){
        return true;
    }
    else{
        return false;
    }
}


function inssubQueryMaker($subj_id,$level,$user_id,$isLast){
$ste="('$subj_id','$level','$user_id')".($isLast==true?'':',');
return $ste;
}



?>