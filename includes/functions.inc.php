<?php

function emptyInputSignup($name, $email, $username, $pwd, $re_pwd){
    if(empty($name) || empty($email) || empty($username) || empty($pwd) || empty($re_pwd)){
        return true;
    }
    else{
        return false;
    }
}

function invalidUid($username){
    if(!preg_match("/^[a-zA-z0-9]*$/", $username)){
        return true;
    }
    else{
        return false;
    }
}

function invalidEmail($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }
    else{
        return false;
    }
}

function pwdMatch($pwd, $re_pwd){
    if($pwd !== $re_pwd){
        return true;
    }
    else{
        return false;
    }
}

function UidExists($conn, $username, $email){
    $sql = "SELECT * FROM users WHERE userUid = ? OR userEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "Something went wrong! Try again.";
        echo "<noscript><meta http-equiv='refresh' content='0;url=http://localhost/project_0/signup.php?error=stmtfailed'></noscript>";
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        return false;
    }
}

function createUser($conn, $name, $email, $username, $pwd){
    $sql = "INSERT INTO users (userName, userEmail, userUid, userPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "Something went wrong! Try again.";
        echo "<noscript><meta http-equiv='refresh' content='0;url=http://localhost/project_0/signup.php?error=stmtfailed'> </noscript>";
        exit();
    }

    $hasedpwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hasedpwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo '<script type="text/javascript">window.location = "login.php"</script>';
    exit();
}

//login logics

function emptyInputLogin($username, $pwd){
    if(empty($username) || empty($pwd)){
        return true;
    }
    else{
        return false;
    }
}

function loginUser($conn, $username, $pwd){
    $UidExists = UidExists($conn, $username,$username);
    
    if($UidExists === false){
        return true;
    }
    
    $hasedpwd = $UidExists["userPwd"];
    $checkpwd = password_verify($pwd,$hasedpwd);

    if($checkpwd === false){
        return true;
    }
    else if($checkpwd === true){
        session_start();
        $_SESSION["userid"] = $UidExists["userId"];
        $_SESSION["useruid"] = $UidExists["userUid"];
        echo '<script type="text/javascript">window.location = "index.php"</script>';
        exit();
    }
}