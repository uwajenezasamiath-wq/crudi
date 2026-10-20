<?php

include_once("connection.php");
// echo "<br>";
if(isset($_POST['sub'])){
    $fname =$_POST['fname'];
    $lname =$_POST['lname'];
    $gender =$_POST['gender'];
    $phone =$_POST['phone'];
     $email =$_POST['email'];
    $class =$_POST['classY'];
    $department =$_POST['department'];
}

$sql= "INSERT INTO `students`(`firstname`, `lastname`, `gender`, `phone`, `email`, `class`, `department`)
VALUES ('$fname', '$lname', '$gender', '$phone', '$email', '$class', '$department')";

$result=mysqli_query($conn,$sql);
 if($result){
//   header("location:select.php");
  echo "New student inserted well !!!";

 }
 else{
    echo"ERROR:".mysqli_error($conn);
    
 }



?>