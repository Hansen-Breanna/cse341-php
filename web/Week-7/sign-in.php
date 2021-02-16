<?php
session_start();

// Get the database connection file
require_once '../mybooks/library/connections.php';
 
 $username = $password = "";

 if ($_SERVER["REQUEST_METHOD"] == "POST") 
 {
     $user = test_input($_POST['username']);
     $pass = test_input($_POST['password']);
    echo $user . $pass;
     try {
        $data = check_id($db, $user);
        var_dump($data);
            $verify = password_verify($pass, $data[0]['user_password']);
            echo $user_data['username'];
            if ($data[0]['username'] == $user && $data[0]['user_password'] == $pass) {
                $hash = $data[0]['user_password'];
                $username = $user_data['username'];
                echo $hash;
                echo $username;
            }
        $verify = password_verify($pass, $hash);
        $_SESSION['user'] = $username;
        //header('Location: welcome.php');
     } catch (Exception $e) {
        $message = "<p>An incorrect username or password was entered. Please try again.</p>";
     }
 }

 function check_id($db, $user) 
 {
    $stmt = $db->prepare('SELECT username, user_password FROM week7_user WHERE username = :user');
    $stmt->bindValue(':user', $user, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($results);
    return $results;
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
        <title>Week 07 Teach: Team Activity</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <h1>Sign In</h1>
    <p>Please sign in.</p>
        <form method="post" action="sign-in.php">
            <input class="m-1 pl-1" type="text" id="username" name="username" placeholder="username"><br>
            <input class="m-1 pl-1" type='password' id="password" name="password" placeholder="password"><br>
            <input type="submit" class="btn bg-primary m-1" value="Log In">
        </form>
        <script src="" async defer></script>
    </body>
</html>