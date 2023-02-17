<?php
    include_once("header.php");
?>

<script>
        $(document).ready(function(){
            $("form").submit(function(event){
                event.preventDefault();
                var uid = $("#uid").val();
                var pwd = $("#pwd").val();
                var submit = $("#submit").val();
                $(".form-msg").load("includes/login.inc.php", {
                    uid: uid,
                    pwd: pwd,
                    submit: submit
                },function(){
                    var obj = document.getElementsByClassName("form-msg")[0].innerText;
                    try {
                        if(JSON.parse(obj)){
                        obj = JSON.parse(obj);
                        window.location = obj.url;

                    }
                    } catch (error) {
                        //pass
                    }
                });      
            });
        });
   
</script>

    <div class="form">
        <h2>Sign In</h2>
        <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "emptyinput"){
                echo "<p class='form-error-msg'>Fill in all fields!</p>";
            }
            else if($_GET["error"] == "incorrectuid"){
                echo "<p class='form-error-msg'>Username or Password doesn't match</p>";
            }
        }
        ?>
        <form action="includes/login.inc.php" method="POST">
            <input id="uid" type="text" name="uid" placeholder="Username/Email">
            <input id="pwd" type="password" name="pwd" placeholder="Password">
            <button id="submit" type="submit" name="submit">Log In</button>
        </form>
        <p>Create An Account</p><a href="signup.php">Sign Up</a>
        <p class="form-msg"></p>
    </div>

<?php
    include_once("footer.php");
?>