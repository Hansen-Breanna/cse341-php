<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Week 3 Team Activity</title>
  <link href="../../../css/style.css" rel="stylesheet">
</head>

<body>

<?php
// define variables and set to empty values
$name = $email = $major = $comment = $continents[] = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $major = test_input($_POST["major"]);
  $comment = test_input($_POST["comment"]);
  $continents[] = $_POST["continents"];
  echo "here is my post";
  echo $_POST;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<?php echo var_dump($_POST);  var_dump($continents[0]);?>
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
        
      foreach($key as $continents[]) { 
        echo "<li class='bullets'>" . $abr[$key] ."</li>";
      } 
      echo "</ul>"; ?>
  </div>
</body>

</html>