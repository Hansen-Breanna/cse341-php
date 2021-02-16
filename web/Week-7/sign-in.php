<?php
 
// Get the database connection file
require_once '../mybooks/library/connections.php';
 
 $username = $password = "";

 if ($_SERVER["REQUEST_METHOD"] == "POST") 
 {
     $user = test_input($_POST['username']);
     $pass = test_input($_POST['password']);
 
     try {
        $data = check_id($db, $user, $pass);
        foreach ($data as $user) {
            if ($user['username'] == $user && $user['user_password'] == $pass) {
                $hash = $user['user_password'];
                $username = $user['username'];
            }
        }
        $verify = password_verify($pass, $hash);
        $_SESSION['user'] = $username;
        header('Location: welcome.php');
     } catch (Exception $e) {
        $message = "<p>An incorrect username or password was entered. Please try again.</p>";
     }
 
    //  $stmt = $db->prepare('INSERT INTO week7_user (username, password) VALUES (:user, :pass)');
    //  $stmt->execute(array(':user' => $user, ':pass' => $pass));
    //  header('Location: sign-in.php');
 }

 function check_id($db, $user, $pass) 
 {
    $stmt = $db->prepare('SELECT username, user_password FROM week7_user WHERE username = :user AND user_password = :pass');
    $stmt->bindValue(':user', $user, PDO::PARAM_STR);
    $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
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
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <h1>Sign In</h1>
        <?php $message ?>
        <p>Please sign in.</p>
        <form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
            <input class="m-1 pl-1" type="text" id="username" name="username" placeholder="username"><br>
            <input class="m-1 pl-1" type='password' id="password" name="password" placeholder="password"><br>
            <input type="submit" class="btn bg-primary m-1" value="Log In">
        </form>
        
        <script src="" async defer></script>
    </body>
</html>