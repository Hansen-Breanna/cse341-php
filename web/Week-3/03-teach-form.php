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
  <title>03 Teach: Team Activity Output</title>
</head>

<body class="bg-dark h-100 m-0">

<div class="content">
    <header class="text-light">
      <div class="container">
        <div class="row">
              <h1 class="offset-1 col-10 offset-md-0 col-md-12">03 Teach: Team Activity Output</h1>
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
                        <label>Major:</label><br>
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
                        <textarea id="comment" name="comment" rows=5 cols="40"></textarea>
                    </div>
                    <div class="continents">
                        <label>Which continents have you visited?</label><br>
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
                        <input type="submit" class="btn bg-primary text-light">
                    </div>
                </form>

            </div>
        </div>
    </main>
</div>
</body>

</html>
