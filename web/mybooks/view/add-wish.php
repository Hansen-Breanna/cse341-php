<?php
// start session
session_start();

$titleID = $own = $own_wish = $read_wish = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titleID = test_input($_POST['titleID']);

    try {
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

        // //user-book
        insertUserBook($db, $_SESSION['id'], $titleID, $newOwn, $newOwn_wish, $newRead_wish);
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

<h1 class="offset-1 col-10 offset-md-0 col-md-12">Add Wish List Item</h1>
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
                <form method="post" action="">
                    <div>
                        <!-- Author -->
                        <h2 class="author-name mt-2">Author</h2>
                        <table>
                            <tbody>
                                <?php echo $author ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Title -->
                    <div class="book-title">
                        <h2 class="mt-2">Title</h2>
                        <?php echo $bookTitle; ?>
                        <div>
                            <span class="d-flex align-items-center"><input type="checkbox" class="rounded mr-3" id="own" name="own" value="TRUE">Currently Own</span>
                            <span class="d-flex align-items-center"><input type="checkbox" class="rounded mr-3" id="ownWish" name="own_wish" value="TRUE">Own Wish List</span>
                            <span class="d-flex align-items-center"><input type="checkbox" class="rounded mr-3" id="readWish" name="read_wish" value="TRUE">Read Wish List</span>
                        </div>
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