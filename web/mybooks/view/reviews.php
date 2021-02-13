<?php
// start session
session_start();

$update = $delete = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['delete'])) {
    echo $_POST['delete'];
    try {
      $deleteID = test_input($_POST['delete']);
      deleteReview($db, $deleteID);
      header('Location: index.php?action=reviews');
    } catch (Exception $e) {
      $message = "<p class='px-4 py-3 bg-danger rounded'>Delete failed.</p>";
    }
  } else if (isset($_POST['update'])) {
    // $updateID = test_input($_POST['update']);
    // $authorData = getAuthor($updateID);
    // $author = updateAuthor($authorData);
  } else {
    try {
    } catch (Exception $e) {
      $message = "<p class='px-4 py-3 bg-danger rounded'>Review already exists. Edit review instead.</p>";
    }
  }
}

?>

<!-- Head -->
<?php include 'common/head.php'; ?>

<title>Reviews - My Books</title>

<!-- Nav -->
<?php include 'common/nav.php'; ?>

<!-- Header -->
<?php include '../common/header.php'; ?>

<h1 class="offset-1 col-10 offset-md-0 col-md-12">Book Reviews</h1>
</div>
</div>
</header>

<main class="mb-5">
  <div class="container">
    <div class="row d-flex flex-column align-items-center">
      <div>
        <!-- Search Title -->
        <form method="post" action="index.php?action=reviews-title">
          <?php include 'common/title.php'; ?>

          <!-- Search Author -->
          <form method="post" action="index.php?action=reviews-author">
            <?php include 'common/author.php'; ?>

            <!-- Add/Remove -->
            <div class="my-3 mx-2 py-2 border-secondary border-top border-bottom">
              <a href="index.php?action=add-review" class="btn bg-orange my-2 ml-1">Add Review for New Title</a>
              <a href="index.php?action=title-existing-review" class="btn bg-orange my-2 ml-1">Add Review for Existing Title</a>
            </div>
      </div>
      <?php
      if ($_SERVER["REQUEST_METHOD"] == "GET") {
        echo $message;
      }
      ?>

      <?php echo $reviewsTable; ?>

    </div>
  </div>
</main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>