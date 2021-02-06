<?php
// start session
session_start();

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
        <form method="post" action="index.php?action=get-author">
          <?php include 'common/author.php'; ?>
          <a href="index.php?action=authors" title="See All Authors" class="btn btn-custom bg-orange my-1 mx-2 py-2">See All Authors</a>

          <div class="my-3 mx-2 py-2 border-secondary border-top border-bottom">
            <a href="index.php?action=add-book" class="btn btn-custom bg-orange text-dark my-2 mr-2">Add Author</a>
            <a href="index.php?action=remove-book" class="btn btn-custom bg-orange text-dark my-2">Remove Author</a>
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