<?php
// start session
session_start ();

if ($_SERVER["REQUEST_METHOD"] == "GET" && (!isset($_SESSION))) { 
 // $_SESSION['id'] = array(); 
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
    <a href="index.php?action=add-book" class="btn btn-custom bg-orange text-dark my-2 mr-2">Add Review</a>
    <a href="index.php?action=remove-book" class="btn btn-custom bg-orange text-dark my-2">Remove Review</a>
</div>
      </div>

        <?php echo $reviewsTable; ?>

        </div>
      </div>
    </main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>