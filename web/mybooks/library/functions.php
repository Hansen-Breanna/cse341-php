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

 // get loans
 function getLoans() {
   $db = connectMyBooks();
    if (!$db) {
      echo "An error occurred.\n";
      exit;
   } else {
      $statement = $db->query('SELECT * FROM loan ORDER BY date_borrowed DESC');
      $results = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $results;
   }
}

 // get reviews
 function getReviews() {
   $db = connectMyBooks();
    if (!$db) {
      echo "An error occurred.\n";
      exit;
   } else {
      $statement = $db->query('SELECT * FROM reviews');
      $results = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $results;
   }
}
// Get authors names
function getAuthorName($author_id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT first_name, middle_name, last_name FROM author WHERE id = :id');
   $stmt->execute(array(':id' => $author_id));
   $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $row[0]['first_name'] . " " . $row[0]['middle_name'] . " " . $row[0]['last_name'];
}

function getDetails($book_title_id) {
   $db = connectMyBooks();
   $stmt = $db->prepare('SELECT author.first_name, author.middle_name, author.last_name, book_title.title_of_book FROM author INNER JOIN book_title ON author.id = book_title.author_id WHERE book_title.id = :id');
   $stmt->execute(array(':id' => $book_title_id));
   $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $row;
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
      $authorList .= '<tr><td>' . $author['last_name'] . ', ' . $author['first_name'] . ' ' . $author['middle_name'] . '</td>';
      if($author['is_favorite'] == 't') {
         $authorList .= '<td class="text-center">Yes</td>';
      } else {
         $authorList .= '<td></td>';
      }
      if($author['is_blacklist'] == 't') {
         $authorList .= '<td class="text-center">Yes</td></tr>';
      } else {
         $authorList .= '<td></td>';
      }
   }
   $authorList .= '</tbody>';
   return $authorList;
}

// Display loans
function displayLoans($loans) {
   $loanList = '<tbody>';
   foreach ($loans as $loan) {
      $loanList .= '<tr><td>' . $loan['book_title_id'] . '</td>';
      $loanList .= '<td>' . $loan['borrower_id'] . '</td>';
      $loanList .= '<td>' . $loan['date_borrowed'] . '</td>';
      $loanList .= '<td>' . $loan['return_date'] . '</td>'; 
      // $loanList .= '<td>' . $loan['is_returned'] . '</td>';
      // if($loan['is_favorite'] == 't') {
      //    $loanList .= '<td class="text-center">Yes</td>';
      // } else {
      //    $loanList .= '<td></td>';
      // }
      // if($loan['is_blacklist'] == 't') {
      //    $loanList .= '<td class="text-center">Yes</td></tr>';
      // } else {
      //    $loanList .= '<td></td>';
      // }
   }
   $loanList .= '</tbody>';
   return $loanList;
}

function displayReviews($reviews) {
   $reviewList = '<div>';
   foreach ($reviews as $review) {
      $count = $review['rating'];
      $details = getDetails($review['book_title_id']);
      var_dump($details);
      $reviewList .= '<div><p class="text-orange>';
      for ($i = 0; $i < $count; $i++) {
         $reviewList .= '<i class="fa fa-star"></i>';
      }
      if ($review['rating'] < 5) {
         $emptyStars = 5 - $count;
         for ($i = 0; $i < $emptyStars; $i++) {
            $reviewList .= '<i class="far fa-star"></i>';
         }
      }   
      $reviewList .= '(' . $review['rating'] . ')</p></div>';
      $reviewList .= '<h3>' . $details[0]['book_title'] . '</h3>';
      $reviewList .= '<p>' . $details[0]['first_name'] . ' ' . $details[0]['middle_name'] . ' ' . $details[0]['last_name'] . '<p>';
      $reviewList .= '<p>' . $review['review'] . '<p>';
      $reviewList .= '</div>';
   }
   $reviewList .= '</div>';
   return $reviewList;
}

?>