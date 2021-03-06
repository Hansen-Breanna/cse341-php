<?php
// start session
session_start();

$first_name = $middle_name = $last_name =  $title = $authorID = $title_id = $update_title = "";
$favorite = $blacklist = $own = $own_wish = $read_wish = "";
$user_id = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "GET" && (!isset($_SESSION['id']))) {
    header('Location: index.php?action=home');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $authorID = test_input($_POST['authorID']);


    if (isset($_POST['title_id'])) {
        $book_title_id = test_input($_POST['title_id']);
        // get all book data
        $title_data = getUserBookData($db, $user_id, $book_title_id);  
        $_SESSION['title_data'] = $title_data;
        // author
        $author_id = $title_data[0]['author_id']; 
        $author_data = getAuthor($author_id);
        // own, own-wish, read-wish
        $choice = displayFavBlackData($author_data);
        $title_choices = displayTitleChoices($title_data);
    } else {
        try {
            if (isset($_POST['update_title'])) {
                $book_title_id = $_SESSION['title_data'][0]['book_title_id'];
                $author_id = $_SESSION['title_data'][0]['author_id'];

                $favorite = test_input($_POST["favorite"]);
                if (isset($_POST['favorite'])) {
                    $favorite = "TRUE";
                } else {
                    $favorite = "FALSE";
                }
                $new_favorite = removeQuotes($favorite);

                $blacklist = test_input($_POST["blacklist"]);
                if (isset($_POST['blacklist'])) {
                    $blacklist = "TRUE";
                } else {
                    $blacklist = "FALSE";
                }
                $new_blacklist = removeQuotes($blacklist);

                $own = test_input($_POST["own"]);
                if (isset($_POST['own'])) {
                    $own = "TRUE";
                } else {
                    $own = "FALSE";
                }
                $new_own = removeQuotes($own);

                $own_wish = test_input($_POST["own_wish"]);
                if (isset($_POST['own_wish'])) {
                    $own_wish = "TRUE";
                } else {
                    $own_wish = "FALSE";
                }
                $new_own_wish = removeQuotes($own_wish);

                $read_wish = test_input($_POST["read_wish"]);
                if (isset($_POST['read_wish'])) {
                    $read_wish = "TRUE";
                } else {
                    $read_wish = "FALSE";
                }
                $new_read_wish = removeQuotes($read_wish);

                // update user_author
                updateUserAuthor($db, $user_id, $author_id, $new_blacklist, $new_favorite);
                // update user_book
                updateUserBook($db, $user_id, $book_title_id, $new_own, $new_own_wish, $new_read_wish);

                unset($_SESSION['title_data']);
                header('Location: index.php?action=catalog');
            } 
        } catch (Exception $e) {
            $message = "<p class='px-4 py-3 bg-danger rounded'>Loan was not updated. Please try again.</p>";
        }
    }
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

                <form method="post" action="index.php?action=update-title">
                    <div>
                        <!-- Author -->
                        <h2 class="author-name mt-2 d-inline">Author</h2>
                        <p>
                            <?php 
                                echo $title_data[0]['first_name'] . ' ';
                                echo $title_data[0]['middle_name'] . ' ';
                                echo $title_data[0]['last_name'];
                                ?>
                        </p>
                        <table>
                            <tbody>
                                <?php echo $choice; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Title -->
                    <div class="book-title">
                        <h2 class="mt-2 d-inline">Title</h2>
                        <p><?php echo $title_data[0]['title_of_book']; ?></p>
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