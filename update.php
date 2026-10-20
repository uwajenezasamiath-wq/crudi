<?php
include_once("connection.php");

$row = null;
$message = "";
$id = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $postedId = isset($_POST["id"]) ? (string) $_POST["id"] : "";
    if (ctype_digit($postedId) && (int) $postedId > 0) {
        $id = (int) $postedId;
        $fields = array("fname", "lname", "gender", "phone", "email", "classY", "department");

        foreach ($fields as $field) {
            if (!isset($_POST[$field]) || $_POST[$field] === "") {
                $message = "Please complete all fields.";
                break;
            }
        }

        if ($message === "") {
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $gender = $_POST["gender"];
            $phone = $_POST["phone"];
            $email = $_POST["email"];
            $class = $_POST["classY"];
            $department = $_POST["department"];

            $stmt = mysqli_prepare(
                $conn,
                "UPDATE students SET firstname = ?, lastname = ?, gender = ?, phone = ?, email = ?, class = ?, department = ? WHERE id = ?"
            );

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssssssi", $fname, $lname, $gender, $phone, $email, $class, $department, $id);
                if (mysqli_stmt_execute($stmt)) {
                    $message = "Student updated successfully.";
                } else {
                    $message = "Failed to update student: " . mysqli_stmt_error($stmt);
                }
                mysqli_stmt_close($stmt);
            } else {
                $message = "Failed to prepare update: " . mysqli_error($conn);
            }
        }
    } else {
        $message = "Invalid student ID.";
    }
} elseif (isset($_GET["id"]) && ctype_digit((string) $_GET["id"]) && (int) $_GET["id"] > 0) {
    $id = (int) $_GET["id"];
} else {
    $message = "A valid student ID is required.";
}

if ($id !== null) {
    $stmt = mysqli_prepare($conn, "SELECT firstname, lastname, gender, phone, email, class, department FROM students WHERE id = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
            }
        } else {
            $message = "Failed to load student: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        $message = "Failed to prepare student lookup: " . mysqli_error($conn);
    }

    if (!$row && $message === "") {
        $message = "Student not found.";
    }
}

function escapeValue($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update student</title>
</head>
<body>
  <fieldset>
    <legend>Update student</legend>
    <?php if ($message !== "") { ?>
        <p><?php echo escapeValue($message); ?></p>
    <?php } ?>

    <?php if ($row) { ?>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?php echo (int) $id; ?>">

        <label for="fname">FIRSTNAME</label>
        <input id="fname" type="text" name="fname" required value="<?php echo escapeValue($row["firstname"]); ?>"><br><br>

        <label for="lname">LASTNAME</label>
        <input id="lname" type="text" name="lname" required value="<?php echo escapeValue($row["lastname"]); ?>"><br><br>

        <label>GENDER:</label>
        F<input type="radio" name="gender" value="F" required <?php echo $row["gender"] === "F" ? "checked" : ""; ?>>
        M<input type="radio" name="gender" value="M" required <?php echo $row["gender"] === "M" ? "checked" : ""; ?>><br><br>

        <label for="phone">PHONE</label>
        <input id="phone" type="tel" name="phone" required value="<?php echo escapeValue($row["phone"]); ?>"><br><br>

        <label for="email">EMAIL</label>
        <input id="email" type="email" name="email" required value="<?php echo escapeValue($row["email"]); ?>"><br><br>

        <label for="classY">CLASS</label>
        <input id="classY" type="text" name="classY" required value="<?php echo escapeValue($row["class"]); ?>"><br><br>

        <label for="department">DEPARTMENT</label>
        <select name="department" id="department" required>
            <?php
            $departments = array("IT", "AUTO", "FBM", "RDM", "CARNAR ART");
            foreach ($departments as $departmentOption) {
                $selected = $row["department"] === $departmentOption ? " selected" : "";
                echo '<option value="' . escapeValue($departmentOption) . '"' . $selected . '>' . escapeValue($departmentOption) . '</option>';
            }
            ?>
        </select><br><br>

        <input type="submit" value="UPDATE" name="sub">
    </form>
    <?php } ?>
    <p><a href="select.php">Back to students</a></p>
  </fieldset>
</body>
</html>
