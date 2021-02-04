<?php

/*
 * My Books Controller
 */

// Create or access a Session 
session_start();

// Get the database connection file
require_once 'library/connections.php';
// Get the acme model for use as needed
require_once 'model/models.php';
// Get the functions library
require_once 'library/functions.php';

//Do POST or GET
$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
}

// Switch case to choose page
switch ($action){
    case 'catalog':
        $catalog = getCatalog($_SESSION['id']);
        $catalogTable = displayCatalog($catalog);
        include 'view/catalog.php';
    break;
    case 'catalog-title':
        $title = test_input($_POST["title"]);
        $catalog = getTitle($title, $_SESSION['id']);
        $catalogTable = displayCatalog($catalog);
        include 'view/catalog.php';
    break;
    case 'catalog-author':
        $first_name = test_input($_POST["first_name"]);
        $last_name = test_input($_POST["last_name"]);
        $catalog = getCatalogAuthor($first_name, $last_name, $_SESSION['id']);
        $catalogTable = displayCatalog($catalog);
        include 'view/catalog.php';
    break;
    case 'authors':
        $authors = getAuthors($_SESSION['id']);
        $authorsTable = displayAuthors($authors);
        include 'view/authors.php';
    break;
    case 'get-author':
        $first_name = test_input($_POST["first_name"]);
        $last_name = test_input($_POST["last_name"]);
        $authors = getByAuthor($first_name, $last_name, $_SESSION['id']);
        $authorsTable = displayAuthors($authors);
        include 'view/authors.php';
    break;
    case 'loans':
        $loans = getLoans($_SESSION['id']);
        $loansTable = displayLoans($loans);
        include 'view/loans.php';
    break;
    case 'loans-title':
        $title = test_input($_POST["title"]);
        $loans = getLoansTitle($title, $_SESSION['id']);
        $loansTable = displayLoans($loans);
        include 'view/loans.php';
    break;
    case 'loans-borrower':
        $first_name = test_input($_POST["first_name"]);
        $last_name = test_input($_POST["last_name"]);
        $loans = getLoanAuthor($first_name, $last_name, $_SESSION['id']);
        $loansTable = displayLoans($loans);
        include 'view/loans.php';
    break;
    case 'reviews':
        $reviews = getReviews();
        $reviewsTable = displayReviews($reviews);
        include 'view/reviews.php';
    break;
    case 'reviews-title':
        $title = test_input($_POST["title"]);
        $reviews = getReviewTitle($title);
        $reviewsTable = displayReviews($reviews);
        include 'view/reviews.php';
    break;
    case 'reviews-author':
        $first_name = test_input($_POST["first_name"]);
        $last_name = test_input($_POST["last_name"]);
        $reviews = getAuthorReviews($first_name, $last_name);
        $reviewsTable = displayReviews($reviews);
        include 'view/reviews.php';
    break;
    case 'wish':
        $readWishes = getReadWishes($_SESSION['id']);
        $ownWishes = getOwnWishes($_SESSION['id']);
        $readTable = displayCatalog($readWishes);
        $ownTable = displayCatalog($ownWishes);
        include 'view/wish-list.php';
    break;
    case 'wish-title':
        $title = test_input($_POST["title"]);
        $ownWishes = getOwnTitle($title, $_SESSION['id']);
        $ownTable = displayCatalog($ownWishes);
        $readWishes = getReadTitle($title, $_SESSION['id']);
        $readTable = displayCatalog($readWishes);
        include 'view/wish-list.php';
    break;
    case 'wish-author':
        $first_name = test_input($_POST["first_name"]);
        $last_name = test_input($_POST["last_name"]);
        $ownWishes = getOwnAuthor($first_name, $last_name, $_SESSION['id']);
        $ownTable = displayCatalog($ownWishes);
        //$readWishes = getReadAuthor($first_name, $last_name, $_SESSION['id']);
        // $readTable = displayCatalog($readWishes);
        include 'view/wish-list.php';
    break;
    default:
        include 'view/home.php';
}