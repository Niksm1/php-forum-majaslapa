<?php
    // Tiek izmantota galvene no faila header.php
    include_once 'header.php';
    // Tiek izmantots fails no includes/db-handler.php, lai pēctam veiktu savienojumu ar datubāzi
    require_once 'includes/db-handler.php';

    // Ja url nav nodefinēts username
    if(!isset($_GET["username"])){
        // Izmet ziņojumu, ka nav nodefinēts lietotājs
        echo '<p>No user is specified</p>';
        // Kods apstājās un beidz turpināt lasīt
        exit();
    }

    // Tiek izveidots sql query
    $sql = "SELECT postsId, usersUid, userInput, publishedDate FROM posts, users WHERE posts.usersId = users.usersId;";
    // Datubāzē tiek izmatots query un rezultāts tiek saglabāts $result mainīgajā
    $result = $conn->query($sql);

    // Ja rezultāts ir pieejams  
    if($result->num_rows > 0){
        // Loops iziet cauri katrai rindai un tiek piesaistīts $row mainīgajam
        while($row = $result-> fetch_assoc()){
            // Pārbaude vai raksta lietotājvārds ir tāds pats kā nodefinēts url username mainīgajā
            if($row["usersUid"] == $_GET["username"]){
                // Katru rakstu atspoguļo mājaslapā
                echo '<form class="postBox" action="includes/delete-post.php" method="post">';
                echo '<p>Username: <a href="#" class="username">' . $row["usersUid"] . '</a></p>';
                // Pārbaude vai lietotājs ir ielogojies
                if(isset($_SESSION["useruid"])){
                    // Pārbaude vai noteiktā raksta īpašnieks ir tas pats, kurš šobrīd ir ielogojies
                    if($_SESSION["useruid"] == $row["usersUid"]){
                        // Pievieno dzēšanas pogu pie raksta
                        echo '<input type="submit" value="delete" class="deleteBtn" name="submit">';
                        echo '<input type="hidden" name="postid" value="' . $row["postsId"] . '">';
                    } 
                }
                echo '<div class="post"">';
                echo '<p class="postText">' . $row["userInput"] . '</p>';
                echo '<p class="date">Published: ' . $row["publishedDate"] . '</p>';
                echo '</div>';
                echo '</form>';
            } 
        }
    }
?>
</body>
</html>