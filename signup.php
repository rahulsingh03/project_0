<?php
    include_once("header.php");
?>
<script>
        $(document).ready(function(){
            $("form").submit(function(event){
                event.preventDefault();
                var name = $("#name").val();
                var email = $("#email").val();
                var uid = $("#uid").val();
                var pwd = $("#pwd").val();
                var re_pwd = $("#re_pwd").val();
                var submit = $("#submit").val();
                $(".form-msg").load("includes/signup.inc.php",{
                    name: name,
                    email: email,
                    uid: uid,
                    pwd: pwd,
                    re_pwd: re_pwd,
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
        <h2>Sign Up</h2>

        <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "emptyinput"){
                echo "<p class='form-error-msg'>Fill in all fields!</p>";
            }
            else if($_GET["error"] == "invalidUid"){
                echo "<p class='form-error-msg'>Choose a proper username!</p>";
            }
            else if($_GET["error"] == "invalidEmail"){
                echo "<p class='form-error-msg'>Incorrect Email!</p>";
            }
            else if($_GET["error"] == "checkpwd"){
                echo "<p class='form-error-msg'>Password doesn't match!</p>";
            }
            else if($_GET["error"] == "usernametaken"){
                echo "<p class='form-error-msg'>Username/Email already taken!</p>";
            }
            else if($_GET["error"] == "stmtfailed"){
                echo "<p class='form-error-msg'>Something went wrong! Try again.</p>";
            }
            else if($_GET["error"] == "none"){
                echo "<p class='form-error-msg'>You've signed up!</p>";
            }
        }
        ?>
        <form action="includes/signup.inc.php" method="post">
            <input id="name" type="text" name="name" placeholder="Name" >
            <input id="email" type="email" name ="email" placeholder="Email" >
            <input id="uid" type="text" name="uid" placeholder="Username" >
            <input id="pwd" type="password" name="pwd" placeholder="Password" >
            <input id="re_pwd" type="password" name="re_pwd" placeholder="Confirm Password" > 
            <button id="submit" type="submit" name="submit">Sign Up</button>
        </form>
        <p>Already Have An Account?</p><a href="login.php">Sign In</a>
        <p class="form-msg"></p>
    </div>


        
<?php
    include_once("footer.php");
?>     