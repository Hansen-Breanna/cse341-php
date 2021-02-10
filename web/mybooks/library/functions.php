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
   $stmt = $db->query('SELECT r.review, r.rating, a.first_name, a.middle_name, a.last_name, b.title_of_book, lu.username FROM reviews r INNER JOIN book_title b ON r.book_title_id = b.id INNER JOIN library_user lu ON r.library_user_id = lu.id INNER JOIN author a ON a.id = b.author_id');
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
   $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id AND own_wish_list = TRUE ORDER BY b.title_of_book');
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
   $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id AND own_wish_list = TRUE AND a.first_name = :first_name AND a.last_name = :last_name');
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
   $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id AND read_wish_list = TRUE ORDER BY b.title_of_book');
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
   $stmt = $db->prepare('SELECT a.first_name, a.middle_name, a.last_name, u.is_blacklist, u.is_favorite FROM author a INNER JOIN user_author u ON a.id = u.author_id WHERE u.library_user_id = :id ORDER BY last_name');
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
   $stmt = $db->prepare('INSERT INTO author (first_name, middle_name, last_name) VALUES (:first_name, :middle_name, $last_name)');
   $stmt->execute(array(':first_name' => $first_name, ':middle_name' => $middle_name, ':last_name' => $last_name));
}

// Insert user_author
function insertUserAuthor($db, $userID, $authorID, $blacklist, $favorite) {
  // $stmt = $db->prepare('INSERT INTO user_author (library_user_id, author_id, is_blacklist, is_favorite) VALUES (:userID, :authorID, :blacklist, :favorite');
  // $stmt->execute(array(':userID => $first_name, :authorID, :blacklist, :favorite'));
}

// Insert book
function insertTitle($db, $newAuthorID, $title) {
   //$stmt = $db->prepare();
   //$stmt->execute(array());
}

// Insert user-book
function  insertUserBook($db, $userID, $titleID, $own, $own_wish, $read_wish) {
//$stmt = $db->prepare();
//$stmt->execute(array());
}
?>