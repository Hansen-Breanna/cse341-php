<?php 
// start session
session_start ();
$name = $street = $city = $state = $zip = $email = "";
$session = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $street = test_input($_POST["street"]);
    $city = test_input($_POST["city"]);
    $state = test_input($_POST["state"]);
    $zip = test_input($_POST["zip"]);
    $email = test_input($_POST["email"]);
    $session = test_input($_POST["session"]);
} 

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function quantityCost($cost, $quantity) {
    $price = trim($cost, "$");
    $trimPrice = trim($price, ".00");
    $quantityTotal = $quantity * $trimPrice;
    return $quantityTotal;
}

function subtotal() {
    $subtotal = 0;
    $totalCount = 0;
    foreach ($_SESSION as $cost) {
        foreach ($cost as $key => $value) {
            // cost
            $price = trim($cost[$key][0][2], "$");
            $productCost = $price * $cost[$key][0][3];
            $subtotal = $subtotal + $productCost;
        }
        echo($subtotal);
    }
}

?>
<!-- Head -->
<?php include 'common/head.php'; ?>

    <title>03 Prove: Confirmation</title>

<!-- Nav -->
<?php include 'common/nav.php'; ?>

<!-- Header -->
<?php include '../../common/header.php'; ?>

            <h1 class="offset-1 col-10 offset-md-0 col-md-12 text-dark display-3">Gourmet Hot Chocolates</h1>
            <h2 class="text-dark ml-4">Order Confirmation</h2>
          </div>
      </div>
    </header>
    
    <main class="mb-5 text-dark offset-1 col-10 offset-md-0 col-md-12">
      <div class="container">
        <div class="row d-flex flex-column">
            <p>Thank you. Your order has been received.</p>
            <div class="row d-md-flex mt-5">
                <div class="mr-5 pr-5">
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
                    if (!isset($_SESSION)) {
                        echo("<h3>Your have reached this page in error. Browse to start shopping!<a href='browse.php' class='btn bg-green shadow'>Browse our Products</a>");
                    } else {
                        $products = array();
                        // product form
                        echo "<div class='item-checkout'>";
                        echo "<table><tbody>";
                        foreach ($_SESSION as $cart) {
                            foreach ($cart as $key => $value) {
                                $id = $key;
                                if (isset($cart[$key])) {
                                // product display box
                                    echo "<tr><td class='item-quantity pr-5 pb-3 border-bottom'><img class ='mr-5 w-25' src='images/"  . $cart[$key][0][1] . "' ";
                                    echo "alt='" . $cart[$key][0][0] . "' />" . $cart[$key][0][0] . " x " . $cart[$key][0][3] . "</td>";
                                    echo "<td class='border-bottom text-right pb-3'>$" . quantityCost($cart[$key][0][2], $cart[$key][0][3]) . ".00</td></tr>";
                                }
                            }
                        }
                        echo "</tbody></table></div>";   
                    }
                ?>
                    <h3 class="mt-2 text-right">Total: $<?php subtotal() ?>.00</h3>

                <?php session_destroy(); ?>
                </div>
            </div>
        </div>
      </div>
    </main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>