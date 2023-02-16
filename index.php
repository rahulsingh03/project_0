<?php
    include_once("header.php");
?>
    <?php
        if(isset($_SESSION["useruid"])){
            echo "<li><a href='includes/logout.inc.php'>Logout</a></li>";
            echo "<p>Hello there! {$_SESSION["useruid"]} </p>";
        }else{
            echo "<li><a href='signup.php'>SignUp</a></li>";
            echo "<li><a href='login.php'>LogIn</a></li>";
        }
    ?>
        
<?php
    include_once("footer.php");
?>
