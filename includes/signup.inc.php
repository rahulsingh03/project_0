<?php

if (isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $re_pwd = $_POST['re_pwd'];

    require_once 'conn.inc.php';
    require_once 'functions.inc.php';

    // Validators
    if(emptyInputSignup($name, $email, $username, $pwd, $re_pwd) !== false){
        $emptyInput = true;
        echo "<p class='form-error-msg'>Fill in all fields!</p>";
        echo "<noscript><meta http-equiv='refresh' content='0;url=../signup.php?error=emptyinput'></noscript>";
        exit();
    }

    if(invalidName($name) !== false){
        $invalidUid = true;
        echo "<p class='form-error-msg'>Name should't have numbers!</p>";
        echo "<noscript><meta http-equiv='refresh' content='0;url=../signup.php?error=invalidName'> </noscript>";
        exit();
    }

    if(invalidUid($username) !== false){
        $invalidUid = true;
        echo "<p class='form-error-msg'>Choose a proper username!</p>";
        echo "<noscript><meta http-equiv='refresh' content='0;url=../signup.php?error=invalidUid'> </noscript>";
        exit();
    }

    if(invalidEmail($email) !== false){
        $invalidEmail = true;
        echo "<p class='form-error-msg'>Incorrect Email!</p>";
        echo "<noscript><meta http-equiv='refresh' content='0;url=../signup.php?error=invalidEmail'> </noscript>";
        exit();
    }

    if(pwdMatch($pwd,$re_pwd) !== false){
        $pwdMatch = true;
        echo "<p class='form-error-msg'>Password doesn't match!</p>";
        echo "<noscript><meta http-equiv='refresh' content='0;url=../signup.php?error=checkpwd'> </noscript>";
        exit();
    }

    if(UidExists($conn, $username, $email) !== false){
        echo "<p class='form-error-msg'>Username/Email already taken!</p>";
        echo "<noscript><meta http-equiv='refresh' content='0;url=../signup.php?error=usernametaken'> </noscript>";
        exit();
    }

    createUser($conn, $name, $email, $username, $pwd);
}
else{
    echo "<p class='form-error-msg'>There was an error!</p>";
}

?>

<!-- <script>
    $("#name, #email, #uid, #pwd, #re_pwd").removeClass("input-error");
    var emptyInput = "<?php echo  $emptyInput; ?>";
    var invalidUid = "<?php echo  $invalidUid; ?>";
    var invalidEmail = "<?php echo  $invalidEmail; ?>";
    var pwdMatch = "<?php echo  $pwdMatch; ?>";

    if (emptyInput == true){
        $("#name, #email, #uid, #pwd, #re_pwd").addClass("input-error");
    }
    if (invalidUid == true){
        $("#uid").addClass("input-error");
    }
    if (invalidEmail == true){
        $("#email").addClass("input-error");
    }
    if (pwdMatch == true){
        $("#pwd, #re_pwd").addClass("input-error");
    }
    if (emptyInput == false && invalidUid == false && invalidEmail == false && pwdMatch == false) {
        $("#name, #email, #uid, #pwd, #re_pwd").val("");
    }

</script> -->
