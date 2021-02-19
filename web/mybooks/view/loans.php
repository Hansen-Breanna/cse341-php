<?php
// start session
session_start();

$delete = $loanID = "";

if ($_SERVER["REQUEST_METHOD"] == "GET" && (!isset($_SESSION['id']))) {
  header('Location: index.php?action=sign-up');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['delete'])) {
    try {
      $deleteID = test_input($_POST['delete']);
      deleteLoan($db, $deleteID);
      header('Location: index.php?action=delete-loan');
    } catch (Exception $e) {
      $message = "<p class='px-4 py-3 bg-danger rounded'>Delete failed.</p>";
    }
  } else if (isset($_POST['loanID'])) {
    // $updateID = test_input($_POST['update']);
    // $authorData = getAuthor($updateID);
    // $author = updateAuthor($authorData);
  } else {
    try{
    } catch (Exception $e) {
      $message = "<p class='px-4 py-3 bg-danger rounded'>Loan already exists. Edit loan instead.</p>";
    }
  }
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
      <div>
        <!-- Search Title -->
        <form method="post" action="index.php?action=loans-title">
          <?php include 'common/title.php'; ?>

          <!-- Search Borrowers -->
          <form method="post" action="index.php?action=loans-borrower">
            <?php include 'common/borrower.php'; ?>

            <div class="my-3 mx-2 py-2 border-secondary border-top border-bottom">
              <a href="index.php?action=add-loan" class="btn btn-custom bg-orange my-2 ml-1 ">Add Loan</a>
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