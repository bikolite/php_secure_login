<?php
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $errors = array();
    if (empty($name) or empty($email) or empty($password)) {
        array_push($errors, "Fields are Required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Your Email is not valid");
    }
    if (strlen($password) < 8) {
        array_push($errors, "Password must be 8 charactes.");
    }

    // set database into local server;
    require_once "../config/database.php";
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount > 0) {
        array_push($errors, "Your Email already exists! Please Login");
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
            mysqli_stmt_bind_param($stmt, "sss", $name, $email, $passwordHash);
            mysqli_stmt_execute($stmt);
            header("Location: ../index.php");
            exit();
        } else {
            die("Something went wrong");
        }
    }
}
