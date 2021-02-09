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

$book = $chapter = $verse = $content = $topic = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book = test_input($_POST["book"]);
    $chapter = test_input($_POST["chapter"]);
    $verse = test_input($_POST["verse"]);
    $content = test_input($_POST["content"]);
    $topic = test_input($_POST["topic"]);

   // echo $book . ' ' . $chapter . ':' . $verse . ' - ' . $content;

        $stmt= $db->prepare('INSERT INTO scripture (book, chapter, verse, content) VALUES (:book, :chapter, :verse, :content)');
        // $stmt->bindValue(':book', $book, PDO::PARAM_STR);
        // $stmt->bindValue(':chapter', $chapter, PDO::PARAM_INT);
        // $stmt->bindValue(':verse', $verse, PDO::PARAM_INT);
        // $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        // $stmt->execute();
        $stmt->execute(array(':book' => $book, ':chapter' => $chapter, ':verse' => $verse, ':content' => $content));

    $newScriptureID = $db->lastInsertId('scripture_id_seq');
    echo $newScriptureID;

    
        // $stmt = $db->prepare('INSERT INTO scripture_topic (scripture_id, topic_id) VALUES (:newScriptureID, :topic)');
        // $stmt->bindValue(':topic', $topic, PDO::PARAM_INT);
        // $stmt->bindValue(':newScriptureID', $newScriptureID, PDO::PARAM_INT);
        // $stmt->execute();    
}
    
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}




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
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
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

        <form method="post" action="viewScriptures.php">
            <div class="book">
                <label for="book">Book:</label>
                <input type="text" name="book" id="book"><br>
            </div>
            <div class="chapter">
                <label for="chapter">Chapter:</label>
                <input type="text" name="chapter" id="chapter"><br>
            </div>
            <div class="verse">
                <label for="verse">Verse:</label>
                <input type="text" name="verse" id="verse"><br>
            </div>
            <div class="content">
                <label for="content">Content:</label>
                <textarea rows="4" columns="50" name="content" id="content"></textarea>
            </div>
            <div class="topic">
            <?php
            $stmt = $db->prepare('SELECT * FROM topic');
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            var_dump($rows);
                // foreach($topic as $name) {
                //    echo '<label for="vehicle1">I have a bike</label><br>';
                //     echo '<input type="checkbox" id="vehicle2" name="vehicle2" value="Car">';
                // }
            ?>
            </div>
            <div class="submit">
                <input type="submit">
            </div>
        </form>

    </div>

</body>

</html>