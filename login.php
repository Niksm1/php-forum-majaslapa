<?php
    // Tiek izmantota galvene no faila header.php
    include_once 'header.php';
?>
        <!-- Login forma -->
        <form action="includes/login-user.php" method="post" class="loginForm">
            <h1>Login</h1>
            <div class="textBoxDiv">
                <input type="text" placeholder="Username/Email" name="uid">
            </div>
            <div class="textBoxDiv">
                <input type="password" placeholder="Password" name="pwd">
            </div>
            <input class="loginBtn" type="submit" value="Login" name="submit">
            <?php
                // Pārbaude vai url ir nodefinēts error
                if(isset($_GET["error"])){
                    // Ja kāds no lauciņiem nav ievadīts, izmest šo error
                    if($_GET["error"] == "emptyinput"){
                        echo "<p>Fill in all fields!</p>";
                    // Ja tiek ievadīti nepareizi dati lauciņos, izmest šo error
                    } else if ($_GET["error"] == "wronglogin"){
                        echo "<p>Incorrect login information!</p>";
                    }
                }
            ?>
        </form>
    </body>
</html>