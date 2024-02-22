<?php require_once "config/authCheck.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/dashboard.css">
    <title>Dashboard Page</title>
</head>

<body>
    <div class="container">
        <img class="round" src="assets/img/user.jpg" />
        <h4> Mohammad Naeem Islam </h4>
        <h5> Bangladesh </h5>
        <small> I'm Mohammad Naeem Islam, a passionate professional Developer with 3years of industry experience. </small>
        <div class="buttons">
            <button class="main-btn">
                Message
            </button>
            <a href="action/logout.php" style="text-decoration: none;" class="main-btn secondary">
                Logout
            </a>
        </div>
        <div class="skills">
            <h5>Skills</h5>
            <hr>
            <ul>
                <li>HTML</li>
                <li>CSS</li>
                <li> JavaScript </li>
                <li> React </li>
                <li> NodeJS </li>
                <li> YouTube Management </li>
            </ul>
        </div>
    </div>
</body>

</html>