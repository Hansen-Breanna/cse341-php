<?php

session_start();

if (isset($_SESSION['user'])) {
    $message = $_SESSION['user'];
} else {
    header('Location: sign-in.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
</head>

<body>
    <h1>Welcome</h1>
    <p>Welcome <?php echo $message; ?></p>
    <a href="sign-up.php">Sign Up</a>
    <a href="sign-in.php">Sign In</a>
    <a href="welcome.php">Welcome</a>
</body>

</html>