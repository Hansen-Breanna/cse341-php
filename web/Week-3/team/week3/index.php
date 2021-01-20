<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Week 3 Team Activity</title>
  <link rel="stylesheet" href="../../../css/style.css" />
</head>

<body class="bg-secondary text-light">
  <form action="form.php" method="POST">    
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
    <label for="continents[]">Which continents have you visited?</label>
    <input type="checkbox" id="nAmerica" name="continents[]" value="na">
    <label for="nAmerica">North America</label><br>
    <input type="checkbox" id="sAmerica" name="continents[]" value="sa">
    <label for="sAmerica">South America</label><br>
    <input type="checkbox" id="europe" name="continents[]" value="e">
    <label for="europe">Europe</label><br>
    <input type="checkbox" id="asia" name="continents[]" value="as">
    <label for="asia">Asia</label><br>
    <input type="checkbox" id="australia" name="continents[]" value="au">
    <label for="australia">Australia</label><br>
    <input type="checkbox" id="africa" name="continents[]" value="af">
    <label for="africa">Africa</label><br>
    <input type="checkbox" id="antarctica" name="continents[]" value="an">
    <label for="antarctica">Antarctica</label><br><br><br>
</div>    

    <input type="submit">
  </form>
</body>

</html>