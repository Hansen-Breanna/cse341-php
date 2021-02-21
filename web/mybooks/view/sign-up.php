<?php

session_start();

$first_name = $last_name = $username = $password = $confirm_password = $email = $phone = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = test_input($_POST['first_name']);
    $last_name = test_input($_POST['last_name']);
    $email = test_input($_POST['email']);
    $phone = test_input($_POST['phone']);
    $user = test_input($_POST['username']);
    $pass = test_input($_POST['password']);
    $confirm =  test_input($_POST['confirm_password']);
    $pattern = "/^(?=.*[[:digit:]])(?=.*[a-z])([^\s]){7,}$/";

    if ($pass != $confirm) {
        $message = "<p class='bg-danger py-3 px-4 rounded'>Your passwords do not match. Please try again.</p>";
        $star = "<span class='text-red'>*</span>";
    } else {
        try {
            $check = preg_match($pattern, $pass);
            if ($check == 1) {
                $passwordHash = password_hash($pass, PASSWORD_DEFAULT);
                insertUser($db, $first_name, $last_name, $user, $passwordHash, $email, $phone);
                header('Location: index.php?action=home');
            } else {
                $message = "<p class='text-red'>Please use at least 7 characters and 1 number.</p>";
            }
        } catch (Exception $e) {
        
        }
    }
}

?>

<!-- Head -->
<?php include 'common/head.php'; ?>

<title>Sign Up - My Books</title>

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
        <div class="row d-flex flex-column align-items-center">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo $message;
            }
            ?>
            <p>To sign up, password must be at least 7 characters and contain a number.</p>
            <div id="confirmed"></div>
            <form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <label for="first_name">First name:</label>
                            </td>
                            <td>
                                <input class="m-1 pl-1" type="text" id="first_name" name="first_name" placeholder="first name">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="last_name">last name:</label>
                            </td>
                            <td>
                                <input class="m-1 pl-1" type="text" id="last_name" name="last_name" placeholder="last name">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="email">Email:</label>
                            </td>
                            <td>
                                <input class="m-1 pl-1" type="email" id="email" name="email" placeholder="your@email.com">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="phone">phone number:</label><br>
                                <p>(No dashes)</p>
                            </td>
                            <td>
                                <input class="m-1 pl-1" type="text" id="phone" name="phone" placeholder="0000000000" pattern="^\d{10}$">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="username">username:</label>
                            </td>
                            <td>
                                <input class="m-1 pl-1" type="text" id="username" name="username" placeholder="username">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="password">password:</label>
                            </td>
                            <td>
                            <input class="m-1 pl-1" type='text' id="password" name="password" placeholder="password" pattern="(?=^.{7,}$)(?=.*\d)(?=.*[a-z]).*$"><?php echo $star; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="confirm_password">Confirm<br>password:</label>
                            </td>
                            <td>
                            <input class="m-1 pl-1" type='text' id="confirm_password" name="confirm_password" placeholder="confirm password" pattern="(?=^.{7,}$)(?=.*\d)(?=.*[a-z]).*$"><?php echo $star; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    <input type="submit" class="rs-size btn bg-orange m-1" value="Sign Up" onclick="confirm()">
                    <a href="index.php?action=home" title="Log In" class="rs-size btn btn-custom bg-orange m-1">Log In</a>
                </div>
            </form>
        </div>
    </div>
</main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>