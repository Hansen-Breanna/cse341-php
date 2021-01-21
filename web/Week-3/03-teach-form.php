<!-- Head -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/common/head.php'; ?>

    <title>03 Teach: Team Activity</title>

<!-- Nav -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/common/nav.php'; ?>

<!-- Header -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; ?>

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

            <form method="post" action="03-teach-output.php">
                <div class="name">
                    <label for="name">Name:</label> 
                    <input type="text" name="name" id="name"><br>
                </div>
                <div class="email">
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email"><br>
                </div>
                <div class="major">
                    <label for="major">Major:</label><br>
                    <?php
                    $majors = array("CS"=>"Computer Science", "WDD"=>"Web Design and Development", "CIT"=>"Computer Information Technology", "CE"=>"Computer Engineering");
                    
                    //Create major radio buttons
                    foreach ($majors as $key => $value) {
                        echo '<input type="radio" id="'.$key.'" name="major" value="'.$value.'">
                        <label for="'.$key.'">'.$value.'</label><br>';
                    }
                    ?>
                </div>
                <div class="comments">
                    <label for="comment">Comments:</label><br>
                    <textarea name="comment" rows=5 cols="40"></textarea>
                </div>
                <div class="continents">
                    <label for="continents">Which continents have you visited?</label><br>
                    <input type="checkbox" id="nAmerica" name="continents[]" value="na">
                    <label for="nAmerica">North America</label><br>
                    <input type="checkbox" id="sAmerica" name="continents[]" value="sa">
                    <label for="sAmerica">South America</label><br>
                    <input type="checkbox" id="europe" name="continents[]" value="eu">
                    <label for="europe">Europe</label><br>
                    <input type="checkbox" id="asia" name="continents[]" value="as">
                    <label for="asia">Asia</label><br>
                    <input type="checkbox" id="australia" name="continents[]" value="au">
                    <label for="australia">Australia</label><br>
                    <input type="checkbox" id="africa" name="continents[]" value="af">
                    <label for="africa">Africa</label><br>
                    <input type="checkbox" id="antarctica" name="continents[]" value="an">
                    <label for="antarctica">Antarctica</label><br>
                </div>    
                <div class="submit">
                    <input type="submit" class="btn bg-primary">
                </div>
            </form>

            </div>
        </div>
    </main>

<!-- Footer -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>