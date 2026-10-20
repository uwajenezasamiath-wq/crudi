
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body bgcolor="skyblue">
<h1>DETAILS OF STUDENT</h1>
<table border="1">
    <tr>
        <th>NO</th>
        <th>FIRSTNAME</th>
        <th>LASTNAME</th>
        <th>GENDER</th>
        <th>PHONE</th>
        <th>EMAIL</th>
        <th>CLASS</th>
        <th>DEPARTMENT</th>
        <th colspan="3">OPTION</th>
    </tr>
        <?php
        
        include_once("connection.php");

        if(isset($_GET['id'])){
                $id=$_GET['id'];
    $view = "SELECT * FROM `students` WHERE `id` = $id";
    $result = mysqli_query($conn, $view);
    $row=mysqli_fetch_assoc($result);

    if($result){
        // header("location:view.php");
  
        
                ?>
                <tr>
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['firstname']?></td>
                    <td><?php echo $row['lastname']?></td>
                    <td><?php echo $row['gender']?></td>
                    <td><?php echo $row['phone']?></td>
                    <td><?php echo $row['email']?></td>
                    <td><?php echo $row['class']?></td>
                    <td><?php echo $row['department']?></td>
                    <td>
                        <a href="delete.php?id=<?php echo $row['id']?>">Delete</a>
                        <a href="update.php?id=<?php echo $row['id']?>">Edit</a>
                        <a href="view.php?id=<?php echo $row['id']?>">View</a>
                    </td>
                </tr>

                <?php
                

            }  else{
        echo "failed to view data";
    }}
        
        ?>
</table>
    
</body>
</html>


