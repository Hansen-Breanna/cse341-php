<!-- Head -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '../common/head.php'; ?>

    <title>03 Teach: Team Activity</title>

<!-- Nav -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '../common/nav.php'; ?>

<!-- Header -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '../common/header.php'; ?>

<?php
// define variables and set to empty values
$name = $email = $major = $comment = $continents = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $major = test_input($_POST["major"]);
  $comment = test_input($_POST["comment"]);
  $continents = test_input($_POST["continents"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

              <h1 class="offset-1 col-10 offset-md-0 col-md-12">03 Teach: Team Activity</h1>
          </div>
      </div>
    </header>
    
    <main class="mb-5 text-light">
      <div class="container">
            <div class="row d-md-flex">

            <form method="post" action="03-teach-display.php">
                <div class="name my-2">
                    <label for="name">Name:</label> 
                    <input type="text" name="name"><br>
                </div>
                <div class="email my-2">
                    <label for="email">Email:</label>
                    <input type="text" name="email"><br>
                </div>
                <div class="major my-2">
                    <label for="major">Major:</label><br>
                    <input type="radio" name="major" value="Computer Science">Computer Science<br>
                    <input type="radio" name="major" value="Web Design & Development">Web Design & Development<br>
                    <input type="radio" name="major" value="Computer Information Technology">Computer Information Technology<br>
                    <input type="radio" name="major" value="Computer Engineering">Computer Engineering<br>
                </div>
                <div class="comments my-2">
                    <label for="comment">Comments:</label><br>
                    <textarea name="comment" rows=5 cols="40"></textarea>
                </div>
                <div class="continents my-2">
                    <label for="continents">Continents visited:<br>
                        <input type="checkbox" id="na" name="North America" value="North America">
                        <label for="North America">North America</label><br>
                        <input type="checkbox" id="sa" name="South America" value="South America">
                        <label for="South America">South America</label><br>
                        <input type="checkbox" id="eu" name="Europe" value="Europe">
                        <label for="Europe">Europe</label><br>
                        <input type="checkbox" id="as" name="Asia" value="Asia">
                        <label for="Asia">Asia</label><br>
                        <input type="checkbox" id="au" name="Australia" value="Australia">
                        <label for="Australia">Australia</label><br>
                        <input type="checkbox" id="af" name="Africa" value="Africa">
                        <label for="Africa">Africa</label><br>
                        <input type="checkbox" id="an" name="Antartica" value="Antartica">
                        <label for="Antartica">Antartica</label><br>
                </div>
                <?php
                    $continents = fopen("continents.txt", "r") or die("Unable to open file!");
                    echo fgets($continents);
                    fclose($myfile);
                ?>
                <div class="submit">
                    <input type="submit">
                </div>
            </form>

            </div>
        </div>
    </main>

<!-- Footer -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '../common/footer.php'; ?>