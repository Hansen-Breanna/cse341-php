<?php
// start session
session_start();

$first_name = $middle_name = $last_name =  $title = "";
$favorite = $blacklist = $own = $own_wish = $read_wish = FALSE;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = test_input($_POST["first_name"]);
    $middle_name = test_input($_POST["middle_name"]);
    $last_name = test_input($_POST["last_name"]);
    $favorite = test_input($_POST["favorite"]);
    $blacklist = test_input($_POST["blacklist"]);
    $title = test_input($_POST["title"]);
    $own = test_input($_POST["own"]);
    $own_wish = test_input($_POST["own_wish"]);
    $read_wish = test_input($_POST["read_wish"]);
    $_SESSION['title'] = $title;
    //echo "$first_name $middle_name $last_name $favorite $blacklist $title $own $own_wish $read_wish";

    //author
    insertAuthor($db, $first_name, $middle_name, $last_name);
    $newAuthorID = $db->lastInsertId('author_id_seq');

    //user_author
    //insertUserAuthor($db, $_SESSION['id'], $newAuthorID, $blacklist, $favorite);

    //book
    insertTitle($db, $newAuthorID, $title);
    $newTitleID = $db->lastInsertId('book_title_id_seq');

    // //user-book
    insertUserBook($db, $_SESSION['id'], $newTitleID, $own, $own_wish, $read_wish);
}

?>

<!-- Head -->
<?php include 'common/head.php'; ?>

<title>Catalog - My Books</title>

<!-- Nav -->
<?php include 'common/nav.php'; ?>

<!-- Header -->
<?php include '../common/header.php'; ?>

<h1 class="offset-1 col-10 offset-md-0 col-md-12">Book Catalog</h1>
</div>
</div>
</header>

<main class="mb-5">
    <div class="container">
        <div class="row d-flex flex-column align-items-center">
            <div>
                <a href="index.php?action=catalog" title="See All Titles" class="btn btn-custom bg-info my-2 ml-1">See All Titles</a>
            </div>
            <div>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo $message;
                }
                ?>

                <form method="post" action="">
                    <div>
                        <!-- Author -->
                        <h2 class="author-name mt-2">Author</h2>
                        <table>
                            <tbody>
                                <tr>
                                    <td><label for="first-name">First name:</label></td>
                                    <td><input type="text" class="rounded mb-1" name="first_name" id="first-name"></td>
                                </tr>
                                <tr>
                                    <td><label for="chapter">Middle Name:</label></td>
                                    <td><input type="text" class="rounded mb-1" name="middle_name" id="middle-name"></td>
                                </tr>
                                <tr>
                                    <td><label for="verse">Last name:</label></td>
                                    <td><input type="text" class="rounded mb-1" name="last_name" id="last-name"><br></td>
                                </tr>
                                <tr>
                                    <td><span class="d-flex align-items-center"><input type="checkbox" class="rounded mr-1" id="favorite" name="favorite" value="TRUE">Favorite</span></td>
                                    <td><span class="d-flex align-items-center"><input type="checkbox" class="rounded mr-1" id="blacklist" name="blacklist" value="TRUE">Blacklist</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Title -->
                    <div class="book-title">
                        <h2 class="mt-2">Title</h2>
                        <div class="title">
                            <label>Book title:</label>
                            <input type="text" class="rounded" id="title" name="title">
                        </div>
                        <div class="user-title">
                            <span class="d-flex align-items-center"><input type="checkbox" class="rounded mr-1" id="own" name="own" value="TRUE">Currently Own</span>
                            <span class="d-flex align-items-center"><input type="checkbox" class="rounded mr-1" id="ownWish" name="own_wish" value="TRUE">Own Wish List</span>
                            <span class="d-flex align-items-center"><input type="checkbox" class="rounded mr-1" id="readWish" name="read_wish" value="TRUE">Read Wish List</span>
                        </div>
                    </div>
                    <div class="submit">
                        <input type="submit">
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>