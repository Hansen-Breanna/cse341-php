<?php

/*
 * This is my helper functions file.
 */

// get user id
function getUserID($username, $password) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT id FROM library_user WHERE username = :username AND user_password = :user_password');
   $stmt->bindValue(':username', $username, PDO::PARAM_STR);
   $stmt->bindValue(':user_password', $password, PDO::PARAM_STR);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results[0]['id'];
}

// get catalog list
function getCatalog($id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name, b.id FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id AND u.is_owned = TRUE ORDER BY b.title_of_book');
   $stmt->bindValue(':id', $id, PDO::PARAM_INT);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

// get catalog title
function getTitle($title, $id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id AND b.title_of_book = :title');
   $stmt->bindValue(':title', $title, PDO::PARAM_STR);
   $stmt->bindValue(':id', $id, PDO::PARAM_INT);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

// get catalog author
function getCatalogAuthor($first_name, $last_name, $id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id AND a.first_name = :first_name AND a.last_name = :last_name');
   $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
   $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
   $stmt->bindValue(':id', $id, PDO::PARAM_INT);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

 // get loans
 function getLoans($id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT b.title_of_book, bo.first_name, bo.last_name, bo.phone_number, l.date_borrowed, l.return_date, 
   l.is_returned, lu.user_phone, l.id FROM loan l INNER JOIN book_title b ON l.book_title_id = b.id INNER JOIN library_user lu 
   ON lu.id = l.library_user_id INNER JOIN borrower bo ON l.borrower_id = bo.id WHERE l.library_user_id = :id 
   ORDER BY date_borrowed;');
   $stmt->bindValue(':id', $id, PDO::PARAM_INT);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

 // get loans title
 function getLoansTitle($title, $id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT b.title_of_book, bo.first_name, bo.last_name, bo.phone_number, l.date_borrowed, l.return_date, 
   l.is_returned, lu.user_phone FROM loan l INNER JOIN book_title b ON l.book_title_id = b.id INNER JOIN library_user lu 
   ON lu.id = l.library_user_id INNER JOIN borrower bo ON l.borrower_id = bo.id WHERE l.library_user_id = :id 
   AND b.title_of_book = :title;');
   $stmt->bindValue(':id', $id, PDO::PARAM_INT);
   $stmt->bindValue(':title', $title, PDO::PARAM_STR);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

 // get loans title
 function getLoanAuthor($first_name, $last_name, $id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT b.title_of_book, bo.first_name, bo.last_name, bo.phone_number, l.date_borrowed, l.return_date, 
   l.is_returned, lu.user_phone FROM loan l INNER JOIN book_title b ON l.book_title_id = b.id INNER JOIN library_user lu 
   ON lu.id = l.library_user_id INNER JOIN borrower bo ON l.borrower_id = bo.id WHERE l.library_user_id = :id 
   AND bo.first_name = :first_name AND bo.last_name = :last_name');
   $stmt->bindValue(':id', $id, PDO::PARAM_INT);
   $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
   $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

 // get reviews
 function getReviews() {
   $db = connectMyBooks();
   $stmt = $db->query('SELECT r.review, r.rating, r.id, a.first_name, a.middle_name, a.last_name, b.title_of_book, lu.username, r.library_user_id FROM reviews r INNER JOIN book_title b ON r.book_title_id = b.id INNER JOIN library_user lu ON r.library_user_id = lu.id INNER JOIN author a ON a.id = b.author_id ORDER BY b.title_of_book');
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

 // get reviews by title
 function getReviewTitle($title) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT r.review, r.rating, a.first_name, a.middle_name, a.last_name, b.title_of_book, lu.username FROM reviews r INNER JOIN book_title b ON r.book_title_id = b.id INNER JOIN library_user lu ON r.library_user_id = lu.id INNER JOIN author a ON a.id = b.author_id WHERE b.title_of_book = :title');
   $stmt->bindValue(':title', $title, PDO::PARAM_STR);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

 // get reviews by author
 function getAuthorReviews($first_name, $last_name) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT r.review, r.rating, a.first_name, a.middle_name, a.last_name, b.title_of_book, lu.username FROM reviews r INNER JOIN book_title b ON r.book_title_id = b.id INNER JOIN library_user lu ON r.library_user_id = lu.id INNER JOIN author a ON a.id = b.author_id WHERE a.first_name = :first_name AND a.last_name = :last_name');
   $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
   $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

// get own wish list 
function getOwnWishes($id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name, b.id FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id AND own_wish_list = TRUE ORDER BY b.title_of_book');
   $stmt->bindValue(':id', $id, PDO::PARAM_INT);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

// get own wish list by title 
function getOwnTitle($title, $id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id AND own_wish_list = TRUE AND b.title_of_book = :title');
   $stmt->bindValue(':id', $id, PDO::PARAM_INT);
   $stmt->bindValue(':title', $title, PDO::PARAM_STR);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

// get own wish list by author
function getOwnAuthor($first_name, $last_name, $id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name, b.id FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id AND own_wish_list = TRUE AND a.first_name = :first_name AND a.last_name = :last_name');
   $stmt->bindValue(':id', $id, PDO::PARAM_INT);
   $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
   $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

// get read wish list 
function getReadWishes($id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name, b.id FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id AND read_wish_list = TRUE ORDER BY b.title_of_book');
   $stmt->bindValue(':id', $id, PDO::PARAM_INT);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

// get read wish list title
function getReadTitle($title, $id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id AND read_wish_list = TRUE AND b.title_of_book = :title');
   $stmt->bindValue(':id', $id, PDO::PARAM_INT);
   $stmt->bindValue(':title', $title, PDO::PARAM_STR);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

// get read wish list by author
function getReadAuthor($first_name, $last_name, $id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id AND read_wish_list = TRUE AND a.first_name = :first_name AND a.last_name = :last_name');
   $stmt->bindValue(':id', $id, PDO::PARAM_INT);
   $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
   $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

// get all authors
function getAuthors($id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT a.id, a.first_name, a.middle_name, a.last_name, u.is_blacklist, u.is_favorite FROM author a INNER JOIN user_author u ON a.id = u.author_id WHERE u.library_user_id = :id ORDER BY last_name');
   $stmt->bindValue(':id', $id, PDO::PARAM_INT);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

// get author by name
function getByAuthor($first_name, $last_name, $id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT a.first_name, a.middle_name, a.last_name, u.is_blacklist, u.is_favorite FROM author a INNER JOIN user_author u ON a.id = u.author_id WHERE u.library_user_id = :id AND a.first_name = :first_name AND a.last_name = :last_name');
   $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
   $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
   $stmt->bindValue(':id', $id, PDO::PARAM_INT);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $results;
}

// Insert author
function insertAuthor($db, $first_name, $middle_name, $last_name) {
   $stmt = $db->prepare('INSERT INTO author (first_name, middle_name, last_name) VALUES (:first_name, :middle_name, :last_name)');
   $stmt->execute(array(':first_name' => $first_name, ':middle_name' => $middle_name, ':last_name' => $last_name));
}

// Insert user_author
function insertUserAuthor($db, $userID, $authorID, $blacklist, $favorite) {
  $stmt = $db->prepare('INSERT INTO user_author (library_user_id, author_id, is_blacklist, is_favorite) VALUES (:userID, :authorID, :blacklist, :favorite)');
  $stmt->execute(array(':userID' => $userID, ':authorID' => $authorID, ':blacklist' => $blacklist, ':favorite' => $favorite));
}

// Insert user_author with just id
function insertUserAuthorFromTitle($db, $userID, $authorID) {
   $stmt = $db->prepare('INSERT INTO user_author (library_user_id, author_id) VALUES (:userID, :authorID)');
   $stmt->execute(array(':userID' => $userID, ':authorID' => $authorID));
 }

// Insert book
function insertTitle($db, $authorID, $title) {
   $stmt = $db->prepare('INSERT INTO book_title (author_id, title_of_book) VALUES (:authorID, :title)');
   $stmt->execute(array(':authorID' => $authorID, ':title' => $title));
}

// Insert user-book
function  insertUserBook($db, $userID, $titleID, $own, $own_wish, $read_wish) {
   $stmt = $db->prepare('INSERT INTO user_book (library_user_id, book_title_id, is_owned, own_wish_list, read_wish_list) VALUES (:userID, :titleID, :owned, :own_wish, :read_wish)');
   $stmt->execute(array(':userID' => $userID, ':titleID' => $titleID, ':owned' => $own, ':own_wish' => $own_wish, ':read_wish' => $read_wish));
}

// // Delete user_book by author_id
// function deleteUserBooks($id) {
//    $db = connectMyBooks();
//    $stmt = $db->prepare('DELETE FROM user_book WHERE author_id = :id');
//    $stmt->execute(array(':id' => $id));
// }

// // Delete book_title by author_id
// function deleteBooks($id) {
//    $db = connectMyBooks();
//    $stmt = $db->prepare('DELETE FROM book_title WHERE author_id = :id');
//    $stmt->execute(array(':id' => $id));
// }

// // Delete user_author
// function deleteUserAuthor($id) {
//    $db = connectMyBooks();
//    $stmt = $db->prepare('DELETE FROM user_author WHERE author_id = :id');
//    $stmt->execute(array(':id' => $id));
// }

// Delete author
function deleteAuthor($db, $id, $authorID) {
   $db = connectMyBooks();
   $stmt = $db->prepare('DELETE FROM user_author WHERE library_user_id = :id AND author_id = :authorID');
   $stmt->execute(array(':id' => $id, ':authorID' => $authorID));
}

function getAuthor($id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT a.first_name, a.middle_name, a.last_name, ua.is_blacklist, ua.is_favorite, a.id FROM author a INNER JOIN user_author ua ON ua.author_id = a.id WHERE a.id = :id');
   $stmt->bindValue(':id', $id, PDO::PARAM_INT);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

// insert review
function insertReview($db, $id, $titleID, $review, $rating) {
   $stmt = $db->prepare('INSERT INTO reviews (library_user_id, book_title_id, review, rating) VALUES (:id, :titleID, :review, :rating)');
   $stmt->execute(array(':id' => $id, ':titleID' => $titleID, ':review' => $review, ':rating' => $rating));
}

// insert borrower
function insertBorrower($db, $first_name, $middle_name, $last_name, $phone) {
   $stmt = $db->prepare('INSERT INTO borrower (first_name, middle_name, last_name, phone_number) VALUES (:first_name, :middle_name, :last_name, :phone)');
   $stmt->execute(array(':first_name' => $first_name, ':middle_name' => $middle_name, ':last_name' => $last_name, ':phone' => $phone));
}

function insertUser_Borrower($db, $user_id, $borrower_id) {
   $stmt = $db->prepare('INSERT INTO user_borrower (library_user_id, borrower_id) VALUES (:user, :borrower)');
   $stmt->execute(array(':user' => $user_id, ':borrower' => $borrower_id));
}

function insertLoan($db, $userID, $titleID, $borrowerID, $dateBorrowed, $returnDate, $returned) {
   $stmt = $db->prepare('INSERT INTO loan (library_user_id, book_title_id, borrower_id, date_borrowed, return_date, is_returned) VALUES (:userID, :titleID, :borrowerID, :dateBorrowed, :returnDate, :returned)');
   $stmt->execute(array(':userID' => $userID, ':titleID' => $titleID, ':borrowerID' => $borrowerID, ':dateBorrowed' => $dateBorrowed, ':returnDate' => $returnDate, ':returned' => $returned)); 
}

// Delete title
function deleteTitle($db, $id, $titleID) {
   $stmt = $db->prepare('DELETE FROM user_book WHERE library_user_id = :id AND book_title_id = :titleID');
   $stmt->execute(array(':id' => $id, ':titleID' => $titleID));
}

// Get author id by using names
function getAuthorID($db, $first_name, $middle_name, $last_name) {
   $stmt = $db->prepare('SELECT id FROM author WHERE first_name = :first_name AND middle_name = :middle_name AND last_name = :last_name');
   $stmt->execute(array(':first_name' => $first_name, ':middle_name' => $middle_name, ':last_name' => $last_name));
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results[0]['id'];
}

// Delete loan by ID
function deleteLoan($db, $deleteID) {
   $stmt = $db->prepare('DELETE FROM loan WHERE id = :deleteID');
   $stmt->execute(array(':deleteID' => $deleteID));
}

// Delete review by ID
function deleteReview($db, $deleteID) {
   $stmt = $db->prepare('DELETE FROM reviews WHERE id = :deleteID');
   $stmt->execute(array(':deleteID' => $deleteID));
}

// Update author name
function updateAuthor($db, $first_name, $middle_name, $last_name, $id) {
   $stmt = $db->prepare('UPDATE author SET first_name = :first_name, middle_name = :middle_name, last_name = :last_name WHERE id = :id');
   $stmt->execute(array(':id' => $id, ':first_name' => $first_name, ':middle_name' => $middle_name, ':last_name' => $last_name));
}

// Update User Author by Author ID
function updateUserAuthor($db, $userID, $authorID, $blacklist, $favorite) {
   $stmt = $db->prepare('UPDATE user_author SET is_blacklist = :blacklist, is_favorite = :favorite WHERE author_id = :authorID AND library_user_id  = :userID');
   $stmt->execute(array(':userID' => $userID, ':authorID' => $authorID, ':blacklist' => $blacklist, ':favorite' => $favorite));
}

// Get data for review by ID
function getReview($db, $id) {
   $stmt = $db->prepare('SELECT r.review, r.rating, r.id, a.first_name, a.middle_name, a.last_name, b.title_of_book, b.author_id FROM reviews r INNER JOIN book_title b ON r.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE r.id = :id');
   $stmt->execute(array(':id' => $id));
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

// Update review by ID
function updateReview($db, $id, $review, $rating) {
   $stmt = $db->prepare('UPDATE reviews SET rating = :rating, review = :review WHERE id = :id');
   $stmt->execute(array(':id' => $id, ':rating' => $rating, ':review' => $review));
}

// Get data for loan by ID
function getLoanData($db, $id) {
   $stmt = $db->prepare('SELECT l.book_title_id, b.title_of_book, bo.first_name, bo.middle_name, bo.last_name, bo.phone_number, l.borrower_id, l.date_borrowed, l.return_date, l.is_returned, l.id FROM loan l INNER JOIN borrower bo ON l.borrower_id = bo.id INNER JOIN book_title b ON b.id = l.book_title_id WHERE l.id = :id');
   $stmt->execute(array(':id' => $id));
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

// update borrower by ID 
function updateBorrower($db, $id, $first_name, $middle_name, $last_name, $phone) {
   $stmt = $db->prepare('UPDATE borrower SET first_name = :first_name, middle_name = :middle_name, last_name = :last_name, phone_number = :phone WHERE id = :id');
   $stmt->execute(array(':id' => $id, ':first_name' => $first_name, ':middle_name' => $middle_name, ':last_name' => $last_name, ':phone' => $phone));
}

// Update loan by ID
function updateLoan($db, $loanID, $book_title_id, $borrower_id, $date_borrowed, $return_date) {
   $stmt = $db->prepare('UPDATE loan SET book_title_id = :book_title_id, borrower_id = :borrower_id, date_borrowed = :date_borrowed, return_date = :return_date WHERE id = :id');
   $stmt->execute(array(':id' => $loanID, ':book_title_id' => $book_title_id, ':borrower_id' => $borrower_id, ':date_borrowed' => $date_borrowed, ':return_date' => $return_date));
}

// Get book_title data by user
function getUserBookData($db, $library_user_id, $book_title_id) {
   $stmt = $db->prepare('SELECT ub.book_title_id, ub.is_owned, ub.own_wish_list, ub.read_wish_list, b.author_id, b.title_of_book, ua.is_blacklist, ua.is_favorite, a.first_name, a.middle_name, a.last_name FROM user_book ub INNER JOIN book_title b ON ub.book_title_id = b.id INNER JOIN user_author ua ON b.author_id = ua.author_id INNER JOIN author a ON ua.author_id = a.id WHERE book_title_id = :book_title_id AND ub.library_user_id = :library_user_id');
   $stmt->execute(array(':book_title_id' => $book_title_id, ':library_user_id' => $library_user_id));
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

// update user_book by book title
function updateUserBook($db, $user_id, $book_title_id, $own, $own_wish, $read_wish) {
   $stmt = $db->prepare('UPDATE user_book SET is_owned = :is_owned, own_wish_list = :own_wish_list, read_wish_list = :read_wish_list WHERE library_user_id = :id AND book_title_id = :book_title_id');
   $stmt->execute(array(':id' => $user_id, ':own_wish_list' => $own_wish, ':is_owned' => $own, ':read_wish_list' => $read_wish, ':book_title_id' => $book_title_id));
}

// Insert user
function insertUser($db, $first_name, $last_name, $username, $passwordHash, $email, $phone) {
   $stmt = $db->prepare('INSERT INTO library_user (first_name, last_name, username, user_password, user_email, user_phone) VALUES (:first_name, :last_name, :user, :pass, :email, :phone)');
   $stmt->execute(array(':first_name' => $first_name, ':last_name' => $last_name, ':user' => $username, ':pass' => $passwordHash, ':email' => $email, ':phone' => $phone));
}

function check_id($db, $user) 
{
   $stmt = $db->prepare('SELECT username, user_password FROM library_user WHERE username = :user');
   $stmt->bindValue(':user', $user, PDO::PARAM_STR);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

?>