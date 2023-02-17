<?php

if(isset($_POST["submit"])){

    $username = $_POST['uid'];
    $pwd = $_POST['pwd'];

    require_once 'conn.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputLogin($username, $pwd) !== false){
        echo "<p class='form-error-msg'>Fill in all fields!</p>";
        echo "<noscript><meta http-equiv='refresh' content='0;url=../login.php?error=emptyinput'></noscript>";
        exit();
    }

    if(loginUser($conn, $username, $pwd) !== false){
        echo "<p class='form-error-msg'>Username or Password doesn't match</p>";
        echo "<noscript><meta http-equiv='refresh' content='0;url=../login.php?error=incorrectuid'></noscript>";
        exit();
    }
}
else{
    echo "<p class='form-error-msg'>There was an error!</p>";
    exit();
}
?>

