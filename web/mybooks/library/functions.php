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
   $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id ORDER BY b.title_of_book');
   $stmt->bindValue(':id', $id, PDO::PARAM_INT);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

 // get loans
 function getLoans($id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT b.title_of_book, bo.first_name, bo.last_name, bo.phone_number, l.date_borrowed, l.return_date, 
   l.is_returned, lu.user_phone FROM loan l INNER JOIN book_title b ON l.book_title_id = b.id INNER JOIN library_user lu 
   ON lu.id = l.library_user_id INNER JOIN borrower bo ON l.borrower_id = bo.id WHERE l.library_user_id = :id 
   ORDER BY date_borrowed DESC;');
   $stmt->bindValue(':id', $id, PDO::PARAM_INT);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

 // get reviews
 function getReviews() {
   $db = connectMyBooks();
   $statement = $db->query('SELECT * FROM reviews');
   $results = $statement->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

// get own wish list 
function getOwnWishes($id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id AND own_wish_list = TRUE ORDER BY b.title_of_book');
   $stmt->bindValue(':id', $id, PDO::PARAM_INT);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

// get read wish list 
function getReadWishes($id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id AND read_wish_list = TRUE ORDER BY b.title_of_book');
   $stmt->bindValue(':id', $id, PDO::PARAM_INT);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

// get all authors
function getAuthors() {
   $db = connectMyBooks();
   $statement = $db->query('SELECT * FROM author ORDER BY last_name');
   $results = $statement->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}








// // get borrower details 
// function getBorrower($borrower_id) {
//    $db = connectMyBooks();
//    $stmt = $db->query('SELECT * FROM borrower WHERE id = :id');
//    $stmt->execute(array(':id' => $borrower_id));
//    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//    return $results;
// }


// // Get authors names
// function getAuthorName($author_id) {
//    $db = connectMyBooks();
//    $stmt = $db->prepare('SELECT first_name, middle_name, last_name FROM author WHERE id = :id');
//    $stmt->execute(array(':id' => $author_id));
//    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
//    return $row[0]['first_name'] . " " . $row[0]['middle_name'] . " " . $row[0]['last_name'];
// }

// function getDetails($book_title_id) {
//    $db = connectMyBooks();
//    $stmt = $db->prepare('SELECT author.first_name, author.middle_name, author.last_name, book_title.title_of_book FROM author INNER JOIN book_title ON author.id = book_title.author_id WHERE book_title.id = :id');
//    $stmt->execute(array(':id' => $book_title_id));
//    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
//    return $row;
// }

?>