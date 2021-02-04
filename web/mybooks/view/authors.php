<?php
// start session
session_start ();

?>

<!-- Head -->
<?php include 'common/head.php'; ?>

<title>Authors - My Books</title>

<!-- Nav -->
<?php include 'common/nav.php'; ?>

<!-- Header -->
<?php include '../common/header.php'; ?>

<h1 class="offset-1 col-10 offset-md-0 col-md-12">Authors</h1>
</div>
</div>
</header>

<main class="mb-5">
  <div class="container">
  <div class="row d-flex flex-column align-items-center">
    <div>
      <!-- Search Author -->
      <form method="post" action="index.php?action=wish-author">
      <?php include 'common/author.php'; ?>
    </div>
    <div>
      <table class="table table-dark table-striped text-light">
        <thead>
          <tr>
            <th>Authors</th>
            <th>Favorite</th>
            <th>Blacklisted</th>
          </tr>
        </thead>
        <tbody>
          <?php echo $authorsTable; ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>