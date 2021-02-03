<?php
// start session
session_start ();

// define variables and set to empty values
$username = $password = "";
 
if ($_SERVER["REQUEST_METHOD"] == "GET" && (!isset($_SESSION))) { 

} 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $_SESSION['id'] = getUserID($username, $password);
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

    <title>Home - My Books</title>

<!-- Nav -->
<?php include 'common/nav.php'; ?>

<!-- Header -->
<?php include '../common/header.php'; ?>

              <h1 class="offset-1 col-10 offset-md-0 col-md-12">My Books</h1>
          </div>
      </div>
    </header>
    
    <main class="mb-5">
      <div class="container">
        <div class="row d-flex justify-content-around">
            <div id="logout" class="bg-success">You have successfully logged out.</a>
        </div>
        <div class="row d-flex justify-content-around">
            <div id="box-1" class="main-box p-5 w-25 mt-4 mx-2">
                <form method='post' action=" <?php htmlspecialchars($_SERVER["PHP_SELF"]) ?> ">
                    <input class="rs-size rounded border-light m-1 pl-1" type="text" id="username" name="username" placeholder="username"><br>
                    <input class="rs-size rounded border-light m-1 pl-1" type='text' id="password" name="password" placeholder="password"><br>
                    <input type="submit" class="rs-size btn btn-custom bg-orange m-1" value="Log In">
                </form>
            </div>
            <div id="box-1" class="main-box bg-danger shadow-lg rounded box p-5 w-25 mt-4 mx-2">
                <h2 class="text-center p-3"><a href="index.php?action=catalog" title="Catalog">Catalog</a></h2>
            </div>
            <div id="box-2" class="main-box bg-info shadow-lg rounded box p-5 w-25 mt-4 mx-2">
                <h2 class="text-center p-3"><a href="index.php?action=wish" title="Book Wish List">Wish List</a></h2>
            </div>
            <div id="box-3" class="main-box bg-success shadow-lg rounded box p-5 w-25 mt-4 mx-2">
                <h2 class="text-center p-3"><a href="index.php?action=authors" title="Authors">Authors</a></h2>
            </div>
            <div id="box-2" class="main-box bg-orange shadow-lg rounded box p-5 w-25 mt-4 mx-2">
                <h2 class="text-center p-3"><a href="index.php?action=loans" title="Loans">Loans</a></h2>
            </div>
            <div id="box-3" class="main-box bg-warning shadow-lg rounded box p-5 w-25 mt-4 mx-2">
                <h2 class="text-center p-3"><a href="index.php?action=reviews" title="Book Reviews">Reviews</a></h2>
            </div>
        </div>
      </div>
    </main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>