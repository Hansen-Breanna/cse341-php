<?php
// start session
session_start ();

if ($_SERVER["REQUEST_METHOD"] == "GET" && (!isset($_SESSION))) { 
  //$_SESSION['id'] = array(); 
}

?>

<!-- Head -->
<?php include 'common/head.php'; ?>

    <title>Loans - My Books</title>

<!-- Nav -->
<?php include 'common/nav.php'; ?>

<!-- Header -->
<?php include '../common/header.php'; ?>

              <h1 class="offset-1 col-10 offset-md-0 col-md-12">Loaned Books</h1>
          </div>
      </div>
    </header>
    
    <main class="mb-5">
      <div class="container">
      <div class="row d-flex flex-column align-items-center">
                     <!-- Search Boxes -->
                     <?php include 'common/search.php'; ?>

                     <p>SMS message reminders must be sent from a mobile device.</a>
          <table class="table table-dark table-striped text-light">
            <thead>
              <tr>
                <th class="pl-2">Book Title</th>
                <th>Borrower</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
                <th>Contact</th>
              </tr>
            </thead>
            <tbody>
              <?php echo $loansTable; ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>