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

$book = $chapter = $verse = $content = $topic = $topicName = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book = test_input($_POST["book"]);
    $chapter = test_input($_POST["chapter"]);
    $verse = test_input($_POST["verse"]);
    $content = test_input($_POST["content"]);
    $topic = test_input($_POST["topic"]);
    $topicName = test_input($_POST["topicName"]);
    echo $topicName;

   // echo $book . ' ' . $chapter . ':' . $verse . ' - ' . $content;

        $stmt= $db->prepare('INSERT INTO scripture (book, chapter, verse, content) VALUES (:book, :chapter, :verse, :content)');
        $stmt->execute(array(':book' => $book, ':chapter' => $chapter, ':verse' => $verse, ':content' => $content));

        $newScriptureID = $db->lastInsertId('scripture_id_seq');

        if ($topicName != "") {
                        // Insert into topic
        $stmt = $db->prepare('INSERT INTO topic (topic) VALUES (:topic)');
        $stmt->execute(array(':topic' => $topicName));

        // Get last topic id
        $newTopicID = $db->lastInsertId('topic_id_seq');
        echo $newTopicID;
        // Insert into scripture_topic
        $stmt = $db->prepare('INSERT INTO scripture_topic (scripture_id, topic_id) VALUES (:newScriptureID, :newTopicID)');
        $stmt->execute(array(':newTopicID' => $newTopicID, 'newScriptureID' => $newScriptureID));
        } else {
                
        $stmt = $db->prepare('INSERT INTO scripture_topic (scripture_id, topic_id) VALUES (:newScriptureID, :topic)');
        $stmt->bindValue(':topic', $topic, PDO::PARAM_INT);
        $stmt->bindValue(':newScriptureID', $newScriptureID, PDO::PARAM_INT);
        $stmt->execute(); 
        }   
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

        <div id="scriptures">

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
        $statement = $db->prepare("SELECT s.book, s.chapter, s.verse, s.content, t.topic FROM scripture_topic st INNER JOIN scripture s ON st.scripture_id = s.id INNER JOIN topic t ON st.topic_id = t.id");
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
            $topic = $row['topic'];

            echo "<p>$topic - <strong>$book $chapter:$verse</strong> - \"$content\"<p>";
        }

        ?>

    </div>
        <form method="post" action="">
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
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($rows as $topic) {
                   echo '<br><label>' . $topic['topic'] . '</label>';
                    echo '<input type="checkbox" id="' . $topic['topic'] . '" name="topic" value="' . $topic['id'] . '"><br>';
                }
                
            ?>

            
                <input type="checkbox" onclick="var input = document.getElementById('topicName'); if(this.checked){ input.disabled = false; input.focus();}else{input.disabled=true;}" />Other...
        <input id="topicName" name="topicName" disabled="disabled"/>
             
            </div>

            <script>
                function addScripture(str) {
if (str.length == 0) {
    document.getElementById("scriptures").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("scriptures").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "viewScriptures.php", true);
    xmlhttp.send();
  }
}
            </script>

            <div class="submit">
                <input type="submit" onclick="addScripture(this.value)">
            </div>
        </form>

    </div>

</body>

</html>