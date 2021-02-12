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
      </div>
      <div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
          echo $message;
        }
        ?>
        <div class="d-flex flex-row flex-wrap justify-content-center">
          <form class="mb-2" method="post" action="">
            <!-- Author -->
            <p class="author-name mt-2">Add Author</p>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              echo $author_message;
            }
            ?>
            <table>
              <tbody>
                <?php echo $author ?>
                <tr>
                  <td><span class="d-flex align-items-center"><input type="checkbox" class="rounded mr-1" id="favorite" name="favorite" value="TRUE">Favorite</span></td>
                  <td><span class="d-flex align-items-center"><input type="checkbox" class="rounded mr-1" id="blacklist" name="blacklist" value="TRUE">Blacklist</span></td>
                </tr>
              </tbody>
            </table>
            <div class="submit">
              <input type="submit" class="rounded btn btm-lg bg-orange">
            </div>
          </form>
          <table class="table table-dark table-striped text-light">
            <thead>
              <tr>
                <th>Authors</th>
                <th>Favorite</th>
                <th>Blacklisted</th>
              </tr>
            </thead>
            <?php echo $authorsTable; ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>