<?php
// start session
session_start();

$update_title_id = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['update_title_id'])) {
      $book_title_id = test_input($_POST['update_title_id']);
      // get all book data
      $title_data = getUserBookData($db, $user_id, $book_title_id);  
      var_dump($title_data);
      $_SESSION['title_data'] = $title_data;
      // author
      $author_id = $title_data[0]['author_id']; 
      $author_data = getAuthor($author_id);
      // own, own-wish, read-wish
      $title_choices = displayTitleChoices($title_data);
  } else {
      try {
          if (isset($_POST['update_title'])) {
              $book_title_id = $_SESSION['title_data'][0]['book_title_id'];
              $author_id = $_SESSION['title_data'][0]['author_id'];

              $own = test_input($_POST["own"]);
              if (isset($_POST['own'])) {
                  $own = "TRUE";
              } else {
                  $own = "FALSE";
              }
              $new_own = removeQuotes($own);

              $own_wish = test_input($_POST["own_wish"]);
              if (isset($_POST['own_wish'])) {
                  $own_wish = "TRUE";
              } else {
                  $own_wish = "FALSE";
              }
              $new_own_wish = removeQuotes($own_wish);

              $read_wish = test_input($_POST["read_wish"]);
              if (isset($_POST['read_wish'])) {
                  $read_wish = "TRUE";
              } else {
                  $read_wish = "FALSE";
              }
              $new_read_wish = removeQuotes($read_wish);
              
              // update user_book
              updateUserBook($db, $user_id, $book_title_id, $new_own, $new_own_wish, $new_read_wish);

              unset($_SESSION['title_data']);
              header('Location: index.php?action=catalog');
          } 
      } catch (Exception $e) {
          echo $e;
          $message = "<p class='px-4 py-3 bg-danger rounded'>Loan was not updated. Please try again.</p>";
      }
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
      </div>
    </div>
    <div>
      <div class="d-flex justify-content-center">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
          echo $message;
        }
        ?>
        <div>
          <div class="my-3 mx-2 py-2 border-secondary border-top border-bottom">
            <h2 class="author-name mt-2">Add to Wish List</h2>
            <p>Add a wish list item with for a new or existing title.</p>
            <p>
              <a href="index.php?action=add-title" class="btn bg-orange p-2" title="Add title by with new author">Add New Title & Author</a>
              <a href="index.php?action=existing-author" class="btn bg-orange p-2" title="Add title by existing author">Add New Title & Existing Author</a>
              <a href="index.php?action=update-title" class="btn bg-orange p-2" title="Add title by existing author">Edit Current Title</a>
            </p>
          </div>
        </div>
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