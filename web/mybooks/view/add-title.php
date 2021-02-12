<?php
// start session
session_start();

$first_name = $middle_name = $last_name =  $title = $authorID = "";
$favorite = $blacklist = $own = $own_wish = $read_wish = "FALSE";

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
        } // else {
        //     $favorite = "FALSE";
        // }
        $newFavorite = removeQuotes($favorite);

        $blacklist = test_input($_POST["blacklist"]);
        if (isset($_POST['blacklist'])) {
            $blacklist = "TRUE";
        } // else {
        //     $blacklist = "FALSE";
        // }
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

<h1 class="offset-1 col-10 offset-md-0 col-md-12">Add Title</h1>
</div>
</div>
</header>

<main class="mb-5">
    <div class="container">
        <div class="row d-flex flex-column align-items-center">
            <div>
                <a href="index.php?action=catalog" title="See All Titles" class="btn btn-custom bg-info my-2 ml-1">See All Titles</a>
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
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            echo $author_message;
                        }
                        ?>
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
                    <div class="book-title">
                        <h2 class="mt-2">Title</h2>
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            echo $title_message;
                        }
                        ?>
                        <table>
                            <tbody>
                                <tr>
                                    <td><label>Book title:</label></td>
                                    <td><input type="text" class="rounded" id="title" name="title"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="d-flex align-items-center"><input type="checkbox" class="rounded mr-1" id="own" name="own" value="TRUE">Currently Own</span>
                                        <span class="d-flex align-items-center"><input type="checkbox" class="rounded mr-1" id="ownWish" name="own_wish" value="TRUE">Own Wish List</span>
                                        <span class="d-flex align-items-center"><input type="checkbox" class="rounded mr-1" id="readWish" name="read_wish" value="TRUE">Read Wish List</span>
                                    </td>
                                </tr>
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