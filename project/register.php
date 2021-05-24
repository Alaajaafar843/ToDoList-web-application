<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Registration</title>
</head>
<body>
<?php require_once'nav.php';?>
<main class="container">
<div class="container">
    <form action="" method="POST" class="mt-5">
    Name: <input type="text" name="name" class="form-control" required> <br>
    Age: <input type="date" name="age" class="form-control" required> <br>
    E-mail: <input type="email" name="email" class="form-control" required> <br>
    Password: <input type="password" name="password" class="form-control" required> <br>
    <button name="register" type="submit" class="btn btn-outline-primary w-100 mb-1"> Register</button>
    <a name="login" class="btn btn-outline-primary w-100" href="login.php">LOG IN</a>
    </form>
</div>
 
<?php

require_once 'databaseConnection.php';

    
    
    if(isset($_POST['register'])){
        $checkEmail = $database -> prepare("SELECT * FROM Accounts WHERE EMAIL = :email");
        $email = $_POST['email'];
        $checkEmail->bindParam("email",$email);
        $checkEmail ->execute();

        if($checkEmail->rowCount()>0){
            echo"<div class='alert alert-warning mt-3'>email already in use</div>";
        }
        else{
            $name = $_POST['name'];
            $age = $_POST['age'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $addUser = $database->prepare("insert into Accounts(NAME , AGE , EMAIL , PASSWORD , ROLE) VALUES(:NAME , :AGE , :EMAIL , :PASSWORD , 'USER')");
            $addUser->bindParam("NAME",$name);
            $addUser->bindParam("AGE",$age);
            $addUser->bindParam("PASSWORD",$password);
            $addUser->bindParam("EMAIL",$email);
            if($addUser->execute()){
                echo"<div class='alert alert-success'>SUCCESSFULL</div>";
                header("refresh:1;");
            }
            else{
                echo "<div class='alert alert-warning'>error</div>";
            }
        }
    }

?> 
</main>
</body>
</html>
