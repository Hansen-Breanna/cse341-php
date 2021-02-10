<?php
// start session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = test_input($_POST["title"]);
  $first_name = test_input($_POST["first_name"]);
  $last_name = test_input($_POST["last_name"]);
  $_SESSION['title'] = $title;
  $_SESSION['first_name'] = $first_name;
  $_SESSION['last_name'] = $last_name;
}

?>

<!-- Head -->
<?php include 'common/head.php'; ?>

<title>Catalog - My Books</title>

<!-- Nav -->
<?php include 'common/nav.php'; ?>

<!-- Header -->
<?php include '../common/header.php'; ?>

<h1 class="offset-1 col-10 offset-md-0 col-md-12">Book Catalog</h1>
</div>
</div>
</header>

<main class="mb-5">
  <div class="container">
    <div class="row d-flex flex-column align-items-center">
      <div>
        <!-- Search Title -->
        <form method="post" action="index.php?action=catalog-title">
          <?php
          include 'common/title.php';
          ?>

          <!-- Search Author -->
          <form method="post" action="index.php?action=catalog-author">
            <?php include 'common/author.php'; ?>

            <!-- Add/Remove -->
            <?php include 'common/add-remove-title.php'; ?>
            <a href="index.php?action=catalog" title="See All Titles" class="btn btn-custom bg-info my-2 ml-1">See All Titles</a>
      </div>
    </div>
    <div>
      <?php
      if ($_SERVER["REQUEST_METHOD"] == "GET") {
        echo $message;
      }
      ?>

<form method="post" action="">
      <div>
          <!-- Author -->
      <div class="author">
          <p>Author name:
                <label for="first-name">First name:</label>
                <input type="text" name="first-name" id="first-name"><br>
            </div>
            <div class="middle-name">
                <label for="chapter">Middle Name:</label>
                <input type="text" name="middle-name" id="middle-name"><br>
            </div>
            <div class="last-name">
                <label for="verse">Last name:</label>
                <input type="text" name="last-name" id="last-name"><br>
            </div>
            <div>
                <input type="checkbox" id="favorite" name="favorite">Favorite<br>
                <input type="checkbox" id="blacklist" name="blacklist">Blacklist<br>
            </div>
      </div>
      <!-- Title -->
      <div class="title">
          <label>Book title:</label>
          <input type="text" id="title" name="title">
      </div>
      <div class="user-title">
            <!-- library_user_id
          book_title_id
          owned
          own Wish
          read wish -->
          <input type="checkbox" id="own" name="own">Own<br>
          <input type="checkbox" id="ownWish" name="ownWish">Own Wish List<br>
          <input type="checkbox" id="readWish" name="readWish">Read Wish List<br>
      </div>
          
          <!-- author
          first, middle, last

          user-Author
          library_user_id
          author_id
          Blacklisted
          Favorite
          
          book
          --title
          author id

          user-book
          library_user_id
          book_title_id
          owned
          own Wish
          read wish -->

            <div class="submit">
                <input type="submit">
            </div>
        </form>
      
    </div>
  </div>
  </div>
</main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>