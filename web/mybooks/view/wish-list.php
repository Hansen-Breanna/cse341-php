<?php
// start session
session_start();

$own_wish = $read_wish = $id = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try{
    $id = test_input($_POST["id"]);

    $own_wish = test_input($_POST["own_wish"]);
    if (isset($_POST['own_wish'])) {
        $own_wish = "TRUE";
    } else {
        $own_wish = "FALSE";
    }
    $newOwn_wish = removeQuotes($own_wish);

    $read_wish = test_input($_POST["read_wish"]);
    if (isset($_POST['read_wish'])) {
        $read_wish = "TRUE";
    } else {
        $read_wish = "FALSE";
    }
    $newRead_wish = removeQuotes($read_wish);

          //user_author
          insertUserAuthor($db, $_SESSION['id'], $newAuthorID, $newBlacklist, $newFavorite);
          header('Location: index.php?action=add-new-author');
      } catch (Exception $e) {
        $authorExists = "<p class='px-4 py-3 bg-danger rounded'>Author already exists. Edit author instead.</p>";
      }
    }

?>

<!-- Head -->
<?php include 'common/head.php'; ?>

<title>Wish List - My Books</title>

<!-- Nav -->
<?php include 'common/nav.php'; ?>

<!-- Header -->
<?php include '../common/header.php'; ?>

<h1 class="offset-1 col-10 offset-md-0 col-md-12 pb-2">My Wish Lists</h1>
</div>
</div>
</header>

<main class="mb-5">
  <div class="container">
    <div class="row d-flex flex-column align-items-center">
      <div>
        <!-- Search Title -->
        <form method="post" action="index.php?action=wish-title">
          <?php include 'common/title.php'; ?>

          <!-- Search Author -->
          <form method="post" action="index.php?action=wish-author">
            <?php include 'common/author.php'; ?>

            <!-- Add/Remove -->
            <a href="index.php?action=wish" title="See All Wishes" class="btn btn-custom bg-info my-2 ml-1">See All Wishes</a>
      </div>
    </div>
    <div>
      <div class="d-flex justify-content-center">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
          echo $message;
        }
        ?>

        <form method="post" action="">
          <div>
            <h2 class="author-name mt-2">Add to Wish List</h2>
            <p>Enter name for a new or existing author.</p>
            <p>
              <a href="index.php?action=add-title" class="btn bg-orange p-2" title="Add title by with new author">Add New</a>
              <a href="index.php?action=existing-author" class="btn bg-orange p-2" title="Add title by existing author">Use Existing</a>
            </p>
            <?php echo $author ?>
            <div class="d-flex row-wrap">
              <span class="d-flex align-items-center mr-3"><input type="checkbox" class="rounded mr-1" id="ownWish" name="own_wish" value="TRUE">Own Wish List</span>
              <span class="d-flex align-items-center"><input type="checkbox" class="rounded mr-1" id="readWish" name="read_wish" value="TRUE">Read Wish List</span>
            </div>
            <div class="submit">
              <input type="submit" class="rounded btn btm-lg bg-orange">
            </div>
          </div>
        </form>
      </div>
      <div class="d-flex flex-row flex-wrap justify-content-around">
        <div class="m-2">
          <h2 class="pt-4">Own Wish List</h2>
          <table class="table table-dark table-striped text-light m-2">
            <thead>
              <tr>
                <th class="pl-1">Book Title</th>
                <th class="pl-5">Author</th>
              </tr>
            </thead>
            <?php
            echo $ownTable;
            ?>
          </table>
        </div>
        <div class="m-2">
          <h2 class="pt-4">Read Wish List</h2>
          <table class="table table-dark table-striped text-light m-2">
            <thead>
              <tr>
                <th class="pl-1">Book Title</th>
                <th class="pl-5">Author</th>
              </tr>
            </thead>
            <?php
            echo $readTable;
            ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>