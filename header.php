<!-- Galvene, kas visām majaslapas lapām būs vienāda -->
<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forum project</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav>
        <div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php
                    // Ja lietotājs ir ielogojies savā profilā, viņam ir iespēja veikt rakstus, rediģēt profilu un izlogoties.
                    if(isset($_SESSION["useruid"])){
                        echo "<li><a href='createPost.php'>Create Post</a></li>";
                        echo "<li><a href='profilePage.php'>Profile page</a></li>";
                        echo "<li><a href='includes/logout-user.php'>Log out</a></li>";
                    // Ja lietotājs nav ielogojies, tad lietotājam ir iespēja tikai lasīt citu rakstus.
                    } else {
                        echo "<li><a href='login.php'>Log in</a></li>";
                        echo "<li><a href='signup.php'>Sign up</a></li>";
                    }
                ?>

            </ul>
        </div>
    </nav>