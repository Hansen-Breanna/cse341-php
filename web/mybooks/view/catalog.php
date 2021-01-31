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
              <div class="name">
                  <label>Search by Author:</label><br>
                  <input class="rounded" type="text" name="first-name" id="first-name" placeholder="First Name">
                  <input class="rounded" type="text" name="last-name" id="last-name" placeholder="Last Name"><br>
              </div>
              <div class="submit">
                  <input type='hidden' id='session' name='session' value=''>
                  <input type="submit" class="btn btn-custom bg-green text-dark my-2">
              </div>
            </form>
            <form>
            
            </form>
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