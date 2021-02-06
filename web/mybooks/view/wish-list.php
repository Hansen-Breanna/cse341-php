<?php
// start session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && (!isset($_SESSION))) {
} else {
}

?>

<!-- Head -->
<?php include 'common/head.php'; ?>

<title>Wish List - My Books</title>

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
      <div>
        <!-- Search Title -->
        <form method="post" action="index.php?action=wish-title">
          <?php include 'common/title.php'; ?>

          <!-- Search Author -->
          <form method="post" action="index.php?action=wish-author">
            <?php include 'common/author.php'; ?>

            <!-- Add/Remove -->
            <?php include 'common/add-remove-title.php'; ?>
            <a href="index.php?action=wish" title="See All Wishes" class="btn btn-custom bg-info my-2 ml-1">See All Wishes</a>
      </div>
    </div>
    <div>
      <?php
      if ($_SERVER["REQUEST_METHOD"] == "GET") {
        echo $message;
      }
      ?>
      <div class="d-flex flex-row flex-wrap justify-content-around">
        <div class="m-2">
          <h2 class="pt-4">Own Wish List</h2>
          <table class="table table-dark table-striped text-light m-2 w-lg-50">
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
          <table class="table table-dark table-striped text-light m-2 w-lg-50">
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