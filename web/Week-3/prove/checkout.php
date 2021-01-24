<?php
// start session
session_start ();
$total = "";
//$total = test_input($_POST["total"]); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {   
    $total = test_input($_POST["total"]); 
    echo($total);
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
    echo($quantityTotal);
}
?>

<!-- Head -->
<?php include 'common/head.php'; ?>

    <title>03 Prove: Checkout</title>

<!-- Nav -->
<?php include 'common/nav.php'; ?>

<!-- Header -->
<?php include '../../common/header.php'; ?>

              <h1 class="offset-1 col-10 offset-md-0 col-md-12 color-brown">Checkout</h1>
          </div>
      </div>
    </header>
    
    <main class="mb-5 offset-1 col-10 d-flex">
      <div class="container ml-3">
        <div class="row">
            <div class="cart-total w-lg-50">
                <?php 
                    if (!isset($_SESSION)) {
                        echo("<h3>Your cart is currently empty.</h3><a href='browse.php' class='btn bg-green shadow'>Browse our Products</a>");
                    } else {
                        $products = array();
                        // product form
                        echo "<a href='view-cart.php' class='btn btn-lg bg-green mb-3'>Return to Cart</a>";
                        foreach ($_SESSION as $cart) {
                            foreach ($cart as $key => $value) {
                                $id = $key;
                                if (isset($cart[$key])) {
                                // product display box
                                echo "<div class='mx-2 d-flex px-2 align-items-start item-checkout'>";
                                    echo "<table><tbody><tr><td class='item-quantity pr-5 pb-3 border-bottom'>" . $cart[$key][0][0] . " x " . $cart[$key][0][3] . "</td>";
                                    echo "<td class='border-bottom  pb-3'>" . quantityCost($cart[$key][0][2], $cart[$key][0][3]) . "</td></tr></tbody></table>";
                                echo "</div>";
                                }
                            }
                        }   
                    }
                ?>
                <h3 class="mt-2 text-right">Total: $<?php echo($total) ?>.00</h3>
            </div>
            <div class="w-100 w-lg-50 mt-3">
                <form method="post" action="confirmation.php">
                    <div class="name">
                        <label for="name">Name:</label> 
                        <input class="w-75" type="text" name="name" id="name"><br>
                    </div>
                    <div class="email">
                        <label for="email">Street:</label>
                        <input class="w-75" type="text" name="street" id="street"><br>
                    </div>
                    <div class="email">
                        <label for="email">City:</label>
                        <input class="w-75" type="text" name="city" id="city"><br>
                    </div>
                    <div class="state">
                        <label for="state">State:</label>
                        <input class="w-75" type="text" name="state" id="state" placeholder="ID"><br>
                    </div>
                    <div class="zip">
                        <label for="zip">Zip:</label>
                        <input class="w-75" type="number" name="zip" id="zip"><br>
                    </div>
                    <div class="email">
                        <label for="email">Email:</label>
                        <input class="w-75" type="email" name="email" id="email"><br>
                    </div>
                    <div class="submit">
                        <input type='hidden' id='session' name='session' value='<?php var_dump($_SESSION); ?>'>
                        <input type="submit" class="btn btn-custom bg-green text-dark my-2">
                    </div>
                </form>
            </div>
        </div>
      </div>
    </main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>