<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Log In</title>
</head>
<body>
<?php require_once'nav.php';?>

<main class="container">
<form action="" method="post" class="mt-5 ms-3 me-3">
    E-MAIL: <input type="email" name="email" class="form-control" required> <br>
    Password: <input type="password" name="password" class="form-control" required> <br>
    <button type="submit" name="login" class="btn btn-outline-primary w-100 mb-1">Log in</button>
    <a class="btn btn-outline-primary w-100" href="register.php">Register</a>
</form>
<?php 
    require_once 'databaseConnection.php';

    if(isset($_POST['login'])){
        $login = $database->prepare("SELECT * FROM Accounts WHERE EMAIL= :email AND PASSWORD= :password");
        $email = $_POST['email'];
        $password = $_POST['password'];
        $login->bindParam("email", $email);
        $login->bindParam("password",$password);
        $login->execute();
        if($login->rowCount()===1){
            $user = $login->fetchObject();
            session_start();
            $_SESSION['user']=$user;
            if($user->ROLE==="USER"){
                header("location:user/index.php",true);
            }
            elseif($user->ROLE==="ADMIN"){
                header("location:admin/index.php",true);
            }
            elseif ($user->ROLE==="SUPER-ADMIN") {
                header("location:super-admin/index.php",true);
            }
        }
        else{
            echo"<div class='alert alert-warning mt-3'>email or password is not correct</div>";
            header("refresh:1;");
        }
    }
?>  
</main>
</body>
</html>
