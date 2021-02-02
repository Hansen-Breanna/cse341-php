<?php

/*
 * This is my helper functions file.
 */

 // get user id
function getUserID($username, $password) {
   $db = connectMyBooks();
    if (!$db) {
      echo "An error occurred.\n";
      exit;
   } else {
      $stmt = $db->prepare('SELECT id FROM library_user WHERE username = :username AND user_password = :user_password');
      $stmt->bindValue(':username', $username, PDO::PARAM_STR);
      $stmt->bindValue(':user_password', $password, PDO::PARAM_STR);
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $results[0]['id'];
   }
}

 // get catalog list
 function getCatalog($id) {
     $db = connectMyBooks();
      if (!$db) {
        echo "An error occurred.\n";
        exit;
     } else {
        $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id ORDER BY b.title_of_book');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
     }
}

// get own wish list 
 function getOwnWishes($id) {
   $db = connectMyBooks();
    if (!$db) {
      echo "An error occurred.\n";
      exit;
   } else {
      $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id AND own_wish_list = TRUE ORDER BY b.title_of_book');
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $results;
   }
}

// get read wish list 
function getReadWishes($id) {
   $db = connectMyBooks();
    if (!$db) {
      echo "An error occurred.\n";
      exit;
   } else {
      $stmt = $db->prepare('SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id AND read_wish_list = TRUE ORDER BY b.title_of_book');
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
 function getLoans($id) {
   $db = connectMyBooks();
    if (!$db) {
      echo "An error occurred.\n";
      exit;
   } else {
      $stmt = $db->query('SELECT b.title_of_book, bo.first_name, bo.last_name, bo.phone_number, l.date_borrowed, l.return_date, l.is_returned FROM loan l INNER JOIN book_title b ON l.book_title_id = b.id INNER JOIN borrower bo ON l.borrower_id = bo.id WHERE l.library_user_id = :id ORDER BY date_borrowed DESC;');
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $results;
   }
}

// get borrower details 
function getBorrower($borrower_id) {
   $db = connectMyBooks();
    if (!$db) {
      echo "An error occurred.\n";
      exit;
   } else {
      $stmt = $db->query('SELECT * FROM borrower WHERE id = :id');
      $stmt->execute(array(':id' => $borrower_id));
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
      $bookList .= '<tr><td>' . $book['title_of_book'] . '</td>';
      $bookList .= '<td class="pl-5">' . $book['first_name'] . ' ' . $book['middle_name'] . ' ' . $book['last_name'] . '</td></tr>';
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
      $title = getDetails($loan['book_title_id']);
      //$borrower = getBorrower($loan['borrower_id']);
      $loanList .= '<tr><td>' . $title[0]['title_of_book'] . '</td>';
      //$loanList .= '<td>' . $borrower[0]['first_name'] . ' ' . $borrower[0]['last_name'] . '</td>';
      $loanList .= '<td>' . $loan['date_borrowed'] . '</td>';
      $loanList .= '<td>' . $loan['return_date'] . '</td>'; 
      $loanList .= '<td>' . $loan['is_returned'] . '</td>';
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
   $reviewList = '<div class="d-flex justify-content-center review">';
   foreach ($reviews as $review) {
      $count = $review['rating'];
      $details = getDetails($review['book_title_id']);
      $reviewList .= '<div class="p-3 border border-secondary m-3"><p>';
      for ($i = 0; $i < $count; $i++) {
         $reviewList .= '<i class="fa fa-star text-orange"></i>';
      }
      if ($review['rating'] < 5) {
         $emptyStars = 5 - $count;
         for ($i = 0; $i < $emptyStars; $i++) {
            $reviewList .= '<i class="far fa-star text-orange"></i>';
         }
      }   
      $reviewList .= ' (' . $review['rating'] . ')</p>';
      $reviewList .= '<h3>' . $details[0]['title_of_book'] . '</h3>';
      $reviewList .= '<p>by: ' . $details[0]['first_name'] . ' ' . $details[0]['middle_name'] . ' ' . $details[0]['last_name'] . '<p>';
      $reviewList .= '<p>' . $review['review'] . '<p>';
      $reviewList .= '</div>';
   }
   $reviewList .= '</div>';
   return $reviewList;
}

?>