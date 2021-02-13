<?php
// start session
session_start();

$first_name = $middle_name = $last_name = $delete = $update = "";
$favorite = $blacklist = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $first_name = test_input($_POST["first_name"]);
  $middle_name = test_input($_POST["middle_name"]);
  $last_name = test_input($_POST["last_name"]);

  if (isset($_POST['delete'])) {
    try {
      $deleteID = test_input($_POST['delete']);
      deleteAuthor($db, $_SESSION['id'], $deleteID);
      header('Location: index.php?action=delete-author');
    } catch (Exception $e) {
      echo $e;
      $message = "<p class='px-4 py-3 bg-danger rounded'>Delete failed.</p>";
    }
  } else if (isset($_POST['update'])) {
    $updateID = test_input($_POST['update']);
    $authorData = getAuthor($updateID);
    $author = updateAuthor($authorData);
  } else {
    try {
      if (isset($_POST['favorite'])) {
        $favorite = "TRUE";
      } else {
        $favorite = "FALSE";
      }
      $newFavorite = removeQuotes($favorite);

      $blacklist = test_input($_POST["blacklist"]);
      if (isset($_POST['blacklist'])) {
        $blacklist = "TRUE";
      } else {
        $blacklist = "FALSE";
      }
      $newBlacklist = removeQuotes($blacklist);

      try {
        // author
        insertAuthor($db, $first_name, $middle_name, $last_name);
        $newAuthorID = $db->lastInsertId('author_id_seq');
      } catch (Exception $e) {
        $newAuthorID = getAuthorID($db, $first_name, $middle_name, $last_name);
      } finally {
        //user_author
        insertUserAuthor($db, $_SESSION['id'], $newAuthorID, $newBlacklist, $newFavorite);
        header('Location: index.php?action=add-new-author');
      }
    } catch (Exception $e) {
      $authorExists = "<p class='px-4 py-3 bg-danger rounded'>Author already exists. Edit author instead.</p>";
    }
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
          <div class="my-3 mx-2 py-2 border-secondary border-top border-bottom">
            <form class="mb-2" method="post" action="index.php?action=authors">
              <!-- Author -->
              <h2 class="author-name mt-2">Add Author</h2>
              <table>
                <tbody>
                  <?php echo $author . $choice; ?>
                </tbody>
              </table>
              <div class="submit">
                <input type="submit" class="rounded btn btm-lg bg-orange mb-2">
              </div>
            </form>
            <div class="my-3 mx-2 py-2 border-secondary border-top border-bottom">
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