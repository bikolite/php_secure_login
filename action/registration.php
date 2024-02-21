<?php
if (isset($_POST["submit"])) {
    $fullName = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $errors = array();
    if (empty($fullName) or empty($email) or empty($password)) {
        array_push($errors, "All Fields are Required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 charactes long");
    }

    // require_once "config/database.php";
    require_once "../config/database.php";
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount > 0) {
        array_push($errors, "Email already exists!");
        header("Location: ../index.php");
    }
    if (count($errors) > 0) {
        foreach ($errors as  $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {

        $sql = "INSERT INTO users (name, email, password) VALUES ( ?, ?, ? )";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
        if ($prepareStmt) {
            mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
            mysqli_stmt_execute($stmt);
            header("Location: ../index.php");
            exit();
        } else {
            die("Something went wrong");
        }
    }
}
