<?php
    // Tiek izmantota galvene no faila header.php
    include_once 'header.php';
?>
        <!-- Piereģistrēšanās forma -->
        <form action="includes/signup-user.php" method="post" class="loginForm">
            <h1>Register</h1>
            <div class="textBoxDiv">
                <input type="text" placeholder="Full name" name="name">
            </div>
            <div class="textBoxDiv">
                <input type="text" placeholder="Username" name="uid">
            </div>
            <div class="textBoxDiv">
                <input type="text" placeholder="Email" name="email">
            </div>
            <div class="textBoxDiv">
                <input type="password" placeholder="Password" name="pwd">
            </div>
            <div class="textBoxDiv">
                <input type="password" placeholder="Confirm password" name="pwdConfirm">
            </div>
            <input type="submit" value="Sign up" class="signupBtn" name="submit">
            <?php
            // Pārbaude vai url ir nodefinēts error
            if(isset($_GET["error"])){
                // Ja kāds no lauciņiem nav ievadīts, izmest šo error
                if($_GET["error"] == "emptyinput"){
                    echo "<p>Fill in all fields!</p>";
                // Ja lietotājvārds tiek ievadīts nepareizi, izmest šo error
                } else if ($_GET["error"] == "invaliduid"){
                    echo "<p>Choose a proper username!</p>";
                // Ja ēpasts tiek ievadīts nepareizā forma, izmest šo error
                } else if ($_GET["error"] == "invalidemail"){
                    echo "<p>Choose a proper email!</p>";
                // Ja paroles nesakrīt, izmest šo error
                } else if ($_GET["error"] == "passwordincorect"){
                    echo "<p>Passwords do not match!</p>";
                // Ja lietotājvārds jau ir aizņemts, izmest šo error
                } else if ($_GET["error"] == "usernametaken"){
                    echo "<p>This username/email is alreay taken!</p>";
                // Ja notiek kļume ar sql statement pieprasīšasnu, izmest šo error
                } else if ($_GET["error"] == "stmtfailed"){
                    echo "<p>Something went wrong, try again!</p>";
                // Ja nav kļumes, izmest ziņojumu ka piereģistrēšanas ir notikusi veiksmīgi
                } else if ($_GET["error"] == "none"){
                    echo "<p>U have successfuly signed up!</p>";
                }
            }
            ?>
        </form>
    </body>
</html>