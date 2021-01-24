<?php 
// start session
session_start ();
$name = $street = $city = $state = $zip = $email = "";
$session = array();

//var_dump($_SESSION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $street = test_input($_POST["street"]);
    $city = test_input($_POST["city"]);
    $state = test_input($_POST["state"]);
    $zip = test_input($_POST["zip"]);
    $email = test_input($_POST["email"]);
    $session = test_input($_POST["session"]);
    var_dump($session);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<!-- Head -->
<?php include 'common/head.php'; ?>

    <title>03 Prove: Confirmation</title>

<!-- Nav -->
<?php include 'common/nav.php'; ?>

<!-- Header -->
<?php include '../../common/header.php'; ?>

              <h1 class="offset-1 col-10 offset-md-0 col-md-12 text-dark">Order Confirmation</h1>
          </div>
      </div>
    </header>
    
    <main class="mb-5 text-dark offset-1 col-10 offset-md-0 col-md-12">
      <div class="container">
        <div class="row d-flex flex-column">
            <p>Thank you. Your order has been received.</p>
            <div class="row d-md-flex">
                <div class="bg-secondary">
                    <h3>Shipping Details</h3>
                    <ul class="list-group">
                        <li class="list-group-item border-none p-1"><?php echo($name); ?></li>
                        <li class="list-group-item border-none p-1"><?php echo($street); ?></li>
                        <li class="list-group-item border-none p-1"><?php echo($city) . ", " . ($state) . " " . ($zip); ?></li>
                        <li class="list-group-item border-none p-1"><?php echo($email); ?></li>
                    </ul>
                </div>
                <div>
                    <?php
                        foreach ($session as $product) {

                        }
                    ?>
                </div>
            </div>
        </div>
      </div>
    </main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>