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

        //user_author
        insertUserAuthor($db, $_SESSION['id'], $newAuthorID, $newBlacklist, $newFavorite);

        //book
        insertTitle($db, $newAuthorID, $title);
        $newTitleID = $db->lastInsertId('book_title_id_seq');

        // //user-book
        insertUserBook($db, $_SESSION['id'], $newTitleID, $newOwn, $newOwn_wish, $newRead_wish);
    } catch (Exception $e) {
        $message = "<p class='px-4 py-3 bg-danger rounded'>Title was not added. Please try again.</p>";
    }
}

?>

<!-- Head -->
<?php include 'common/head.php'; ?>

<title>Catalog - My Books</title>

<!-- Nav -->
<?php include 'common/nav.php'; ?>

<!-- Header -->
<?php include '../common/header.php'; ?>

<h1 class="offset-1 col-10 offset-md-0 col-md-12">Add Review</h1>
</div>
</div>
</header>

<main class="mb-5">
    <div class="container">
        <div class="row d-flex flex-column align-items-center">
            <div>
                <a href="index.php?action=catalog" title="See All Titles" class="btn btn-custom bg-info my-2 ml-1">See Catalog</a>
                <a href="index.php?action=wish" title="See All Wishes" class="btn btn-custom bg-info my-2 ml-1">See Wish List</a>
            </div>
            <div>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo $message;
                }
                ?>

                <form method="post" action="">
                    <div>
                        <!-- Author -->
                        <h2 class="author-name mt-2">Author</h2>
                        <p>Enter name for a new or existing author.</p>
                        <p>
                            <a href="index.php?action=add-title" class="btn bg-orange p-2" title="Add title by with new author">Add New</a>
                            <a href="index.php?action=existing-author" class="btn bg-orange p-2" title="Add title by existing author">Use Existing</a>
                        </p>
                        <table>
                            <tbody>
                                <?php echo $author ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Title -->
                    <h2 class="mt-2">Title</h2>
                    <div class="book-title">
                        <label>Book title:</label>
                        <input type="text" class="rounded" id="title" name="title">
                    </div>
                    <h2 class="mt-2">Review</h2>
                    <p>Add review content and rating of 1-5, with 5 being the best.</p>
                    <div class="d-flex justify-content-start mb-2">
                        <label class="mr-1">Content:</label>
                        <textarea class="rounded" col="100" rows="4" id="review-content" name="review"></textarea>
                    </div>
                    <div class="mb-1">
                        <label class="mr-1">Rating:</label>
                        <select name="rating" id="rating">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
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