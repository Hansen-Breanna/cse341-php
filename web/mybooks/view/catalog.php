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
            <?php
              echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                echo '<div class="input-group">';
                  echo '<div class="input-group-prepend">';
                    echo '<span class="input-group-text" id="">First and last name</span>';
                  echo '</div>';
                  echo '<input type="text" class="form-control input-group-text">';
                  echo '<input type="text" class="form-control">';
                  echo '<div class="input-group-append">';
                    echo '<label class="input-group-text" for="inputGroupSelect02">Options</label>';
                  echo '</div>';
              echo "<input type='submit' class='btn btn-lg bg-green shadow px-5' value='Search Authors'>";
              echo '</div>';
              echo "</form>";
            ?>

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