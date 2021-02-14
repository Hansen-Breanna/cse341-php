<?php
// start session
session_start ();

// define variables and set to empty values
$productName = $imageUrl = $price = $id = "";
 
if ($_SERVER["REQUEST_METHOD"] == "GET" && (!isset($_SESSION))) {
    $_SESSION["id"] = array();   
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = test_input($_POST["productName"]);
    $imageUrl = test_input($_POST["imageUrl"]);
    $price = test_input($_POST["price"]);
    $id = test_input($_POST["id"]);

    $product = [];
    $myfile = fopen("images/images.txt", "r") or die("Unable to open file!");
    // Output one line until end-of-file
    while(!feof($myfile)) {
        // get line from file
        $file = fgets($myfile);
        // split url and price
        $details = explode(" ", $file);
        $productID = trim($details[2]);
        array_push($product, $productID);
    }
    fclose($myfile);
 
    $count = 0;
    foreach ($product as $key) {
        if ($id == $key) {
            if (!isset($_SESSION['cart'][$key])) {
                $count = 1;
                $_SESSION['cart'][$key] = [array($productName, $imageUrl, $price, $count)];
            } else {
                $count = $_SESSION['cart'][$key][0][3]++;
                ++$count;
                $_SESSION['cart'][$key] = [array($productName, $imageUrl, $price, $count)];
            }
        }
    }
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

    <title>03 Prove: Browse</title>

<!-- Nav -->
<?php include 'common/nav.php'; ?>

<!-- Header -->
<?php include '../../common/header.php'; ?>

              <h1 class="offset-1 col-10 offset-md-0 col-md-12 text-dark display-3">Gourmet Hot Chocolates</h1>
              <h2 class="text-dark ml-4">Browse Products</h2>
              <p id="message"></p>
          </div>
      </div>
    </header>
    
    <main class="mb-5">
      <div class="container">
        <div class="row d-md-flex justify-content-center">
            <?php
            $myfile = fopen("images/images.txt", "r") or die("Unable to open file!");
            // Output one line until end-of-file
            while(!feof($myfile)) {
                // get line from file
                $image = fgets($myfile);
                // split url and price
                $details = explode(" ", $image);
                // trim .jpg off url
                $imageTrim = trim($details[0], ".jpg");
                // get name of product
                $imageName = str_replace("-", " ", $imageTrim);
                // trim space off price
                $priceTrim = trim($details[1]);
                // place final product contents in array
                $productArray = array($details[0], $priceTrim, $imageName);

                // product display box
                echo "<div class='m-2 d-flex justify-content-end flex-column border p-2 browse-product align-items-center'>";
                echo "<h3>" . $imageName . "</h3>";
                echo "<img src='images/" . $details[0] . "' alt='" . $imageName . "' class='d-block' />";
                echo "<p class='price'>$" . $details[1] . ".00</p>";
                // product form
                echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                echo "<input type='hidden' name='imageUrl' value='" . $details[0] . "'>";
                echo "<input type='hidden' name='productName' value='" . $imageName . "'>";
                echo "<input type='hidden' name='price' value='" . $details[1] . "'>";
                echo "<input type='hidden' name='id' value='" . $details[2] . "'>";
                echo "<input type='submit' class='btn btn-lg bg-green shadow px-5' value='Add to Cart'>";
                echo "</form></div>";
            }
            fclose($myfile);
            ?>
        </div>
      </div>
    </main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>