<?php

/*
 * This is my helper functions file.
 */

 // get catalog list
 // get catalog list
 function getCatalog() {
    $db = connect();
    $statement = $db->query('SELECT * FROM book_title');
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
}
 // get read wish list

 // get own wish list

 // get favorite authors

 // get blacklisted authors

 // get loans

 // get reviews

 ?>