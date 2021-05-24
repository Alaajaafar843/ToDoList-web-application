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
require_once '../databaseConnection.php';
if(isset($_SESSION['user'])){
    if($_SESSION['user']->ROLE==="ADMIN"){

    echo'
    <form action="" method="post">
        <a href="index.php" class=" w-100 btn btn-light mb-3 mt-3">Home</a>
        <input type="text" name="search" placeholder="search for ...." class="form-control">
        <button type="submit" name="searchbtn" class="btn btn-primary w-100 mt-3">search</button>
    
    </form>';

    if(isset($_POST['searchbtn'])){

        $searchforuser = $database->prepare("SELECT * FROM Accounts WHERE NAME LIKE :name OR EMAIL LIKE :email");
        $searchValue = $_POST['search'];
        $searchforuser->bindParam("name",$searchValue);
        $searchforuser->bindParam("email",$searchValue);
        $searchforuser->execute();

        echo'<table class="table mt-3">';
        echo'<tr>';
        echo'<td>Name</td>';
        echo'<td>Email</td>';
        echo'<td>Delete</td>';
        echo'<td>Update</td>';
        echo'</tr>';
        foreach($searchforuser as $result){
            echo'<tr>';
            echo'<td>'.$result['NAME'].'</td>';
            echo'<td>'.$result['EMAIL'].'</td>';
            echo'<td><form method="post"><button type="submit" name="delete" class="btn btn-danger" value="'.$result['ID'].'">Delete</button></form></td>';
            echo'<td><form method="post"><button type="submit" name="update" class="btn btn-primary" value="'.$result['ID'].'">Update</button></form></td>';
            echo'</tr>';
        }

        echo'</table>';
        
    }
    if(isset($_POST['delete'])){
        $deleteUseritems = $database->prepare("DELETE FROM ToDoList WHERE userID = :userid");
        $deleteUseritems->bindParam("userid",$_POST['delete']);
        $deleteUseritems->execute();

        $deleteUser = $database->prepare("DELETE FROM Accounts WHERE ID = :userid");
        $deleteUser->bindParam("userid",$_POST['delete']);
        if($deleteUser->execute()){
            echo'<div class="alert alert-info">removed successfully</div>';
            header("refresh:2; url=search.php");
        }
    }
    if(isset($_POST['update'])){
        $_SESSION['userID'] = $_POST['update'];
        header("location:updateUser.php");
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
