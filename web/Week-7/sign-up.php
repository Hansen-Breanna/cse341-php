<?php

session_start();

// Get the database connection file
require_once '../mybooks/library/connections.php';

 $username = $password = $confirm_password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = test_input($_POST['username']);
    $pass = test_input($_POST['password']);
    $confirm =  test_input($_POST['confirm_password']);

    if ($pass != $confirm) {
        $message = "<p class='danger'>Your passwords do not match. Please try again.</p>";
        $star = "<span class='danger'>*</span>";
        $pattern = '/^(?=.*[[:digit:]])(?=.*[a-z])([^\s]){7,}$/';
    } else {
        try {
            if (preg_match($pattern, $pass)) {
                $passwordHash = password_hash($pass, PASSWORD_DEFAULT);
                $db = connectMyBooks();
                $stmt = $db->prepare('INSERT INTO week7_user (username, user_password) VALUES (:user, :pass)');
                $stmt->execute(array(':user' => $user, ':pass' => $passwordHash));
                header('Location: sign-in.php');
            }
        } catch (Exception $e) {
            echo $e;
            echo $message = "Please use at least 7 characters and 1 number.";
        }
    }
}

function test_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
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
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <h1>Sign Up</h1>
    <p>To sign up, please create a username and password. Password must be 7 characters and contain a number.</p>
    <?php echo $message; ?>
        <form method="post" action="sign-up.php">
            <input class="m-1 pl-1" type="text" id="username" name="username" placeholder="username"><br>
            <input class="m-1 pl-1" type='text' id="password" name="password" placeholder="password"><?php echo $star; ?><br>
            <input class="m-1 pl-1" type='text' id="confirm_password" name="confirm_password" placeholder="confirm password"><?php echo $star; ?><br>
            <input type="submit" class="btn bg-primary m-1" value="Log In">
        </form>
        <script src="" async defer></script>
    </body>
</html>