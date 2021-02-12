<?php
// start session
session_start();

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
      </div>
    </div>
    <div>
      <div class="d-flex justify-content-center">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
          echo $message;
        }
        ?>

      </div>
      <div class="d-flex flex-row flex-wrap justify-content-around">
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
            echo $ownTable;
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
            echo $readTable;
            ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>