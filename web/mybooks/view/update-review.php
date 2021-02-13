<?php
// start session
session_start();

$reviewID = $review = $rating = $update = $update_review = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reviewID = test_input($_POST['reviewid']);
    $rating = test_input($_POST['rating']);
    $review = test_input($_POST['review']);
    
    if (isset($_POST['update'])) {
        $reviewID = test_input($_POST['reviewid']);
        $reviewData = getReview($db, $reviewid);
        echo "update" .$reviewID . ' ' . $review . ' ' . $rating . ' ' . $update . ' ' . $update_review;
        var_dump($reviewData);
    } else {
        try {
            if (isset($_POST['update_review'])) {
                $reviewID = test_input($_POST['reviewid']);
                updateReview($db, $reviewID, $review, $rating);
                $message = "<p class='px-4 py-3 bg-danger rounded'>Review was successfully updated.</p>";
                //header('Location: index.php?action=update-review');
            }
        } catch (Exception $e) {
            echo $e;
            $message = "<p class='px-4 py-3 bg-danger rounded'>Review was not added. Please try again.</p>";
        }
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

<h1 class="offset-1 col-10 offset-md-0 col-md-12">Update Review</h1>
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
                <p>If you wish to change the author and/or title, please delete the current review and create a new review instead.</p>
                <form method="post" action="index.php?action=update-review">
                    <div>
                        <!-- Author -->
                        <h2 class="author-name mt-2">Author</h2>
                        <p>Name: <?php echo $reviewData[0]['first_name']  . ' ' . $reviewData[0]['middle_name'] . ' ' . $reviewData[0]['last_name'];?> </p>
                    </div>
                    <!-- Title -->
                    <h2 class="mt-2">Title</h2>
                    <p>Book title: <?php echo $reviewData[0]['title_of_book'];?></p>
                    <h2 class="mt-2">Review</h2>
                    <p>Add review content and rating of 1-5, with 5 being the best.</p>
                    <div class="d-flex justify-content-start pb-2">
                        <label class="mr-2">Content:</label>
                        <textarea class="rounded" cols="45" rows="4" id="review" name="review"><?php echo $reviewData[0]['review'];?></textarea>
                    </div>
                    <div class="pb-1">
                        <label class="mr-2">Rating:</label>
                        <select name="rating" id="rating">
                        <?php 
                            for ($i = 1; $i <= 5; $i++) {
                                if ($reviewData[0]['rating'] == $i) {
                                    echo "<option value='$i' selected>$i</option>";
                                } else {
                                    echo "<option value='$i'>$i</option>";
                                }
                            }
                        ?>
                        </select>
                    </div>
                    <div>
                        <input type="hidden" name="reviewid" value="<?php echo $reviewData[0]['id']; ?>" id="reviewid"> 
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