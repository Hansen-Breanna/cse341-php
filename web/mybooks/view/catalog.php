<?php
// start session
session_start();
$title = $first_name = $last_name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = test_input($_POST["title"]);
  $first_name = test_input($_POST["first_name"]);
  $last_name = test_input($_POST["last_name"]);
  $_SESSION['title'] = $title;
  $_SESSION['first_name'] = $first_name;
  $_SESSION['last_name'] = $last_name;
}

?>

<!-- Head -->
<?php include 'common/head.php'; ?>

<title>Catalog - My Books</title>

<!-- Nav -->
<?php include 'common/nav.php'; ?>

<!-- Header -->
<?php include '../common/header.php'; ?>

<h1 class="offset-1 col-10 offset-md-0 col-md-12">Book Catalog</h1>
</div>
</div>
</header>

<main class="mb-5">
  <div class="container">
    <div class="row d-flex flex-column align-items-center">
      <div>
        <!-- Search Title -->
        <form method="post" action="index.php?action=catalog-title">
          <?php
          include 'common/title.php';
          ?>

          <!-- Search Author -->
          <form method="post" action="index.php?action=catalog-author">
            <?php include 'common/author.php'; ?>

            <!-- Add/Remove -->
            <?php include 'common/add-remove-title.php'; ?>
            <a href="index.php?action=catalog" title="See All Titles" class="btn btn-custom bg-info my-2 ml-1">See All Titles</a>
      </div>
    </div>
    <div>
      <?php
      if ($_SERVER["REQUEST_METHOD"] == "GET") {
        echo $message;
      }
      ?>
      <table class="table table-dark table-striped text-light">
        <thead>
          <tr>
            <th class="pl-1">Book Title</th>
            <th class="pl-5">Author</th>
            <th class="pl-5"></th>
          </tr>
        </thead>
        <?php
        echo $catalogTable;
        ?>
      </table>
    </div>
  </div>
  </div>
</main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>