<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
  <img src="photo2.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
    <a class="navbar-brand" href="#">
      TO DO LIST
    </a>
  </div>
</nav>
<main class="container" style="max-width:880px;">
<?php 
session_start();
if(isset($_SESSION['user'])){
    if($_SESSION['user']->ROLE==="ADMIN"){

    echo '<form action="" method="post">
    <div class="p3 shadow">Name:</div> 
    <input type="text" name="name" required value="'.$_SESSION["user"]->NAME.'" class="form-control"> <br>
    <div class="p3 shadow">Age:</div>  
    <input type="date" name="age" required value="'.$_SESSION["user"]->AGE.'" class="form-control"> <br>
    <div class="p3 shadow">Password:</div> 
    <input type="password" required value="'.$_SESSION["user"]->PASSWORD.'" name="password" class="form-control"> <br>

    <button type="submit" name="update" value="'.$_SESSION["user"]->ID.'" class=" w-100 btn btn-warning mt-1">Update</button> <br>

    <a href="index.php" class=" w-100 btn btn-light mt-1">Home</a>
</form>';
if(isset($_POST['update'])){
    require_once '../databaseConnection.php';

    $updateUserData = $database->prepare("UPDATE Accounts SET NAME= :name , PASSWORD=:password , AGE=:age WHERE ID=:id");


    $updateUserData->bindParam('name',$_POST['name']);
    $updateUserData->bindParam('password',$_POST['password']);
    $updateUserData->bindParam('age',$_POST['age']);
    $updateUserData->bindParam('id',$_POST['update']);

    if($updateUserData->execute()){
        echo"<div class='alert alert-success mt-3'>successfully updated</div>";
        $user = $database->prepare("SELECT * FROM Accounts WHERE ID=:id");
        $user->bindParam('id',$_POST['update']);
        $user->execute();
        $_SESSION['user'] = $user->fetchObject();
        header("refresh:1;");
    }
    else {
        echo"<div class='alert alert-alert mt-3'>something went wrong</div>";
    }

}
}
else {
    session_unset();
    session_destroy();
    header("location:http://192.168.64.2/project/login.php",true);
}
}
else {
    session_unset();
    session_destroy();
    header("location:http://192.168.64.2/project/login.php",true);
}
?>
</main>

</body>
</html>