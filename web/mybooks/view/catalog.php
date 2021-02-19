<?php
// start session
session_start();
$title = $first_name = $last_name = $deleteID = $updateID = "";

if ($_SERVER["REQUEST_METHOD"] == "GET" && (!isset($_SESSION['id']))) {
  header('Location: index.php?action=home');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = test_input($_POST["title"]);
  $first_name = test_input($_POST["first_name"]);
  $last_name = test_input($_POST["last_name"]);
  $_SESSION['title'] = $title;
  $_SESSION['first_name'] = $first_name;
  $_SESSION['last_name'] = $last_name;

  if (isset($_POST['deleteID'])) {
    try {
      $deleteID = test_input($_POST['deleteID']);
      deleteTitle($db, $_SESSION['id'], $deleteID);
      header('Location: index.php?action=delete-title');
    } catch (Exception $e) {
      echo $e;
      $message = "<p class='px-4 py-3 bg-danger rounded'>Delete failed.</p>";
    }
  } else if (isset($_POST['updateID'])) {
    // $updateID = test_input($_POST['update']);
    // $authorData = getAuthor($updateID);
    // $author = updateAuthor($authorData);
  } else {
    try {
    } catch (Exception $e) {
      echo $e;
    }
  }
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