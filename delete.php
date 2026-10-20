<?php

include_once("connection.php");

    $id=$_GET['id'];
    $delete = "DELETE FROM `students` WHERE `id` = $id";
    $result = mysqli_query($conn, $delete);

    if($result){
        header("location:select.php");
    }else{
        echo "not deleted";
    }


?>