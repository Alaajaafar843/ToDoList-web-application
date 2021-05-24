<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>admin</title>
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
<main class="container" style="max-width:750px; padding-top:50px;">
<?php 
session_start();
require_once '../databaseConnection.php';
if(isset($_SESSION['user'])){
    if($_SESSION['user']->ROLE==="ADMIN"){
if(isset($_SESSION['userID'])){
    $useer = $database->prepare("SELECT * FROM Accounts WHERE ID = :id");
    $useer->bindParam("id",$_SESSION['userID']);
    $useer->execute();

    $useer = $useer->fetchObject();
    echo '<form action="" method="post">
    <div class="p3 shadow">Name:</div> 
    <input type="text" name="name" required value="'.$useer->NAME.'" class="form-control"> <br>
    <div class="p3 shadow">Age:</div>  
    <input type="date" name="age" required value="'.$useer->AGE.'" class="form-control"> <br>

    <button type="submit" name="update" value="'.$useer->ID.'" class=" w-100 btn btn-warning mt-1">Update</button> <br>

    <a href="index.php" class=" w-100 btn btn-light mt-1">Home</a>
</form>';
}
if(isset($_POST['update'])){
    $updateuser =  $database->prepare("UPDATE Accounts SET NAME = :name , AGE = :age WHERE ID =:id");
    $updateuser->bindParam("id",$_SESSION['userID']);
    $updateuser->bindParam("name",$_POST['name']);
    $updateuser->bindParam("age",$_POST['age']);
    $updateuser->execute();
    echo'<div class="alert alert-success mt-3">Updated successfully.</div>';
    header("refresh:2");
    
}
    
    }else {
        header("location:http://192.168.64.2/project/login.php",true);
        die("");
    }
}else {
    header("location:http://192.168.64.2/project/login.php",true);
    die("");
}
if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
    header("location:http://192.168.64.2/project/login.php",true);
}


?>
</main>
</body>
</html>
