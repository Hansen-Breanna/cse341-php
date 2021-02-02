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
        <div class="row d-flex flex-column align-items-center">
          <div>
            <!-- Search Boxes -->
            <?php include 'common/search.php'; ?>
          </div>
          <form class="d-flex row-wrap" method="post" action="index.php">
                    <input class="rounded border-light m-1" type="text" name="username" placeholder="username">
                    <input class="rounded border-light m-1" type='text' name="password" placeholder="password">
                    <input type="submit" class="btn btn-custom bg-orange m-1" value="Log In">
                </form>
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