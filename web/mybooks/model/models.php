<?php

// Display book catalog
function displayCatalog($catalog) {
    $bookList = '<tbody>';
    foreach ($catalog as $book) {
       $bookList .= '<tr><td>' . $book['title_of_book'] . '</td>';
       $bookList .= '<td class="pl-2">' . $book['first_name'] . ' ' . $book['middle_name'] . ' ' . $book['last_name'] . '</td>';
       $bookList .= '<td class="pl-2"><a href="" title="Edit"><i class="mr-1 rounded far fa-edit bg-info p-2" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>';
       $bookList .= '<a href=""  title="Delete"><i class="rounded far fa-trash-alt bg-danger p-2" data-toggle="tooltip" data-placement="top" title="Delete"></i></a></td>';
       $bookList .= '</tr>';
    }
    $bookList .= '</tbody>';
    return $bookList;
 }

 // Display loans
function displayLoans($loans) {
    $loanList = '<tbody>';
    foreach ($loans as $loan) {
       $loanList .= '<tr><td class="d-none d-md-table-cell">' . $loan['title_of_book'] . '</td>';
       $loanList .= '<td>' . $loan['first_name'] . ' ' . $loan['last_name'] . '</td>';
       $loanList .= '<td class="d-none d-lg-table-cell">' . $loan['date_borrowed'] . '</td>';
       $loanList .= '<td>' . $loan['return_date'] . '</td>'; 
       $loanList .= '<td><a class="btn btn-small bg-orange mr-1" href="sms://+1' . $loan['phone_number'];
       $loanList .= '?&body=Hi%20' . $loan['first_name'] . '!%20The%20book%20you%20borrowed%2C%20' . $loan['title_of_book'];
       $loanList .= '%2C%20is%20overdue.%20Please%20contact%20me%20at%20' . $loan['user_phone'];
       $loanList .= '%20to%20return%20it.%20Thanks!">SMS</a>';
       $loanList .= '<a href="" title="Edit"><i class="btn btn-small mr-1 rounded far fa-edit bg-info p-2" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>';
       $loanList .= '<a href="" title="Delete"><i class="btn btn-small rounded far fa-trash-alt bg-danger p-2" data-toggle="tooltip" data-placement="top" title="Delete"></i></a></td>';
       $loanList .= '</tr>';
    }
    $loanList .= '</tbody>';
    return $loanList;
 }
 
 function displayReviews($reviews) {
   $reviewList = '<div class="d-flex flex-row justify-content-center flex-wrap review">';
   foreach ($reviews as $review) {
      $count = $review['rating'];
      $reviewList .= '<div class="p-3 border border-secondary m-3 single-review"><p>';
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
      $reviewList .= '<h3>' . $review['title_of_book'] . '</h3>';
      $reviewList .= '<p>by: ' . $review['first_name'] . ' ' . $review['middle_name'] . ' ' . $review['last_name'] . '<p>';
      $reviewList .= '<p>' . $review['review'] . '<p>';
      $reviewList .= '<p>Review by: ' . $review['username'] . '</p>';
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

 // Display authors
function displayAuthors($authors) {
    $authorList = '<tbody>';
    foreach ($authors as $author) {
       $authorList .= '<tr><td class="pr-2">' . $author['last_name'] . ', ' . $author['first_name'] . ' ' . $author['middle_name'] . '</td>';
       if($author['is_favorite'] == 't') {
          $authorList .= '<td>Yes</td>';
       } else {
          $authorList .= '<td></td>';
       }
       if($author['is_blacklist'] == 't') {
          $authorList .= '<td>Yes</td>';
       } else {
          $authorList .= '<td></td>';
       }
       $authorList .= '<td class="pl-2 d-flex flex-row row-nowrap"> 
       <form method="post" action="index.php?action=authors">
         <input type="hidden" name="update" value="' . $author['id'] . '"/>
         <input type="submit" class="bg=info" value="&#9998;"/>
       </form>
       <form method="post" action="index.php?action=authors">
         <input type="hidden" name="delete" value="' . $author['id'] . '"/>
         <input type="submit" class="bg=info" value="&#x1F5D1"/>
      </form>';
       $authorList .= '<a href="index.php?action=authors" title="Edit"><i class="mr-1 rounded far fa-edit bg-info p-2" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>';
       $authorList .= '<a href="index.php?action=authors"  title="Delete"><i class="rounded far fa-trash-alt bg-danger p-2" data-toggle="tooltip" data-placement="top" title="Delete"></i></a></td>';
       $authorList .= '</tr>';
    }
    $authorList .= '</tbody>';
    return $authorList;
 }

 function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function removeQuotes($data) {
   return str_replace('"', "", $data);
}

// Select author from list
function selectAuthor($db) {
   $author = '<select class="p-2 rounded mb-1" name="authorID" id="authorList">';
   $statement = $db->prepare("SELECT first_name, middle_name, last_name, id FROM author ORDER BY last_name");
   $statement->execute();
   
   while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
       $author .= '<option value=' . $row['id'] . '>' . $row['last_name'] . ', ' . $row['first_name'] . ' ' . $row['middle_name'] . '</option>'; 
   }
   $author .= '</select>';
   return $author;
}

// Add new select
function addAuthor() {
   $author = 
   '<tr>
      <td><label for="first-name">First name:</label></td>
      <td><input type="text" class="rounded mb-1" name="first_name" id="first_name"></td>
   </tr>
   <tr>
      <td><label for="middle_name">Middle Name:</label></td>
      <td><input type="text" class="rounded mb-1" name="middle_name" id="middle_name"></td>
   </tr>
   <tr>
      <td><label for="last_name">Last name:</label></td>
      <td><input type="text" class="rounded mb-1" name="last_name" id="last_name"><br></td>
   </tr>';
   return $author;
}

function updateAuthor($data) {
   $author = 
   '<tr>
      <td><label for="first-name">First name:</label></td>
      <td><input type="text" class="rounded mb-1" name="first_name" value="' . $data['first_name'] . 'id="first_name"></td>
   </tr>
   <tr>
      <td><label for="middle_name">Middle Name:</label></td>
      <td><input type="text" class="rounded mb-1" name="middle_name" value="' . $data['middle_name'] . 'id="middle_name"></td>
   </tr>
   <tr>
      <td><label for="last_name">Last name:</label></td>
      <td><input type="text" class="rounded mb-1" name="last_name" value="' . $data['last_name'] . 'id="last_name"><br></td>
   </tr>';
   return $author;
}
