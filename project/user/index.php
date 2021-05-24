<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>User</title>
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
if(isset($_SESSION['user'])){
    if($_SESSION['user']->ROLE==="USER"){
        echo"<div class='shadow p-3 mb-3 bg-body rounded'>Welcome ".$_SESSION['user']->NAME . "</div>";
        echo"<form method='get'><button type='submit' name='logout' class='btn btn-danger w-100'>Log out</button></form>";
        echo"<a href='profile.php' class='btn btn-light p-3 shadow w-100 mt-3'>Update user information</a>";
        echo"<a href='todolist.php' class='btn btn-light p-3 shadow w-100 p-3 mt-1'>To do list</a>";
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
