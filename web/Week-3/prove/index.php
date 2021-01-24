<?php

/*
 * Shopping Cart Controller
 */

// Create or access a Session 
session_start();

// Get the database connection file
require_once 'library/connections.php';
// Get the acme model for use as needed
require_once 'model/acme-model.php';
// Get the functions library
require_once 'library/functions.php';

// Default page title
$pageTitle = 'Home';

/*
 * How to test code --
 * var_dump($categories);
 * echo '<pre>' . print_r($categories, true) . '</pre>';    
 * exit;
 */

/*
 * Test navigation ul
 * echo $navList;
 * exit;
 */

// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

//Do POST or GET
$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
}

// Switch case to choose page
switch ($action){
    case 'template':
        $pageTitle = 'Template';
        include 'template/template.php';
    break;
    default:
        $pageTitle = 'Home';
        include '/acme/view/home.php';
}





