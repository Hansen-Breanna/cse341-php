<?php

/*
 * This is my helper functions file.
 */

 // get catalog list
 // get catalog list
 function getCatalog() {
     $db = connect();
    foreach ($db->query('SELECT * FROM book_title') as $row)
    {
      echo("hello");
    }
}
 // get read wish list

 // get own wish list

 // get favorite authors

 // get blacklisted authors

 // get loans

 // get reviews

 ?>