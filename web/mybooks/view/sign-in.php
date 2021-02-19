<?php
// start session
session_start();

$first_name = $middle_name = $last_name =  $title = $authorID = "";
$favorite = $blacklist = $own = $own_wish = $read_wish = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $authorID = test_input($_POST['authorID']);

    try {
        if (isset($_POST['authorID'])) {
            $newAuthorID = $authorID;
        } else {
            $first_name = test_input($_POST["first_name"]);
            $middle_name = test_input($_POST["middle_name"]);
            $last_name = test_input($_POST["last_name"]);

            //author
            insertAuthor($db, $first_name, $middle_name, $last_name);
            $newAuthorID = $db->lastInsertId('author_id_seq');
        }

        $favorite = test_input($_POST["favorite"]);
        if (isset($_POST['favorite'])) {
            $favorite = "TRUE";
        } else {
            $favorite = "FALSE";
        }
        $newFavorite = removeQuotes($favorite);

        $blacklist = test_input($_POST["blacklist"]);
        if (isset($_POST['blacklist'])) {
            $blacklist = "TRUE";
        } else {
            $blacklist = "FALSE";
        }
        $newBlacklist = removeQuotes($blacklist);

        $title = test_input($_POST["title"]);

        $own = test_input($_POST["own"]);
        if (isset($_POST['own'])) {
            $own = "TRUE";
        } else {
            $own = "FALSE";
        }
        $newOwn = removeQuotes($own);

        $own_wish = test_input($_POST["own_wish"]);
        if (isset($_POST['own_wish'])) {
            $own_wish = "TRUE";
        } else {
            $own_wish = "FALSE";
        }
        $newOwn_wish = removeQuotes($own_wish);

        $read_wish = test_input($_POST["read_wish"]);
        if (isset($_POST['read_wish'])) {
            $read_wish = "TRUE";
        } else {
            $read_wish = "FALSE";
        }
        $newRead_wish = removeQuotes($read_wish);

        $_SESSION['title'] = $title;

        if (!isset($_POST['authorID'])) {
            //user_author
            insertUserAuthor($db, $_SESSION['id'], $newAuthorID, $newBlacklist, $newFavorite);
        }

        //book
        insertTitle($db, $newAuthorID, $title);
        $newTitleID = $db->lastInsertId('book_title_id_seq');

        // //user-book
        insertUserBook($db, $_SESSION['id'], $newTitleID, $newOwn, $newOwn_wish, $newRead_wish);
    } catch (Exception $e) {
        $message = "<p class='px-4 py-3 bg-danger rounded'>Title was not added. Please check for existing author and try again.</p>";
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

<h1 class="offset-1 col-10 offset-md-0 col-md-12">My Books</h1>
<h2>Please register or log in.</h2>
</div>
</div>
</header>

<main class="mb-5">
    <div class="container">
        <div class="row d-flex flex-column align-items-center">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo $message;
            }
            ?>

        </div>
    </div>
</main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>