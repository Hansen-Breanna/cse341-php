<?php
// start session
session_start ();

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

    <title>03 Prove: Checkout</title>

<!-- Nav -->
<?php include 'common/nav.php'; ?>

<!-- Header -->
<?php include '../../common/header.php'; ?>

            <h1 class="offset-1 col-10 offset-md-0 col-md-12 text-dark display-3">Gourmet Hot Chocolates</h1>
            <h2 class="text-dark ml-4">Checkout</h2>
          </div>
      </div>
    </header>
    
    <main class="mb-5 offset-1 col-10 d-flex">
      <div class="container ml-3">
        <div class="row">
            <div>
                <?php 
                    if (!isset($_SESSION)) {
                        echo("<h3>Your cart is currently empty.</h3><a href='browse.php' class='btn bg-green shadow'>Browse our Products</a>");
                    } else {
                        $products = array();
                        // product form
                        echo "<a href='view-cart.php' class='btn btn-lg bg-green mb-3'>Return to Cart</a>";
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
            </div>
            <div class="w-100 w-lg-50 mt-3">
                <form method="post" class="checkout-form" action="confirmation.php">
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