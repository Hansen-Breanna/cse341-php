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

// // get own wish list by title 
// function getOwnTitle($title, $id) {
//    $db = connectMyBooks();
//    $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id AND own_wish_list = TRUE AND b.title_of_book = :title');
//    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
//    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
//    $stmt->execute();
//    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//    return $results;
// }

// get read wish list 
function getReadWishes($id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id AND read_wish_list = TRUE ORDER BY b.title_of_book');
   $stmt->bindValue(':id', $id, PDO::PARAM_INT);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $results;
}

// // get read wish list title
// function getReadTitle($title, $id) {
//    $db = connectMyBooks();
//    $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id AND read_wish_list = TRUE AND b.title_of_book = :title');
//    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
//    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
//    $stmt->execute();
//    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//    return $results;
// }

// // get all authors
// function getAuthors($id) {
//    $db = connectMyBooks();
//    $stmt = $db->prepare('SELECT a.first_name, a.middle_name, a.last_name, u.is_blacklist, u.is_favorite FROM author a INNER JOIN user_author u ON a.id = u.author_id WHERE u.library_user_id = :id ORDER BY last_name');
//    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
//    $stmt->execute();
//    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//    return $results;
// }


// // get catalog title
// function getTitle($title, $id) {
//    $db = connectMyBooks();
//    $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id AND b.title_of_book = :title');
//    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
//    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
//    $stmt->execute();
//    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//    return $results;
// }

 
// function test_input($data)
// {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
// }

?>