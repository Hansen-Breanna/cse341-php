<?php

/*
 * My Books Controller
 */

// Create or access a Session 
session_start();

// Get the database connection file
require_once 'library/connections.php';
// Get the acme model for use as needed
//require_once 'model/acme-model.php';
// Get the functions library
require_once 'library/functions.php';

//Do POST or GET
$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
}

// Switch case to choose page
switch ($action){
    case 'blacklist':
        include 'view/blacklisted-authors.php';
    break;
    case 'catalog':
        include 'view/catalog.php';
    break;
    case 'favorite':
        include 'view/favorite-authors.php';
    break;
    case 'loans':
        include 'view/loans.php';
    break;
    case 'reviews':
        include 'view/reviews.php';
    break;
    case 'wish':
        include 'view/wish-list.php';
    break;
    default:
        include 'view/home.php';
}