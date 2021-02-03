<?php

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

 // Display loans
function displayLoans($loans) {
    $loanList = '<tbody>';
    foreach ($loans as $loan) {
       $loanList .= '<tr><td>' . $loan['title_of_book'] . '</td>';
       $loanList .= '<td>' . $loan['first_name'] . ' ' . $loan['last_name'] . '</td>';
       $loanList .= '<td>' . $loan['date_borrowed'] . '</td>';
       $loanList .= '<td>' . $loan['return_date'] . '</td>'; 
       $loanList .= '<td><a class="btn btn-small bg-orange" href="sms://+1' . $loan['phone_number'];
       $loanList .= '?&body=Hi%20' . $loan['first_name'] . '!%20The%20book%20you%20borrowed%20' . $loan['title_of_book'];
       $loanList .= '%20is%20overdue.%20Please%20contact%20me%20at%20' . $loan['user_phone'];
       $loanList .= '%20to%20return%20it.%20Thanks!">SMS</a></td>';
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

 // Do a join in reviews
function getDetails($book_title_id) {
    $db = connectMyBooks();
    $stmt = $db->prepare('SELECT author.first_name, author.middle_name, author.last_name, book_title.title_of_book FROM author INNER JOIN book_title ON author.id = book_title.author_id WHERE book_title.id = :id');
    $stmt->execute(array(':id' => $book_title_id));
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
 }

//  // Display authors
// function displayAuthors($authors) {
//     $authorList = '<tbody>';
//     foreach ($authors as $author) {
//        $authorList .= '<tr><td>' . $author['last_name'] . ', ' . $author['first_name'] . ' ' . $author['middle_name'] . '</td>';
//        if($author['is_favorite'] == 't') {
//           $authorList .= '<td class="text-center">Yes</td>';
//        } else {
//           $authorList .= '<td></td>';
//        }
//        if($author['is_blacklist'] == 't') {
//           $authorList .= '<td class="text-center">Yes</td></tr>';
//        } else {
//           $authorList .= '<td></td>';
//        }
//     }
//     $authorList .= '</tbody>';
//     return $authorList;
//  }
 
?>