<!-- Head -->
<?php include 'common/head.php'; ?>

    <title>My Books - Personal Library Application</title>

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
        <div class="row d-flex justify-content-center">
          <div>
            <form method="post" action="catalog.php"> 
            <form method="post" action="index.php?action=catalog"> 
              <div>
                  <label>Search by Author:</label><br>
                  <input class="rounded p-1" type="text" name="first-name" id="first-name" placeholder="First Name">
                  <input class="rounded p-1" type="text" name="last-name" id="last-name" placeholder="Last Name"><br>
                  <input type='hidden' id='session' name='session' value=''>
                  <input type="submit" class="btn btn-custom bg-orange text-dark my-2">
              </div>
            </form>
            <form method="post" action="index.php?action=catalog"> 
              <div>
                  <label>Search by Title:</label><br>
                  <input class="rounded p-1" type="text" name="title" id="title" placeholder="Title">
                  <input type='hidden' id='session' name='session' value=''>
                  <input type="submit" class="btn btn-custom bg-orange text-dark my-2">
              </div>
            </form>
          </div>
          <div>
            <a href="index.php?action=add-book">Add Title</a>
            <a href="index.php?action=remove-book">Remove Title</a>
          </div>
          <div>
            <table class="table table-dark table-striped text-light">
                <thead>
                  <tr>
                    <th class="pl-1">Book Title</th>
                    <th class="pl-5">Author</th>
                  </tr>
                </thead>
                <tbody>
                  <?php echo $catalogTable; ?>
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>