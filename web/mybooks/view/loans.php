<?php
// start session
session_start();

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
      <div>
        <!-- Search Title -->
        <form method="post" action="index.php?action=loans-title">
          <?php include 'common/title.php'; ?>

          <!-- Search Borrowers -->
          <form method="post" action="index.php?action=loans-borrower">
            <?php include 'common/borrower.php'; ?>

            <div class="my-3 mx-2 py-2 border-secondary border-top border-bottom">
              <a href="index.php?action=add-loan" class="btn btn-custom bg-orange my-2 ml-1 ">Add Borrower</a>
              <a href="index.php?action=add-loan" class="btn btn-custom bg-orange my-2 ml-1 ">Add Loan</a>
              <a href="index.php?action=loans" title="See All Borrowers" class="btn btn-custom my-2 ml-1 bg-info">See All Borrowers</a>
            </div>
      </div>
      <p class="font-blue mx-1">SMS message reminders must be sent from a mobile device.</p>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
          echo $message;
        }
        ?>
      <table class="table table-dark table-striped text-light">
        <thead>
          <tr>
            <th class="pl-2 d-none d-md-table-cell">Book Title</th>
            <th>Borrower</th>
            <th class="d-none d-lg-table-cell">Borrow Date</th>
            <th>Due Date</th>
            <th>Contact</th>
          </tr>
        </thead>
          <?php echo $loansTable; ?>
      </table>
    </div>
  </div>
</main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>