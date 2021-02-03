<?php
// start session
session_start ();

// define variables and set to empty values
$username = $password = $logout = "";
 
if ($_SERVER["REQUEST_METHOD"] == "GET" && (!isset($_SESSION))) { 

} 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $username = test_input($_POST["username"]);
    // $password = test_input($_POST["password"]);
    // $logout = test_input($_POST["logout"]);
    // $_SESSION['id'] = getUserID($username, $password);
    // $_SESSION['username'] = $username;
    // if ($logout == "logout") {
    //     session_destroy();
    // }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
