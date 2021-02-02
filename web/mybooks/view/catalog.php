<?php
// start session
session_start ();

if ($_SERVER["REQUEST_METHOD"] == "GET" && (!isset($_SESSION))) {
  $_SESSION["id"] = array();   
} else {
  echo $_SESSION['id'];
  var_dump($_SESSION);
}


?>

<!-- Head -->
<?php include 'common/head.php'; ?>

    <title>My Books - Personal Library Application</title>

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
            <!-- Search Boxes -->
            <?php include 'common/search.php'; ?>
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