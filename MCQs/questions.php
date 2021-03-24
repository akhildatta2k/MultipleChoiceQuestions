<?php require "database.php" ?>
<?php
session_start();
if($_SESSION['loggedin']!=true){
    header("Location: login.php");
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

    <title>questions | MCQs</title>
    <style>
    .lstyle{
        list-style:none;
    }
    .mr-2 {
        margin-right: 4px;
    }
            
    .form-width {
        width: 60%;
    }
                @media only screen and (max-width: 990px) {
                .top-2 {
                    margin-top: 12px;
                }
                .form-width {
                    width: 100%;
                }
                .mr-2 {
                    margin-right: 0px;
                }
            }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">

                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="Images/Nav-Logo.jpg" alt="" width="30" height="24">
                    </a>
                    <button class="navbar-toggler float-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="welcome.php">
                                    <?php echo"Hello " . $_SESSION["name"];?>
                                </a>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="questions.php?page=1">
                                    question
                                </a>
                            </li>
                        </ul>

                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success text-light mr-2" type="submit">Search</button>
                        </form>
                        <a class="btn btn-outline-warning text-light mr-2 top-2" href="logout.php">Logout</a>

                    </div>

                </div>
            </nav>
  
  <div class="container">
  <?php 
                
                $limit = 5;
                $page=$_GET["page"];

                $offset=( $page - 1 )*$limit;
                $sql1="SELECT * FROM `questions`;";
                $sql2="SELECT * FROM `questions`LIMIT {$offset},{$limit};";
                $result = mysqli_query($conn,$sql1);
                $result1 = mysqli_query($conn,$sql2);
                $total_records = mysqli_num_rows($result);
                $counter = $offset+1;
                $total_pages = ceil($total_records/$limit);
                if(mysqli_num_rows($result1)>0){
                    while($row=mysqli_fetch_assoc($result1)){
                        echo '<h4>'.$counter.'.'.$row["question"].'</h4><br>
                        <ul class="lstyle">
                        <li><b>a.</b>'.$row["option_a"].'</li>
                        <li><b>b.</b>'.$row["option_b"].'</li>
                        <li><b>c.</b>'.$row["option_c"].'</li>
                        <li><b>d.</b>'.$row["option_d"].'</li>  
                        <li><b>ans.</b>'.$row["answer"].'</li>  
                        </ul>';
                        $counter++;
                    }
                }
                ?>

</div>
<div class="container justify-content-center">
<nav aria-label="Page navigation example">
  <ul class="pagination">
  <?php
    if($total_records>0){

        if($page>1){
            echo '<li class="page-item"><a class="page-link" href="questions.php?page='.($page-1).'">prev</a></li>';
        }
        for($i = 1; $i<=$total_pages;$i++){
            if($i == $page){
                $active = "active";
            }else{
                $active = "";
            }
            echo '<li class="'.$active.' page-item"><a class="page-link" href="questions.php?page='.$i.'">'.$i.'</a></li>';
        }
        if($page!=$total_pages){
            echo '<li class="page-item"><a class="page-link" href="questions.php?page='.($page+1).'">next</a></li>';
        }
    }else{
        echo '<h3 class="text-center text-danger">No Record Found</h3>';
    }
    ?>


  </ul>
</nav>
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