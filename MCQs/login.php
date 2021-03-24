<?php include "database.php" ?>
<?php
if(isset($_POST['submit'])){

    $name=$_POST['name'];
    $password=$_POST['password'];
    $hash=md5($password);
    $sql="SELECT * FROM `authentication` WHERE `name`='$name' AND `password`='$hash';";
    $result=mysqli_query($conn,$sql) or die("Unable to Login");
    
    if(mysqli_num_rows($result)==1){
        while($row=mysqli_fetch_assoc($result)){
            session_start();
            $_SESSION["loggedin"]=true;
            $_SESSION["name"]=$row['name'];
            header("Location: http://localhost/MCQs/welcome.php" );
        }
    }else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Something went Wrong:</strong>Unable to Login...
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>login | MCQs</title>
    <style>
    .form-width{
        width: 400px;
        height: 332px;
}
    </style>
  </head>
  <body>
 
  <div class="container my-3 form-width border">
  <form action="login.php" method="post">
  <h3 class="text-center">Login As Admin</h3>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">User Name</label>
    <input type="text" name="name"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
      </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>