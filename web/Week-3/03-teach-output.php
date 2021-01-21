<!DOCTYPE html>
<html lang="en" class="h-100 m-0">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- <script src="../bootstrap/dist/js/bootstrap.bundle.min.js"></script> -->
  <script src="../js/scripts.js"></script>
  <title>03 Teach: Team Activity</title>
</head>

<body class="bg-dark h-100 m-0">

  <?php
  // define variables and set to empty values
  $name = $email = $major = $comment = $continents[] = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $major = test_input($_POST["major"]);
    $comment = test_input($_POST["comment"]);
    $continents[] = test_input($_POST["continents"]);
  }

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>

  <div class="content">
    <header class="text-light">
      <div class="container">
        <div class="row">
          <h1 class="offset-1 col-10 offset-md-0 col-md-12">O3 Teach: Team Activity Output</h1>
        </div>
      </div>
    </header>

    <main class="mb-5 text-light">
      <div class="container">
        <div class="row d-flex flex-column">
          <div>
            <label>Name:</label> <?php echo $_POST["name"]; ?><br>
          </div>
          <div>
            <label>Email:</label> <a href="mailto:<?php echo $_POST["email"]; ?>"><?php echo $_POST["email"]; ?></a><br>
          </div>
          <div>
            <label>Major:</label> <?php echo $_POST["major"]; ?><br>
          </div>
          <div>
            <label>Comments:</label> <?php echo $_POST["comment"]; ?><br>
          </div>
          <div>
            <label>Continents visited:</label><br>
            <?php
            echo "<ul>";
            $abr = array("na" => "North America", "sa" => "South America", "eu" => "Europe", "as" => "Asia", "au" => "Australia", "af" => "Africa", "an" => "Antarctica");

            foreach ($_POST["continents"] as $selected) {
              echo "<li class='bullets'>" . $abr[$selected] . "</li>";
            }
            echo "</ul>"; ?>
          </div>
        </div>
      </div>
    </main>
  </div>
</body>

</html>