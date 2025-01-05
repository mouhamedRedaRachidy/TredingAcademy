<?php 
require_once "conecte.php";

$username=$password=$confirm_password="";
$succ_msg=$err_msg="";
$username_err=$password_err=$confirm_password_err="";
$error=false;

if($_SERVER['REQUEST_METHOD'] == "POST"){
   



        if(empty(trim($_POST['username']))){
            $username_err="Please enter a username.";
            $error=true;
        }elseif(! preg_match('/^[a-zA-Z0-9_]+$/',trim($_POST['username']))){
            $username_err="Username can only contain letters, numbers, and underscores.";
            $error=true;
        }else{
            $sql="SELECT * FROM users where username=?";
            $stmt=mysqli_prepare($con,$sql);
            if ($stmt) {
                
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                $param_username = trim($_POST['username']);
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    
                    if (mysqli_stmt_num_rows($stmt) > 0) {
                        $username_err = "This username is already taken.";
                        $error = true;
                    } else {
                        $username = trim($_POST['username']);
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
                mysqli_stmt_close($stmt);
            }
        }
    




    
        if(empty(trim($_POST['password']))){
            $password_err="Please enter a password.";
            $error=true;
        }elseif(strlen(trim($_POST['password']))<6){
            $password_err="Password must have atleast 6 characters.";
            $error=true;
        }else{
            $password=trim($_POST['password']);
        }
    
    
        if(empty(trim($_POST['confirm_password']))){
            $confirm_password_err="Please confirm password.";
            $error=true;
        }else{
            $confirm_password=trim($_POST['confirm_password']);
            if(empty($password_err) && $password!=$confirm_password){
                $confirm_password_err = "Password did not match.";
            }
        }

        if(!$error){
            $sql="INSERT INTO users (username,password) VALUES(?,?)";
            $stmt=mysqli_prepare($con,$sql);

            if($stmt){
                $param_password=password_hash($password,PASSWORD_DEFAULT);
                $param_username=$username;
                
                mysqli_stmt_bind_param($stmt,"ss",$param_username,$param_password);

                if(mysqli_stmt_execute($stmt)){
                    $succ_msg="Registration successful. Pleas login <a href='login.php'>Login</a>";

                }else{
                    $err_msg="Ghyrha";
                }
                mysqli_stmt_close($stmt);
            }
        }
    }






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
        crossorigin="anonymous" referrerpolicy="no-referrer"
    />

    <link rel="stylesheet" href="singup.css">
    <title>Document</title>
</head>
<body>
    <?php include "nav.php" ?>
    <div class="containerr">
        <h1>Sing Up</h1>
        <?php 
            if($succ_msg){?>
                <div class="alert alert-success"><?= $succ_msg ?></div>

          <?php   }
          elseif($err_msg){?>
            <div class="alert alert-danger"><?= $err_msg ?></div>
        
        <?php } ?>
        <div class="form-container">
        
            <div class="form">
                
                <form action="" method="post">
                    
                    <div class="inpu">
                        <div class="row">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" value="<?= $username?>" name="username" class="inpSty" placeholder="Entrer UserName">
                        
                        </div>
                    </div>
                    <div class="text-danger"><?=$username_err ?></div>
                    <div class="inpu">
                        <div class="row">
                        <i class="fa-solid fa-key"></i>
                        <input type="password" name="password" class="inpSty" placeholder="Entrer Password">
                        </div>
                    </div>
                    <div class="text-danger"><?=$password_err ?></div>
                    <div class="inpu">
                        <div class="row">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="confirm_password" class="inpSty" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="text-danger"><?=$confirm_password_err ?></div>
                    <div class="group-btn">
                        <div class="systym">
                            <input type="submit" class="btn btn-success" name="register" value="Save">
                            <div class="al"> <span>Already Have An Account</span><a href="login.php" class="lienLog">Login</a></div>
                        </div>
                        
                    </div>
                    
                </form>
            </div>
        </div>
        
    </div>
</body>
</html>