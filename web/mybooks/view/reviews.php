<?php
// start session
session_start ();

?>

<!-- Head -->
<?php include 'common/head.php'; ?>

    <title>My Books - Personal Library Application</title>

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
          <!-- <table class="table table-dark table-striped text-light">
            <thead>
              <tr>
                <th class="pl-1">Book Title</th>
                <th class="pl-5">Author</th>
                <th class="pl-5">Review</th>
                <th class="pl-5">Rating</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table> -->
        </div>
      </div>
    </main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>