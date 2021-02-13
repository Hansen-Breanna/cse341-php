<?php
// start session
session_start();

$loanID = $first_name = $middle_name = $last_name = $phone = $titleID = $borrowerID = $dateBorrowed = $returnDate = $isReturned = "";

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

    if (isset($_POST['loanID'])) {
        $newLoanID = test_input($_POST['loanID']);
        $loanData = getLoanData($db, $newLoanID);  
        $borrower = displayBorrowerData($loanData);
        var_dump($loanData); 
    } else {
        // try {
        //     if (!isset($_POST['borrowerID'])) {
        //         //author
        //         insertBorrower($db, $first_name, $middle_name, $last_name, $phone);
        //         $newBorrowerID = $db->lastInsertId('borrower_id_seq');
        //     } else {
        //         $newBorrowerID = $borrowerID;
        //     }

        //     if (isset($_POST['isReturned'])) {
        //         $isReturned = "TRUE";
        //     } else {
        //         $isReturned = "FALSE";
        //     }
        //     $returned = removeQuotes($isReturned);

        //     insertLoan($db, $_SESSION['id'], $titleID, $newBorrowerID, $dateBorrowed, $returnDate, $returned);
        // } 
        // catch (Exception $e) {
        //     echo $e;
        //     $message = "<p class='px-4 py-3 bg-danger rounded'>Loan was not updated.</p>";
        // }
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

<h1 class="offset-1 col-10 offset-md-0 col-md-12">Update Loan</h1>
</div>
</div>
</header>

<main class="mb-5">
    <div class="container">
        <div class="row d-flex flex-column align-items-center">
            <div class="my-3 mx-2 py-2 border-secondary border-top border-bottom">
                <a href="index.php?action=loans" title="See All Loans" class="btn btn-custom my-2 ml-1 bg-info">See All Loans</a>
            </div>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo $message;
            }
            ?>
            <!-- Loan Form -->
            <form method="post" action="index.php?action=add-loan">
                <div>
                    <!-- Borrower -->
                    <h2 class="mt-2">Borrower</h2>
                    <table>
                        <tbody>
                            <?php echo $borrower; ?>
                        </tbody>
                    </table>

                </div>
                <div class="book-title">
                    <!-- Title -->
                    <h2 class="mt-2 d-inline">Title</h2><span>: <?php echo $loanData[0]['title_of_book']; ?></span>
                </div>
                <div>
                    <!-- Dates -->
                    <h2 class="mt-2">Dates</h2>
                    <table>
                        <tbody>
                            <tr class="mb-2">
                                <td><label for="dateBorrowed">Date borrowed:</label></td>
                                <td><input type="date" class="rounded" id="dateBorrowed" name="dateBorrowed" value="<?php echo $loanData[0]['date_borrowed']; ?>"><br></td>
                            </tr>
                            <tr class="mb-2">
                                <td><label for="returnDate">Return date:</label></td>
                                <td><input type="date" id="returnDate" name="returnDate" value="<?php echo $loanData[0]['return_date']; ?>"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <!-- Is returned -->
                    <?php if ($loanData[0]['is_returned'] == FALSE) {echo "not checked.";} //try {echo $isReturnedEdit($loanData[0]['is_returned']);}catch(Exception $e) {echo $e;} ?>
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