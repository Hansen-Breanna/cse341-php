<!-- Head -->
<?php include 'common/head.php'; ?>

    <title>My Books - Personal Library Application</title>

<!-- Nav -->
<?php include 'common/nav.php'; ?>

<!-- Header -->
<?php include '../common/header.php'; ?>

              <h1 class="offset-1 col-10 offset-md-0 col-md-12">My Wish List</h1>
          </div>
      </div>
    </header>
    
    <main class="mb-5">
      <div class="container">
        <div class="row d-md-flex">
        <table>
              <thead>
                <tr>
                  <th class="pl-1">Book Title</th>
                  <th class="pl-5">Author</th>
                  <th class="pl-5">With to Read</th>
                  <th class="pl-5">Wish to Own</th>
                </tr>
              </thead>
              <tbody>
                <?php echo $wishesTable; ?>
              </tbody>
            </table>
        </div>
      </div>
    </main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>