<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <fieldset>
    <form action="insert.php" method="post">
        <label for="">FIRSTNAME</label>
        <input type="text" name="fname" required><br><br>

        <label for="">LASTNAME</label>
        <input type="text" name="lname" required><br><br>

        <label for="">GENDER:</label>
        F<input type="radio" name="gender" value="F" required>
        M<input type="radio" name="gender" value="M" required><br><br>

        <label for="">PHONE</label>
        <input type="tel" name="phone" required><br><br>

        <label for="">EMAIL</label>
        <input type="email" name="email" required><br><br>

        <label for="">CLASS</label>
        <input type="text" name="classY" required><br><br>

        <label for="">DEPARTMENT</label>
  <select name="department" id="">
    <option value="IT">IT</option>
    <option value="AUTO">AUTO</option>
    <option value="FBM">FBM</option>
    <option value="RDM">RDM</option>
    <option value="CARNAR ART">CARNAR ART</option>
    
  </select><br><br>
  
  <input type="submit" value="SEND" name="sub">
    </form>
  </fieldset>  
</body>
</html>