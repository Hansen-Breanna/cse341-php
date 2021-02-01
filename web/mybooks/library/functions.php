<?php

/*
 * This is my helper functions file.
 */

 // get catalog list
 function getCatalog() {
     $db = connectMyBooks();
      if (!$db) {
        echo "An error occurred.\n";
        exit;
     } else {
        $statement = $db->query('SELECT * FROM book_title ORDER BY title_of_book');
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
     }
}

// get own wish list 
 function getOwnWishes() {
   $db = connectMyBooks();
    if (!$db) {
      echo "An error occurred.\n";
      exit;
   } else {
      $statement = $db->query('SELECT * FROM book_title WHERE own_wish_list = TRUE ORDER BY title_of_book');
      $results = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $results;
   }
}

// get read wish list 
function getReadWishes() {
   $db = connectMyBooks();
    if (!$db) {
      echo "An error occurred.\n";
      exit;
   } else {
      $statement = $db->query('SELECT * FROM book_title WHERE read_wish_list = TRUE ORDER BY title_of_book');
      $results = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $results;
   }
}

 // get all authors
 function getAuthors() {
   $db = connectMyBooks();
    if (!$db) {
      echo "An error occurred.\n";
      exit;
   } else {
      $statement = $db->query('SELECT * FROM author ORDER BY last_name');
      $results = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $results;
   }
}

 // get favorite authors
 function getFavorites($authors) {
   $authorList = '<tbody>';
   foreach ($authors as $author) {
      if($author['is_favorite'] == 't') {
         $authorList .= '<tr><td>' . $author['last_name'] . ', ' . $author['first_name'] . ' ' . $author['middle_name'] . '</td></tr>';
      }
   }
   $authorList .= '</tbody>';
   return $authorList;
 }

 // get blacklisted authors
function getBlacklisted($authors) {

}
 // get loans

 // get reviews

// Get authors names
function getAuthorName($author_id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT first_name, middle_name, last_name FROM author WHERE id = :id');
   $stmt->execute(array(':id' => $author_id));
   $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $row[0]['first_name'] . " " . $row[0]['middle_name'] . " " . $row[0]['last_name'];
}

// Display book catalog
function displayCatalog($catalog) {
   $bookList = '<tbody>';
   foreach ($catalog as $book) {
      $bookList .= '<tr><td>' . $book['title_of_book'] . '</td><td class="pl-5">' . getAuthorName($book['author_id']) . '</td></tr>';
   }
   $bookList .= '</tbody>';
   return $bookList;
}

// Display authors
function displayAuthors($authors) {
   $authorList = '<tbody>';
   foreach ($authors as $author) {
      $authorList .= '<tr><td>' . $author['last_name'] . ', ' . $author['first_name'] . ' ' . $author['middle_name'] . '</td></tr>';
   }
   $authorList .= '</tbody>';
   return $authorList;
}

 ?>