<?php
// start session
session_start ();

if ($_SERVER["REQUEST_METHOD"] == "GET" && (!isset($_SESSION))) { 
  $_SESSION['id'] = array(); 
} else {
  echo $_SESSION['id'];
}

?>

<!-- Head -->
<?php include 'common/head.php'; ?>

<title>My Books - Personal Library Application</title>

<!-- Nav -->
<?php include 'common/nav.php'; ?>

<!-- Header -->
<?php include '../common/header.php'; ?>

<h1 class="offset-1 col-10 offset-md-0 col-md-12 pb-2">My Wish Lists</h1>
</div>
</div>
</header>

<main class="mb-5">
  <div class="container">
    <div class="row d-flex flex-column align-items-center">
      <!-- Search Boxes -->
      <?php include 'common/search.php'; ?>
      <div>
        <div class="d-flex justify-content-around">
          <div class="m-2">
            <h2 class="pt-4">Own Wish List</h2>
            <table class="table table-dark table-striped text-light m-2">
              <thead>
                <tr>
                  <th class="pl-1">Book Title</th>
                  <th class="pl-5">Author</th>
                </tr>
              </thead>
              <?php
              echo '<div>' . $ownTable . '</div>';
              ?>
            </table>
          </div>
          <div class="m-2">
            <h2 class="pt-4">Read Wish List</h2>
            <table class="table table-dark table-striped text-light m-2">
              <thead>
                <tr>
                  <th class="pl-1">Book Title</th>
                  <th class="pl-5">Author</th>
                </tr>
              </thead>
              <?php
              echo '<div' . $readTable . '</div>';
              ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>