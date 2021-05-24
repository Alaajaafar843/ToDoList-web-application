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
        echo"
        <form method='post'>
            <a href='index.php' class=' w-100 btn btn-light mb-3'>Home</a>
            <input type='text' name='text' required class='form-control'>
            <button type='submit' name='add' class='btn btn-primary mb-3 mt-3 w-100'>Add</button>
        </form>";

        require_once '../databaseConnection.php';
 if(isset($_POST['add'])){

    $addItem=$database->prepare("INSERT INTO ToDoList (text, userID , status) VALUES (:text , :userID , 'UNDONE')");
    $addItem->bindParam('text',$_POST['text']);
    $userID = $_SESSION['user']->ID;
    $addItem->bindParam('userID',$userID);
    
    if($addItem->execute()){
        echo"<div class='alert alert-success' mt-3 mb-3>Added successfully</div>";
        header("refresh:2;");
    }

 }
    $toDoItems = $database->prepare("select * from ToDoList where userID = :id");
    $userID=$_SESSION['user']->ID;
    $toDoItems->bindParam('id',$userID);
    $toDoItems->execute();

    echo"<table class='table'>";
    echo"<tr>";
    echo"<th>TO DO</th>";
    echo"<th>status</th>";
    echo"<th>Delete</th>";
    echo"</tr>";
    
    foreach($toDoItems as $item){
        echo"<tr>";
        echo"<th>".$item['text']."</th>";
        if($item['status']==="UNDONE"){
            echo'<th>
                    <form>
                        <input type="hidden" name="statusvalue" value="'.$item['status'].'"/>
                        <button type="submit" class="btn btn-danger" name="status" value="'.$item['id'].'">Not done</button>
                    </form>
                </th>';
        }
        elseif($item['status']==="DONE"){
            echo'<th>
                    <form>
                        <input type="hidden" name="statusvalue" value="'.$item['status'].'"/>
                        <button type="submit" class="btn btn-success" name="status">Done</button>
                    </form>
                </th>';
        }
        
        echo'<th><form><button type="submit" class="btn btn-danger" name="delete" value="'.$item['id'].'">Delete</button></form></th>';
        echo"</tr>";
    }
    if(isset($_GET['status'])){
        if($_GET['statusvalue']==="UNDONE"){
            $changeuserstatus = $database->prepare("UPDATE ToDoList SET status='DONE' WHERE id=:id");
            $changeuserstatus->bindParam('id',$_GET['status']);
            $changeuserstatus->execute();
            header("location:todolist.php",true);
        }
        elseif ($_GET['statusvalue']==="DONE") {
            $changeuserstatus = $database->prepare("UPDATE ToDoList SET status='UNDONE' WHERE id=:id");
            $changeuserstatus->bindParam('id',$_GET['status']);
            $changeuserstatus->execute();
            header("location:todolist.php",true);
        }
    }

    if(isset($_GET['delete'])){
        $deleteToDo = $database->prepare("DELETE FROM ToDoList WHERE id = :id");
        $deleteToDo->bindParam('id', $_GET['delete']);
        $deleteToDo->execute();
        header("location:todolist.php",true);
    }

    echo"</table>";
    }
    
    else {
        header("location:http://192.168.64.2/project/login.php",true);
        die("");
    }
}
else {
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
