<?php
// Fails priekš vajadzīgajām funkcijām

// Funkcija, kas pārbauda vai reģistrējoties kāds no lauciņiem ir tukšs
function emptyInputSignup($name, $email, $username, $pwd, $pwdConfirm){
    $result;
    // Ja jebkurš no lauciņiem ir tukšs, $result = patiess
    if(empty($name) || empty($username) || empty($email) || empty($pwd) || empty($pwdConfirm)){
        $result = true;
    // Ja visi neviens no lauciņiem nav tukšs $result = nepatiess
    } else {
        $result = false;
    }
    // Atgriest $result
    return $result;
}

// Funkcija, kas pārbauda vai lietotājvārds sastāv no neatļautiem simboliem
function invalidUid($username){
    $result;
    // Ja lietotājvārda ir simboli kas nav no a līdz z, no A līdz Z un no 0 līdz 9, tad $result = patiess
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $result = true;
    // Pretēji $result = nepatiess
    } else {
        $result = false;
    }
    // Atgriest $result
    return $result;
}

// Funkcija, kas pārbauda vai e-pasts ir uzrakstīts nepareizi
function invalidEmail($email){
    $result;
    // Tiek izmantota iebūvēta funkcija, ja e-pasts neatbild prasībām $result = patiess
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    // Pretēji $result = nepatiess
    } else {
        $result = false;
    }
    // Atgriest $result
    return $result;
}

// Funkcija, kas pārbauda vai paroles abos lauciņos sakrīt
function pwdMatch($pwd, $pwdConfirm){
    $result;
    // Ja paroles nesakrīt $result = patiess
    if($pwd !== $pwdConfirm){
        $result = true;
    // Ja paroles sakrīt $result = nepatiess
    } else {
        $result = false;
    }
    // Atgriest $result
    return $result;
}

// Funkcija, kas pārbauda vai lietotājs ar šadu lietotājvārdu vai e-pastu jau pastāv
function uidExists($conn, $username, $email){
    // Tiek izveidots sql statement un saglabāts $sql mainīgajā 
    $sql = "SELECT * FROM users WHERE usersUid = ? or usersEmail = ?;";
    // Tiek veikts savienojums ar datubazi
    $stmt = mysqli_stmt_init($conn);
    // Ja sql statement tiek ievadīts kļudaini
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    // ? zīmes tiek nomainītas ar ievadīto lietotājvārdu un e-pastu 
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    // Sql statement tiek palaists
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    // Ja no datubāses tiek dabūti dati ar šadu lietotājvārdu vai e-pastu
    if($row = mysqli_fetch_assoc($resultData)){
        // Atgriest noteiktā lietotāja datus iekš $row mainīga
        return $row;
    // Ja dati netiek atrasti
    } else {
        $result = false;
        // Atgriest $result = nepatiess
        return $result;
    }


    mysqli_stmt_close($stmt);
}

// Funkcija kas pievieno lietotāju datubāzei
function createUser($conn, $name, $email, $username, $pwd){
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    // Lietotāja parole tiek hashota un saglabāta $hashedPwd mainīgajā
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);


    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../signup.php?error=none");
    exit();
}

// Funkcija, kas pārbauda vai ielogojoties kāds no lauciņiem ir tukšs
function emptyInputLogin($username, $pwd){
    $result;
    if(empty($username) || empty($pwd)){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Funkcija kas pieslēdz lietotāju
function loginUser($conn, $username, $pwd){

    // Pārbauda vai lietotājs eksistē
    $uidExists = uidExists($conn, $username, $username);

    // Ja lietotājs neeksistē
    if($uidExists === false){
        // Izmest error
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    // Pārbauda vai ievadītā parole sakrīt ar datubāzes paroli
    $checkPwd = password_verify($pwd, $pwdHashed);

    // Ja parole nesakrīt
    if($checkPwd === false){
        // Izmest error
        header("location: ../login.php?error=wronglogin");
        exit();
    // Ja parole sakrīt
    } else if ($checkPwd === true) {
        // Atvērt sessiju
        session_start();
        // Globālajam mainīgajam $_SESSION pievienot 3 vērtības lietotāja id, lietotājvārdu un lietotāja vārdu uzvārdu
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        $_SESSION["username"] = $uidExists["usersName"];
        // Lietotājs tiek novirzīts uz galveno mājaslapas sadaļu
        header("location: ../index.php");
        exit();
    }
}

// Funkcija kas pārbauda vai raksta lauciņs ir tukšs
function emptyPost($userInput){
    $result;
    if(empty($userInput)){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Funkcija kas pievieno rakstu datubāzē
function createPost($conn, $userInput, $userId){
    $sql = "INSERT INTO posts (userInput, publishedDate, usersId) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../createPost.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $userInput, date('Y-m-d H:i:s'), $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../index.php?error=none");
    exit();
}

// Funkcija kas rediģē lietotāja datus datubāzē
function editUser($conn, $column, $value){
    session_start();
    $userId = $_SESSION['userid'];
    $sql = "UPDATE users SET $column = ? WHERE usersId = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../profilePage.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "si", $value, $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../profilePage.php?error=none");
    exit();
}

// Funkcija kas izdzēš rakstu no datubāzes
function deletePost($conn, $postId){
    $sql = "DELETE FROM posts WHERE postsId=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $postId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../index.php?error=none");
    exit();
}