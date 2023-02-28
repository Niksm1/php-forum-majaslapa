<?php
    // Tiek izmantota galvene no faila header.php
    include_once 'header.php';
    // Parbaude vai lietotājs nav ielogojies
    if(!isset($_SESSION["useruid"])){
        // Lietotājs tiek novirzīts uz ielogošanās sadaļu
        header("location: ../project/login.php");
        // Kods apstājās un beidz turpināt lasīt
        exit();
    }
?>

<!-- Rakstu izveidošanas forma -->
<form action="includes/createPost-post.php" method="post">
<div class="post">
    <h1>Share a message with the world</h1>
    <textarea cols="20" rows="5" wrap="hard" maxlength="500" class="userInput" name="userInput"></textarea>
    <input type="submit" class="postBtn" value="Post" name="submit">
</div>
</form>

</body>
</html>