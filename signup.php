<?php
require('include/config.php');
$conn=mysqli_connect("localhost","root","", "chatrabash");
$msg="";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sign up - Chatrabash</title>
    <meta name="description" content="Online accommodation system for university students.Design by @Sazib.Gub">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dokdo&amp;display=swap">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <?php
    include('include/navbar.php');
    ?>
    <div>
        <?php
        session_start();
        if(isset($_SESSION['USER_ID'])){
            header("location:index.php");
        } else {
            if (isset($_POST['create'])) {
                $firstname      = $_POST['firstname'];
                $lastname       = $_POST['lastname'];
                $email          = $_POST['email'];
                $phonenumber    = $_POST['phonenumber'];
                $password       = sha1($_POST['password']);
                $sql=mysqli_query($conn,"select * from users where email='$email'");
                $num=mysqli_num_rows($sql);
                if ($num>0) {
                    $msg="This Email is already regestered in our server. Try another one. :-)";
                } else {        
                $sql = "INSERT INTO users (firstname, lastname, email, phonenumber, password) values (?,?,?,?,?)";
                $stmtinsert = $db->prepare($sql);
                $result = $stmtinsert->execute([$firstname, $lastname, $email, $phonenumber, $password]);
                if ($result) {
                    header('Location:login.php');
                } else {
                    echo "Something Is Wrong";
                }
                }
            }
            
        }



        ?>
    </div>
    <section class="py-5 mt-5">
        <div class="container profile profile-view" id="profile">
            <form action="signup.php" method="post">
                <div class="row profile-row">
                    <div class="col">
                        <h1>Welcome to Chatrabash</h1>
                        <div style="color:red;">
                            <?php
                            echo $msg;
                            ?>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3"><label class="form-label">Firstname </label>
                                    <input class="form-control form-control-sm" type="text" name="firstname" style="border-radius: 6px;" required="true">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3"><label class="form-label">Lastname </label>
                                    <input class="form-control form-control-sm" type="text" name="lastname" style="border-radius: 6px;" required="true">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3"><label class="form-label">Email </label>
                                    <input class="form-control form-control-sm" type="email" autocomplete="off" required="true" name="email" style="border-radius: 6px;">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3"><label class="form-label">Phone Number</label>
                                    <input class="form-control form-control-sm" type="phonenumber" name="phonenumber" style="border-radius: 6px;" required="true">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3"><label class="form-label">Password </label>
                                    <input class="form-control form-control-sm" type="password" name="password" id="password" required="true" style="border-radius: 6px;">
                                <div class="input-group-append">
                            </div>
                            <div style=" height: 10px;"> <p id="message" style="display: none;"> <b>Password is <span id="strength"></span></b>  </p>
                            </div>
                           </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col content-right">
                                <button class="btn btn-danger btn-sm form-btn" type="reset" style="border-radius: 6px;">CANCEL </button>
                                <input class="btn btn-primary btn-sm form-btn" type="submit" name="create" style="border-radius: 6px;margin-right: 0px;margin-left: 20px;margin-top: 5px;margin-bottom: 5px;" value="Sign up&nbsp;">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script>
        function password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
            
            var pass = document.getElementById("password");
            var msg = document.getElementById("message");
            var str = document.getElementById("strength");

            let alphabet = /[a-z,A-Z]/,
                numbers = /[0-9]/,
                scharacter = /[!,@,#,$,%,^,&,*,?,_,(,),-,+,=,~]/;

            pass.addEventListener('input', () => {
                if(pass.value.length > 0 ) {
                    msg.style.display = "block";

                }else{
                    msg.style.display = "none";

                }
                if(pass.value.match(alphabet) || pass.value.match(numbers) || pass.value.match(scharacter ) ) {
                    str.innerHTML = "Weak";
                    msg.style.color = "#FC1200";
                }
                if(pass.value.match(alphabet) && pass.value.match(numbers) && pass.value.length >= 6){
                    str.innerHTML = "Medium";
                    msg.style.color = "#F2BF2F";
                }
                if(pass.value.match(alphabet) && pass.value.match(numbers) && pass.value.match(scharacter) && pass.value.length >= 8){
                    str.innerHTML = "Strong";
                    msg.style.color = "#078E63";
                }

            })



    
    </script>
    <?php
    include('include/footer.php');
    ?>

    <!-- <script src="https://code.jquery.com/jquery-3.4.1."></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>-->
    <script src="assets/js/jquery.min.js"></script>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/ssmodern.js"></script>
    <script src="assets/js/all.js"></script>

</body>
</html>