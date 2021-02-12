<?php
// start session
session_start();

$first_name = $middle_name = $last_name = $phone = $titleID = $borrowerID = $dateBorrowed = $returnDate = $isReturned = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = test_input($_POST['first_name']);
    $middle_name = test_input($_POST['middle_name']);
    $last_name = test_input($_POST['last_name']);
    $phone = test_input($_POST['phone']);
    $titleID = test_input($_POST['titleID']);
    $borrowerID = test_input($_POST['borrowerID']);
    $dateBorrowed = test_input($_POST['dateBorrowed']);
    $returnDate = test_input($_POST['returnDate']);
    $isReturned = test_input($_POST['isReturned']);

    try {
        if (!isset($_POST['borrowerID'])) {
            //author
            insertBorrower($db, $first_name, $middle_name, $last_name, $phone);
            $newBorrowerID = $db->lastInsertId('borrower_id_seq');
            echo $newBorrowerID . $first_name;
        } else {
            $newBorrowerID = $borrowerID;
            echo $newBorrowerID;
        }

        if (isset($_POST['isReturned'])) {
            $isReturned = "TRUE";
        } else {
            $isReturned = "FALSE";
        }
        $returned = removeQuotes($isReturned);

        insertLoan($_SESSION['id'], $titleID, $newBorrowerID, $dateBorrowed, $returnDate, $returned);

    } catch (Exception $e) {
        echo $e;
    }
}

?>

<!-- Head -->
<?php include 'common/head.php'; ?>

<title>Add Loan - My Books</title>

<!-- Nav -->
<?php include 'common/nav.php'; ?>

<!-- Header -->
<?php include '../common/header.php'; ?>

<h1 class="offset-1 col-10 offset-md-0 col-md-12">Add Loan</h1>
</div>
</div>
</header>

<main class="mb-5">
    <div class="container">
        <div class="row d-flex flex-column align-items-center">
            <div>
                <!-- Search Title -->
                <form method="post" action="index.php?action=loans-title">
                    <?php include 'common/title.php'; ?>

                    <!-- Search Borrowers -->
                    <form method="post" action="index.php?action=loans-borrower">
                        <?php include 'common/borrower.php'; ?>

                        <div class="my-3 mx-2 py-2 border-secondary border-top border-bottom">
                            <a href="index.php?action=loans" title="See All Loans" class="btn btn-custom my-2 ml-1 bg-info">See All Loans</a>
                        </div>
            </div>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                echo $message;
            }
            ?>

            <!-- Loan Form -->
            <form method="post" action="" id="loanForm">
                <div>
                    <!-- Borrower -->
                    <h2 class="mt-2">Borrower</h2>
                    <p>Enter name for a new or existing borrower.</p>
                    <p>
                        <a href="index.php?action=add-loan" class="btn bg-orange p-2" title="Add title by with new author">Add New</a>
                        <a href="index.php?action=existing-borrower" class="btn bg-orange p-2" title="Add title by existing author">Use Existing</a>
                    </p>
                    <table>
                        <tbody>
                            <?php echo $addBorrower . $choice; ?>
                        </tbody>
                    </table>

                </div>
                <div class="book-title">
                    <!-- Title -->
                    <h2 class="mt-2">Title</h2>
                    <label class="mr-1">Book title:</label>
                    <?php echo $addTitle; ?>
                </div>
                <div>
                    <!-- Dates -->
                    <h2 class="mt-2">Dates</h2>
                    <table>
                        <tbody>
                            <tr class="mb-2">
                                <td><label for="dateBorrowed">Date borrowed:</label></td>
                                <td><input type="date" class="rounded" id="dateBorrowed" name="dateBorrowed"><br></td>
                            </tr>
                            <tr class="mb-2">
                                <td><label for="returnDate">Return date:</label></td>
                                <td><input type="date" id="returnDate" name="returnDate"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <!-- Is returned -->
                    <p class="d-flex align-items-center"><input type="checkbox" id="isReturned" name="isReturned" class="mr-2">Returned</p>
                </div>
                <div class="submit">
                    <input type="submit" class="rounded btn btm-lg bg-orange">
                </div>
            </form>
        </div>
    </div>
</main>

<!-- Footer -->
<?php include 'common/footer.php'; ?>