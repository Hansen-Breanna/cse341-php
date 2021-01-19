<!-- Head -->
<?php include '../common/head.php'; ?>

    <title>02 Teach: Team Activity</title>

<!-- Nav -->
<?php include '../common/nav.php'; ?>

<!-- Header -->
<?php include '../common/header.php'; ?>

              <h1 class="offset-1 col-10 offset-md-0 col-md-12">Breanna Hansen</h1>
          </div>
      </div>
    </header>
    
    <main class="mb-5  text-light">
      <div class="container">
        <div class="row d-md-flex">
            Name: <?php echo $_POST["name"]; ?><br>
            Email: <a href="mailto:<?php echo $_POST["email"]; ?>"><?php echo $_POST["email"]; ?></a><br>
            Major: <?php echo $_POST["major"]; ?><br>
            Comments: <?php echo $_POST["comments"]; ?><br>
            Continents: <?php echo $_POST["continents"]; ?><br>
        </div>
      </div>
    </main>

<!-- Footer -->
<?php include '../common/footer.php'; ?>