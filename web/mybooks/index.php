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
    // catalog page
    case 'catalog':
        $catalog = getCatalog($_SESSION['id']);
        $catalogTable = displayCatalog($catalog);
        include 'view/catalog.php';
    break;
    // search catalog by title
    case 'catalog-title':
        $title = test_input($_POST["title"]);
        $catalog = getTitle($title, $_SESSION['id']);
        $catalogTable = displayCatalog($catalog);
        $message = "<p class='px-4 py-3 bg-danger rounded'>No title selected.</p>";
        include 'view/catalog.php';
    break;
    // search catalog by author
    case 'catalog-author':
        $first_name = test_input($_POST["first_name"]);
        $last_name = test_input($_POST["last_name"]);
        $catalog = getCatalogAuthor($first_name, $last_name, $_SESSION['id']);
        $catalogTable = displayCatalog($catalog);
        $message = "<p class='px-4 py-3 bg-danger rounded'>No author selected.</p>";
        include 'view/catalog.php';
    break;
    // author page
    case 'authors':
        $authors = getAuthors($_SESSION['id']);
        $authorsTable = displayAuthors($authors);
        $author = addAuthor();
        //$message-2 = "<p class='px-4 py-3 bg-danger rounded'>Author already exists.</p>";
        include 'view/authors.php';
    break;
    // search author page by name
    case 'get-author':
        $first_name = test_input($_POST["first_name"]);
        $last_name = test_input($_POST["last_name"]);
        $authors = getByAuthor($first_name, $last_name, $_SESSION['id']);
        $authorsTable = displayAuthors($authors);
        $message = "<p class='px-4 py-3 bg-danger rounded'>No author selected.</p>";
        include 'view/authors.php';
    break;
    // loans page
    case 'loans':
        $loans = getLoans($_SESSION['id']);
        $loansTable = displayLoans($loans);
        include 'view/loans.php';
    break;
    // search loans page by title
    case 'loans-title':
        $title = test_input($_POST["title"]);
        $loans = getLoansTitle($title, $_SESSION['id']);
        $loansTable = displayLoans($loans);
        $message = "<p class='px-4 py-3 bg-danger rounded'>No title selected.</p>";
        include 'view/loans.php';
    break;
    //search loans page by borrower
    case 'loans-borrower':
        $first_name = test_input($_POST["first_name"]);
        $last_name = test_input($_POST["last_name"]);
        $loans = getLoanAuthor($first_name, $last_name, $_SESSION['id']);
        $loansTable = displayLoans($loans);
        $message = "<p class='px-4 py-3 bg-danger rounded'>No borrower selected.</p>";
        include 'view/loans.php';
    break;
    // reviews page
    case 'reviews':
        $reviews = getReviews();
        $reviewsTable = displayReviews($reviews);
        include 'view/reviews.php';
    break;
    // search reviews by title
    case 'reviews-title':
        $title = test_input($_POST["title"]);
        $reviews = getReviewTitle($title);
        $reviewsTable = displayReviews($reviews);
        $message = "<p class='px-4 py-3 bg-danger rounded'>No title selected.</p>";
        include 'view/reviews.php';
    break;
    // search reviews by author
    case 'reviews-author':
        $first_name = test_input($_POST["first_name"]);
        $last_name = test_input($_POST["last_name"]);
        $reviews = getAuthorReviews($first_name, $last_name);
        $reviewsTable = displayReviews($reviews);
        $message = "<p class='px-4 py-3 bg-danger rounded'>No author selected.</p>";
        include 'view/reviews.php';
    break;
    // wish page
    case 'wish':
        $readWishes = getReadWishes($_SESSION['id']);
        $ownWishes = getOwnWishes($_SESSION['id']);
        $readTable = displayCatalog($readWishes);
        $ownTable = displayCatalog($ownWishes);
        $author = selectAuthor($db);
        include 'view/wish-list.php';
    break;
    // search wishes by title
    case 'wish-title':
        $title = test_input($_POST["title"]);
        $ownWishes = getOwnTitle($title, $_SESSION['id']);
        $ownTable = displayCatalog($ownWishes);
        $readWishes = getReadTitle($title, $_SESSION['id']);
        $readTable = displayCatalog($readWishes);
        $message = "<p class='px-4 py-3 bg-danger rounded'>No title selected.</p>";
        include 'view/wish-list.php';
    break;
    // search wishes by author
    case 'wish-author':
        $first_name = test_input($_POST["first_name"]);
        $last_name = test_input($_POST["last_name"]);
        $ownWishes = getOwnAuthor($first_name, $last_name, $_SESSION['id']);
        $ownTable = displayCatalog($ownWishes);
        $readWishes = getReadAuthor($first_name, $last_name, $_SESSION['id']);
        $readTable = displayCatalog($readWishes);
        $message = "<p class='px-4 py-3 bg-danger rounded'>No author selected.</p>";
        include 'view/wish-list.php';
    break;
    // add a full book with author, title, and checkboxes
    case 'add-title':
        $message = "<p class='px-4 py-3 bg-danger rounded'>Title added. Please add another or return to the catalog.</p>";
        $author = addAuthor();
        include 'view/add-title.php';
    break;
    // add a full book with an existing author
    case 'existing-author':
        $author = selectAuthor($db);
        $message = "<p class='px-4 py-3 bg-danger rounded'>Title added. Please add another or return to the catalog.</p>";
        include 'view/add-title.php';
    break;
    // Add new author message
    case 'add-new-author':
        $authors = getAuthors($_SESSION['id']);
        $authorsTable = displayAuthors($authors);
        $author = addAuthor();
        $message = "<p class='px-4 py-3 bg-danger rounded'>Author was successfully added.</p>";
        include 'view/authors.php';
    break;
    // Delete user_author and author
    case 'delete-author':
        $authors = getAuthors($_SESSION['id']);
        $authorsTable = displayAuthors($authors);
        $author = addAuthor();
        $message = "<p class='px-4 py-3 bg-danger rounded'>Author was successfully deleted.</p>";
        include 'view/authors.php';
    break;
    // Edit user_author and author
    case 'edit-author':
        $authors = getAuthors($_SESSION['id']);
        $authorsTable = displayAuthors($authors);
        $author = addAuthor();
        $message = "<p class='px-4 py-3 bg-danger rounded'>Author was successfully deleted.</p>";
        include 'view/authors.php';
    break;
    // Add wish list item with existing title
    case 'update-title':
        // try {
        // $author = selectAuthor($db);
        // $bookTitle = selectTitle($db);
        // $message = "<p class='px-4 py-3 bg-danger rounded'>Title added. Please add another or return to the catalog.</p>";
        // } catch (Exception $e) {
        //     echo $e;
        // }
        // include 'view/add-title.php';
    break;
    case 'add-review':
        $author = addAuthor();
        include 'view/add-review.php';
    break;
    default:
        include 'view/home.php';
}