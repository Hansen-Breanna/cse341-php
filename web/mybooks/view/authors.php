<!-- Head -->
<?php include 'common/head.php'; ?>

    <title>My Books - Personal Library Application</title>

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
        <div class="row d-md-flex justify-content-center">
          <!-- Search Boxes -->
          <?php include 'common/search.php'; ?>

          <table class="table table-dark table-striped text-light">
              <thead>
                <tr>
                  <th class="pl-5">Author</th>
                </tr>
              </thead>
              <tbody>
                <?php //echo $authorsTable; ?>
              </tbody>
            </table>
        </div>
      </div>
    </main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>