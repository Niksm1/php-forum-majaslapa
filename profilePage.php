<?php
    // Tiek izmantota galvene no faila header.php
    include_once 'header.php';
?>

<!-- Profile rediģēšanas forma -->
<form class="profileForm" action="includes/edit-user.php" method="post">
<h1>Profile settings</h1>

<?php
    // Tiek izmantots fails no includes/db-handler.php, lai pēctam veiktu savienojumu ar datubāzi
    require_once 'includes/db-handler.php';

    // Pārbaude vai lietotājs ir ielogojies
    if(isset($_SESSION["useruid"])){
        // Tiek izveidots sql query
        $sql = "SELECT * FROM users WHERE users.usersId = " . $_SESSION['userid'] . ";";
        // Datubāzē tiek izmatots query un rezultāts tiek saglabāts $result mainīgajā
        $result = $conn->query($sql);

        // Ja rezultāts ir pieejams
        if($result->num_rows > 0){
            // Rezultāta rinda tiek piesaistīta $row mainīgajam
            $row = mysqli_fetch_assoc($result);
            echo '<div class="profileDiv">';
            echo '<p>Full name: </p>';
            echo '<input type="text" placeholder="' . $row["usersName"] . '"name="name"">';
            echo '<input type="submit" class="profileBtn" value="Change" name="ChangeName">';
            echo '</div>';
            echo '<div class="profileDiv">';
            echo '<p>Email: </p>';
            echo '<input type="text" placeholder="' . $row["usersEmail"] . '"name="email"">';
            echo '<input type="submit" class="profileBtn" value="Change" name="ChangeEmail">';
            echo '</div>';
            echo '<div class="profileDiv">';
            echo '<p>Password: </p>';
            echo '<input type="password" placeholder="Password" name="pwd">';

            echo '<p>Confirm password: </p>';
            echo '<input type="password" placeholder="Confirm password" name="pwdConfirm" >';
            echo '<input type="submit" class="profileBtn" value="Change" name="ChangePwd">';
            echo '</div>';
            
        }
    // Ja lietotājs nav ielogojies
    } else {
        // Lietotājs tiek novirzīts uz galveno mājaslapas sadaļu
        header("location: index.php");
        // Kods apstājās un beidz turpināt lasīt
        exit();
    }
?>
</form>
</body>
</html>