<!-- Head -->
<?php include 'common/head.php'; ?>

<title>My Books - Personal Library Application</title>

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
    <div class="row d-md-flex flex-column align-items-around">
      <div class="d-md-flex flex-column align-items-center">
        <form method="post" action="index.php?action=catalog">
          <div>
            <label>Search by Author:</label><br>
            <input class="rounded p-1" type="text" name="first-name" id="first-name" placeholder="First Name">
            <input class="rounded p-1" type="text" name="last-name" id="last-name" placeholder="Last Name">
            <input type='hidden' id='session' name='session' value=''>
          </div>
        </form>
        <form method="post" action="index.php?action=catalog">
          <div class="mt-1">
            <label>Search by Title:</label><br>
            <div class="d-flex align-items-end">
              <input class="rounded p-1" type="text" name="title" id="title" placeholder="Title">
              <input type='hidden' id='session' name='session' value=''>
              <input type="submit" class="btn btn-custom bg-info ml-1">
            </div>
          </div>
        </form>
      </div>
      <div class="d-md-flex justify-content-around">
        <div>
          <h2 class="pt-4">Own Wish List</h2>
          <div class="pb-2">
            <a href="index.php?action=add-book" class="btn btn-custom bg-orange text-light my-2">Add Title</a>
            <a href="index.php?action=remove-book" class="btn btn-custom bg-orange my-2">Remove Title</a>
          </div>
          <table class="table table-dark table-striped text-light">
            <thead>
              <tr>
                <th class="pl-1">Book Title</th>
                <th class="pl-5">Author</th>
              </tr>
            </thead>
            <?php
            echo '<div' . $ownTable . '</div>';
            ?>
          </table>
        </div>
        <div>
          <h2 class="pt-4">Read Wish List</h2>
          <div class="pb-2">
            <a href="index.php?action=add-book" class="btn btn-custom bg-orange text-dark my-2">Add Title</a>
            <a href="index.php?action=remove-book" class="btn btn-custom bg-orange text-dark my-2">Remove Title</a>
          </div>
          <table class="table table-dark table-striped text-light">
            <thead>
              <tr>
                <th class="pl-1">Book Title</th>
                <th class="pl-5">Author</th>
              </tr>
            </thead>
            <?php
            echo '<div' . $readTable . '</div>';
            ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>