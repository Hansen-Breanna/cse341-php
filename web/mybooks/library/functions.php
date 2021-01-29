<?php

/*
 * This is my helper functions file.
 */

 // get catalog list
 // get catalog list
 function getCatalog() {
     $db = connectMyBooks();
      if (!$db) {
        echo "An error occurred.\n";
        exit;
     } else {
        $statement = $db->query('SELECT * FROM book_title');
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
     }
}

function getAuthorName($author_id) {
   // $db = connectMyBooks();
   // $statement = $db->query('SELECT first_name, middle_name, last_name FROM author WHERE id = :author_id');
   // $stmt = $db->prepare($statement);
   // $stmt->bindValue(':author_id', $author_id, PDO::PARAM_STR);
   // $stmt->execute();
   // $authorData = $stmt->fetch(PDO::FETCH_ASSOC);
   // $stmt->closeCursor();
   // return $authorData;
   return $author_id;
}

function displayCatalog($catalog) {
   $bookList = '<tbody>';
   foreach ($catalog as $book) {
      $bookList .= '<tr><td class="mr-3">' . $book['title_of_book'] . '</td><td>' . getAuthorName($book['author_id']) . '</td></tr>';
   }
   $bookList .= '</tbody>';
   return $bookList;
}
 // get read wish list

 // get own wish list

 // get favorite authors

 // get blacklisted authors

 // get loans

 // get reviews

 ?>