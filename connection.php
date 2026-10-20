<?php

$conn = mysqli_connect("localhost","root","","25rp07013_db");
if($conn){
    echo"CONNECTED SUCCESSFUL!!!!!";
}
else{
    echo "ERROR".mysqli_connect_error($conn);
}

?>