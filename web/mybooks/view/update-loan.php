<?php
// start session
session_start();

$loanID = $first_name = $middle_name = $last_name = $phone = $titleID = $borrowerID = $dateBorrowed = $returnDate = $isReturned = $update = "";

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
        $_SESSION['loanData'] = $loanData;
        $borrower = displayBorrowerData($loanData); 
    } else {
        try {
            if (isset($_POST['update'])) {
                $borrower_id = $_SESSION['loanData'][0]['borrower_id'];
                $book_title_id = $_SESSION['loanData'][0]['book_title_id'];
                $loan_id = $_SESSION['loanData'][0]['id'];
                // update borrower
                updateBorrower($db, $borrower_id, $first_name, $middle_name, $last_name, $phone);
                // update loan
                updateLoan($db, $loan_id, $book_title_id, $borrower_id, $dateBorrowed, $returnDate);
                unset($_SESSION['loanData']);
                header('Location: index.php?action=update-loan');
            } 
        } catch (Exception $e) {
            echo $e;
            $message = "<p class='px-4 py-3 bg-danger rounded'>Loan was not updated. Please try again.</p>";
        }
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
            <form method="post" action="index.php?action=update-loan">
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
                    <input type="hidden" name="update" value="update">
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