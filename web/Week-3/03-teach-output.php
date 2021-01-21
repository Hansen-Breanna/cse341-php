<!-- Head -->
<?php include '../common/head.php'; ?>

    <title>03 Teach: Team Activity</title>

<!-- Nav -->
<?php include '../common/nav.php'; ?>

<!-- Header -->
<?php include '../common/header.php'; ?>

              <h1 class="offset-1 col-10 offset-md-0 col-md-12">O3 Teach: Team Activity Output</h1>
          </div>
      </div>
    </header>
    
    <main class="mb-5  text-light">
      <div class="container">
        <div class="row">
          <div>
            <label>Name: </label> <?php echo $_POST["name"]; ?>
          </div>
          <div>
            <label>Email: </label><a href="mailto:<?php echo $_POST["email"]; ?>"><?php echo$_POST["email"]; ?></a>
          </div>
          <div>
            <label>Major: </label><?php echo $_POST["major"]; ?>
          </div>
          <div> 
            <label>Comments: </label><?php echo $_POST["comment"]; ?>
          </div>
          <div>
            <label>Continents visited: </label><br>
            <?php 
              echo "<ul>"; 
              $abr = array("na"=>"North America", "sa"=>"South America", "eu"=>"Europe", "as"=>"Asia", "au"=>"Australia", "af"=>"Africa", "an"=>"Antarctica");
                
              foreach($_POST["continents"] as $selected) { 
                echo "<li class='bullets'>" . $abr[$selected] ."</li>";
              } 
              echo "</ul>"; ?>
          </div>
        </div>
      </div>
    </main>

<!-- Footer -->
<?php include '../common/footer.php'; ?>