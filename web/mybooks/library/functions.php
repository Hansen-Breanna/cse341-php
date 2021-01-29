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
 // get read wish list

 // get own wish list

 // get favorite authors

 // get blacklisted authors

 // get loans

 // get reviews

 ?>