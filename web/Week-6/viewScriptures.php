<?php
/**********************************************************
* File: viewScriptures.php
* Author: Br. Burton
* 
* Description: This file shows an example of how to query a
*   PostgreSQL database from PHP.
***********************************************************/

require "dbConnect.php";
$db = get_db();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Scripture List</title>
</head>

<body>
<div>

<h1>Scripture Resources</h1>

<?php

// In this example, for simplicity, the query is executed
// right here and the data echoed out as we iterate the query.

// You could imagine that in a more involved application, we
// would likely query the database in a completely separate file / function
// and build a list of objects that held the components of each
// scripture. Then, here on the page, we could simply call that 
// function, and iterate through the list that was returned and
// print each component.



// First, prepare the statement

// Notice that we avoid using "SELECT *" here. This is considered
// good practice so we don't inadvertently bring back data we don't
// want, especially if the database changes later.
$statement = $db->prepare("SELECT book, chapter, verse, content FROM scripture");
$statement->execute();

// Go through each result
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
	// The variable "row" now holds the complete record for that
	// row, and we can access the different values based on their
	// name
	$book = $row['book'];
	$chapter = $row['chapter'];
	$verse = $row['verse'];
	$content = $row['content'];

	echo "<p><strong>$book $chapter:$verse</strong> - \"$content\"<p>";
}

?>

<form method="post" action="confirmation.php">
                    <div class="name">
                        <label for="name">Name:</label> 
                        <input class="w-75" type="text" name="name" id="name"><br>
                    </div>
                    <div class="email">
                        <label for="email">Street:</label>
                        <input class="w-75" type="text" name="street" id="street"><br>
                    </div>
                    <div class="email">
                        <label for="email">City:</label>
                        <input class="w-75" type="text" name="city" id="city"><br>
                    </div>
                    <div class="state">
                        <label for="state">State:</label>
                        <input class="w-75" type="text" name="state" id="state" placeholder="ID"><br>
                    </div>
                    <div class="zip">
                        <label for="zip">Zip:</label>
                        <input class="w-75" type="number" name="zip" id="zip"><br>
                    </div>
                    <div class="email">
                        <label for="email">Email:</label>
                        <input class="w-75" type="email" name="email" id="email"><br>
                    </div>
                    <div class="submit">
                        <input type='hidden' id='session' name='session' value='<?php var_dump($_SESSION); ?>'>
                        <input type="submit" class="btn btn-custom bg-green text-dark my-2">
                    </div>
                </form>

</div>

</body>
</html>