<?php
// start session
session_start();

$update_title_id = $own = $own_wish = $read_wish = "";

if ($_SERVER["REQUEST_METHOD"] == "GET" && (!isset($_SESSION['id']))) {
    header('Location: index.php?action=home');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['update_title_id'])) {
            try {
                $book_title_id = test_input($_POST['update_title_id']);
                // get all book data
                $title_data = getUserBookData($db, $_SESSION['id'], $book_title_id);  
                $_SESSION['title_data'] = $title_data;
                // author
                $author_id = $title_data[0]['author_id']; 
                $author_data = getAuthor($author_id);
                // own, own-wish, read-wish
                $choice = displayFavBlackData($author_data);
                $title_choices = displayTitleChoices($title_data);
            } catch (Exception $e) {
                
            }
        }
}

?>

<!-- Head -->
<?php include 'common/head.php'; ?>

<title>Update Wish - My Books</title>

<!-- Nav -->
<?php include 'common/nav.php'; ?>

<!-- Header -->
<?php include '../common/header.php'; ?>

<h1 class="offset-1 col-10 offset-md-0 col-md-12">Update Wish List Item</h1>
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
                <form method="post" action="index.php?action=wish">
                    <div>
                        <!-- Author -->
                        <h2 class="author-name mt-2">Author</h2>
                        <table>
                            <tbody>
                                <?php echo $author; ?>
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