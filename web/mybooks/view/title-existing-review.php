<?php
// start session
session_start();

$titleID = $review = $rating = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titleID = test_input($_POST['titleID']);
    $review = test_input($_POST['review']);
    $rating = test_input($_POST['rating']);

    try {
         // insert review
        insertReview($db, $_SESSION['id'], $titleID, $review, $rating);
    } catch (Exception $e) {
        echo $e;
        $message = "<p class='px-4 py-3 bg-danger rounded'>Review was not added. Please try again.</p>";
    }
}

?>

<!-- Head -->
<?php include 'common/head.php'; ?>

<title>Add Review - My Books</title>

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
            <div class="my-3 mx-2 py-2 border-secondary border-top border-bottom">
                <a href="index.php?action=reviews" title="See All Reviews" class="btn btn-custom bg-info my-2 ml-1">See Reviews</a>
            </div>
            <div>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo $message;
                }
                ?>

                <form method="post" action="index.php?action=title-existing-review">
                    <!-- Title -->
                    <h2 class="mt-2">Title</h2>
                    <div class="book-title">
                        <label class="mr-1">Book title:</label>
                        <?php echo $bookTitle; ?>
                    </div>
                    <h2 class="mt-2">Review</h2>
                    <p>Add review content and rating of 1-5, with 5 being the best.</p>
                    <div class="d-flex justify-content-start pb-2">
                        <label class="mr-2">Content:</label>
                        <textarea class="rounded" cols="45" rows="4" id="review" name="review"></textarea>
                    </div>
                    <div class="pb-1">
                        <label class="mr-2">Rating:</label>
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