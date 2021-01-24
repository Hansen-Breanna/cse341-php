<?php
// start session
session_start ();

while(!feof($myfile)) { 
    $file = fgets($myfile);
    // split url and price
    $details = explode(" ", $file);
    $idArray[] = $details[2];
    echo($details[2]);
}
fclose($myfile);

// define variables and set to empty values
$productName = $imageUrl = $price = $id = "";
$idArray = array();
 
if ($_SERVER["REQUEST_METHOD"] == "GET" && (!isset($_SESSION))) {
    $_SESSION["cart"] = array();   
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = test_input($_POST["productName"]);
    $imageUrl = test_input($_POST["imageUrl"]);
    $price = test_input($_POST["price"]);
    $id = test_input($_POST["id"]);

    $products = idArray();
    var_dump($products);

//     $products = array("AZ"=>array("Aztec-Spicy-Hot-Chocolate.jpg", "Aztec Spicy Hot Chocolate", "$13.00", 0),
//     "SA"=>array("Hot-Chocolate-Sampler.jpg", "Hot Chocolate Sampler", "$34.00", 0), 
//     "MA"=>array("Marshmallow-Hot-Chocolate.jpg", "Marshmallow Hot Chocolate", "$13.00", 0), 
//     "MO"=>array("Mocha-Hot-Chocolate.jpg", "Mocha Hot Chocolate", "$13.00", 0),
//     "TR"=>array("Traditional-Hot-Chocolate.jpg", "Traditional Hot Chocolate", "$13.00", 0),
//     "UN"=>array("Unsweetended-Cocoa.jpg", "Unsweetended Cocoa", "$13.00", 0));
                    
// foreach ($products as $key => $value) {
//     if ($id == $key) {
//         if (!isset($_SESSION['cart'][$key])) {
//             $value[3] = 1;
//             $_SESSION['cart'][$key] = [array($value[1], $value[0], $value[2], $value[3])];
//         } else {
//             $count = $_SESSION['cart'][$key][0][3]++;
//             ++$count;
//             $_SESSION['cart'][$key] = [array($value[1], $value[0], $value[2], $count)];
//         }
//     }
// }

    // $products = array("AZ"=>array("Aztec-Spicy-Hot-Chocolate.jpg", "Aztec Spicy Hot Chocolate", "$13.00", 0),
    //     "SA"=>array("Hot-Chocolate-Sampler.jpg", "Hot Chocolate Sampler", "$34.00", 0), 
    //     "MA"=>array("Marshmallow-Hot-Chocolate.jpg", "Marshmallow Hot Chocolate", "$13.00", 0), 
    //     "MO"=>array("Mocha-Hot-Chocolate.jpg", "Mocha Hot Chocolate", "$13.00", 0),
    //     "TR"=>array("Traditional-Hot-Chocolate.jpg", "Traditional Hot Chocolate", "$13.00", 0),
    //     "UN"=>array("Unsweetended-Cocoa.jpg", "Unsweetended Cocoa", "$13.00", 0));
                        
    // foreach ($products as $key => $value) {
    //     if ($id == $key) {
    //         if (!isset($_SESSION['cart'][$key])) {
    //             $value[3] = 1;
    //             $_SESSION['cart'][$key] = [array($value[1], $value[0], $value[2], $value[3])];
    //         } else {
    //             $count = $_SESSION['cart'][$key][0][3]++;
    //             ++$count;
    //             $_SESSION['cart'][$key] = [array($value[1], $value[0], $value[2], $count)];
    //         }
    //     }
    // }
}

function idArray() {
    $myfile = fopen("images/images.txt", "r") or die("Unable to open file!");
    // Output one line until end-of-file
    while(!feof($myfile)) { 
        $file = fgets($myfile);
        // split url and price
        $details = explode(" ", $file);
        $idArray[] = $details[2];
        echo($details[2]);
    }
    fclose($myfile);
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