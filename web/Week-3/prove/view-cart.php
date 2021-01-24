<?php
// start session
session_start ();

// define variables and set to empty values
$id = $total = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = test_input($_POST["id"]);

    if ($_SESSION['cart'][$id][0][3] != 0) {
        $count = --$_SESSION['cart'][$id][0][3];
        if ($count == 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id][3] = $count;
        }
    } else {
        unset($_SESSION['cart'][$id]);
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
        return $subtotal;
    }
}

function countProducts() {
    $totalCount = 0;
    foreach ($_SESSION as $cost) {
        foreach ($cost as $key => $value) {
            // count
            $productCount = $cost[$key][0][3];
            $totalCount = $productCount + $totalCount;
        }
        if ($totalCount > 1) {
            echo($totalCount . " items");
        } else {
            echo($totalCount . " item");
        }
    } 
}

?>

<!-- Head -->
<?php include 'common/head.php'; ?>

    <title>03 Prove: View Cart</title>

<!-- Nav -->
<?php include 'common/nav.php'; ?>

<!-- Header -->
<?php include '../../common/header.php'; ?>

            <h1 class="offset-1 col-10 offset-md-0 col-md-12 text-dark display-3">Gourmet Hot Chocolates</h1>
            <h2 class="text-dark ml-4">View Cart</h2>
          </div>
      </div>
    </header>
    
    <main class="mb-5 text-dark">
      <div class="container">
        <div class="row d-md-flex justify-content-center">
            <div>
                
            </div>
            <?php 
            $products = array();
            foreach ($_SESSION as $cart) {
                foreach ($cart as $key => $value) {
                    $id = $key;
                    if (isset($cart[$key])) {
                    // product display box
                    echo "<div class='m-2 d-flex justify-content-end flex-column border p-2 browse-product align-items-center'>";
                    echo "<h3>" . $cart[$key][0][0] . "</h3>";
                    echo "<img src='images/" . $cart[$key][0][1] . "' alt='" . $cart[$key][0][0] . "' class='d-block' />";
                    echo "<p class='price'>" . $cart[$key][0][2] . "</p>";
                    // product form
                    echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                    echo "<input type='hidden' name='id' value='" . $id . "'>";
                    echo '<div class="input-group mb-3">';
                       echo '<div class="input-group-prepend">';
                           echo '<span class="input-group-text">quantity</span>';
                       echo '</div>';
                       echo '<input type="text" class="form-control text-center" placeholder="' . $cart[$key][0][3] . '">';
                    echo '</div>';
                    echo "<input type='submit' class='btn btn-block bg-green shadow' value='Remove'>";
                    echo "</form></div>";
                    } 
                }
            } ?>

            <div id="subtotal" class='m-2 d-flex justify-content-start flex-column p-2 browse-product align-items-start'>
                <h3>Total</h3>
                <div>
                    <p class="p-0 m-0"><?php countProducts(); ?></p>
                    <p class="p-0 m-0 price">$<?php echo(subtotal()); ?>.00</p>
                </div>
                <form method='post' action='checkout.php'>
                    <input type='submit' class='btn btn-block bg-green shadow px-3' value='Checkout'>
                </form>
            </div>
        </div>
      </div>
    </main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>