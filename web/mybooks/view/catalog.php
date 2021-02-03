<?php
// start session
session_start ();

$title = $first_name = $last_name = "";

if ($_SERVER["REQUEST_METHOD"] == "GET" && (!isset($_SESSION))) {
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = test_input($_POST["title"]);
  $first_name = test_input($_POST["first_name"]);
  $last_name = test_input($_POST["last_name"]);
  if ($title != "") {
      echo "title";
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
            <form method="post" action="index.php?action=catalog">
            <?php include 'common/title.php'; ?>

            <!-- Search Author -->
            <form method="post" action="index.php?action=catalog">
            <?php include 'common/author.php'; ?>
          </div>
          <div>
            <table class="table table-dark table-striped text-light">
                <thead>
                  <tr>
                    <th class="pl-1">Book Title</th>
                    <th class="pl-5">Author</th>
                  </tr>
                </thead>
                <tbody>
                  <?php echo $catalogTable; ?>
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>