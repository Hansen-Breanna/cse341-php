<?php
// start session
session_start();

$first_name = $middle_name = $last_name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $first_name = test_input($_POST["first_name"]);
  $middle_name = test_input($_POST["middle_name"]);
  $last_name = test_input($_POST["last_name"]);

  try {
    // author
    insertAuthor($db, $first_name, $middle_name, $last_name);
    $newAuthorID = $db->lastInsertId('author_id_seq');

    //user_author
    insertUserAuthor($db, $_SESSION['id'], $newAuthorID, $newBlacklist, $newFavorite);

    $message = "<p class='px-4 py-3 bg-danger rounded'>$first_name $middle_name $last_name was successfully added to the author list.</p>";
    header('Location: index.php?action=authors');
  } 
  catch (Exception $e) {
    $authorExists = "<p class='px-4 py-3 bg-danger rounded'>Author already exists. Edit author instead.</p>";
  }
}
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
          echo $message;
          echo $authorExists;
        ?>
        <div class="d-flex flex-row flex-wrap justify-content-center">
          <form class="mb-2" method="post" action="">
            <!-- Author -->
            <h2 class="author-name mt-2">Add Author</h2>
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
              <input type="submit" class="rounded btn btm-lg bg-orange mb-2">
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