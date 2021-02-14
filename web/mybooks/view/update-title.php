<?php
// start session
session_start();

$first_name = $middle_name = $last_name =  $title = $authorID = $title_id = "";
$favorite = $blacklist = $own = $own_wish = $read_wish = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $authorID = test_input($_POST['authorID']);


    if (isset($_POST['title_id'])) {
        $book_title_id = test_input($_POST['title_id']);
        $title_data = getUserBookData($db, $_SESSION['id'], $book_title_id);  
        var_dump($title_data);
        $_SESSION['titleData'] = $title_data;
        $author_id = $title_data[0]['author_id'];
        //$displayTitle = displayTitleData($loanData); 
        $author_data = getAuthor($author_id);
        $choice = displayFavBlackData($author_data);
        $title_choices = displayTitleChoices($title_data);
    } else {
        // try {
        //     if (isset($_POST['update'])) {
        //         $borrower_id = $_SESSION['loanData'][0]['borrower_id'];
        //         $book_title_id = $_SESSION['loanData'][0]['book_title_id'];
        //         $loan_id = $_SESSION['loanData'][0]['id'];
        //         // update borrower
        //         updateBorrower($db, $borrower_id, $first_name, $middle_name, $last_name, $phone);
        //         // update loan
        //         updateLoan($db, $loan_id, $book_title_id, $borrower_id, $dateBorrowed, $returnDate);
        //         header('Location: index.php?action=update-loan');
        //     } 
        // } catch (Exception $e) {
        //     echo $e;
        //     $message = "<p class='px-4 py-3 bg-danger rounded'>Loan was not updated. Please try again.</p>";
        // }
    }




    // try {
    //     if (isset($_POST['authorID'])) {
    //         $newAuthorID = $authorID;
    //     } else {
    //         $first_name = test_input($_POST["first_name"]);
    //         $middle_name = test_input($_POST["middle_name"]);
    //         $last_name = test_input($_POST["last_name"]);

    //         //author
    //         insertAuthor($db, $first_name, $middle_name, $last_name);
    //         $newAuthorID = $db->lastInsertId('author_id_seq');
    //     }
    //     $favorite = test_input($_POST["favorite"]);

    //     if (isset($_POST['favorite'])) {
    //         $favorite = "TRUE";
    //     } else {
    //         $favorite = "FALSE";
    //     }
    //     $newFavorite = removeQuotes($favorite);

    //     $blacklist = test_input($_POST["blacklist"]);
    //     if (isset($_POST['blacklist'])) {
    //         $blacklist = "TRUE";
    //     } else {
    //         $blacklist = "FALSE";
    //     }
    //     $newBlacklist = removeQuotes($blacklist);

    //     $title = test_input($_POST["title"]);
    //     $own = test_input($_POST["own"]);
    //     if (isset($_POST['own'])) {
    //         $own = "TRUE";
    //     } else {
    //         $own = "FALSE";
    //     }
    //     $newOwn = removeQuotes($own);

    //     $own_wish = test_input($_POST["own_wish"]);
    //     if (isset($_POST['own_wish'])) {
    //         $own_wish = "TRUE";
    //     } else {
    //         $own_wish = "FALSE";
    //     }
    //     $newOwn_wish = removeQuotes($own_wish);

    //     $read_wish = test_input($_POST["read_wish"]);
    //     if (isset($_POST['read_wish'])) {
    //         $read_wish = "TRUE";
    //     } else {
    //         $read_wish = "FALSE";
    //     }
    //     $newRead_wish = removeQuotes($read_wish);

    //     $_SESSION['title'] = $title;

    //     if (!isset($_POST['authorID'])) {
    //         //user_author
    //         insertUserAuthor($db, $_SESSION['id'], $newAuthorID, $newBlacklist, $newFavorite);
    //     }

    //     //book
    //     insertTitle($db, $newAuthorID, $title);
    //     $newTitleID = $db->lastInsertId('book_title_id_seq');

    //     // //user-book
    //     insertUserBook($db, $_SESSION['id'], $newTitleID, $newOwn, $newOwn_wish, $newRead_wish);
    // } catch (Exception $e) {
    //     $message = "<p class='px-4 py-3 bg-danger rounded'>Title was not added. Please check for existing author and try again.</p>";
    // }
}

?>

<!-- Head -->
<?php include 'common/head.php'; ?>

<title>Add Title - My Books</title>

<!-- Nav -->
<?php include 'common/nav.php'; ?>

<!-- Header -->
<?php include '../common/header.php'; ?>

<h1 class="offset-1 col-10 offset-md-0 col-md-12">Update Title</h1>
</div>
</div>
</header>

<main class="mb-5">
    <div class="container">
        <div class="row d-flex flex-column align-items-center">
            <div class="my-3 mx-2 py-2 border-secondary border-top border-bottom">
                <a href="index.php?action=catalog" title="See All Titles" class="btn btn-custom bg-info my-2 ml-1">See Catalog</a>
                <a href="index.php?action=wish" title="See All Wishes" class="btn btn-custom bg-info my-2 ml-1">See Wish List</a>
            </div>
            <div>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo $message;
                }
                ?>

                <form method="post" action="index.php?action=add-title">
                    <div>
                        <!-- Author -->
                        <h2 class="author-name mt-2 d-inline">Author</h2><span>:&nbsp;
                            <?php 
                                echo $title_data[0]['first_name'] . ' ';
                                echo $title_data[0]['middle_name'] . ' ';
                                echo $title_data[0]['last_name'];
                                ?>
                            </span>
                        <table>
                            <tbody>
                                <?php echo $choice; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Title -->
                    <div class="book-title">
                        <h2 class="mt-2 d-inline">Title</h2><span>:&nbsp;<?php echo $title_data[0]['title_of_book']; ?></span>
                        <table>
                            <tbody>
                               <?php echo $title_choices; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="submit">
                        <input type="submit" class="rounded btn btm-lg bg-orange">
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>