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
                <!-- Search Boxes -->
                <?php include 'common/search.php'; ?>

        <?php echo $reviewsTable; ?>

        </div>
      </div>
    </main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>