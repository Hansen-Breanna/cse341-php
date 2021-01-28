<?php

/*
 * This is my helper functions file.
 */

 // get catalog list
 // get catalog list
 function getCatalog() {
     $db = connect();
    foreach ($db->query('SELECT * password FROM book_title') as $row)
    {
      echo 'user: ' . $row['book_title'];
      echo '<br/>';
    }
}
 // get read wish list

 // get own wish list

 // get favorite authors

 // get blacklisted authors

 // get loans

 // get reviews

 ?>