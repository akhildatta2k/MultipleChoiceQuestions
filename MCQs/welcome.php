<?php include "database.php" ?>
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

        <title>Welcome | <?php echo $_SESSION["name"] ?></title>
        <style>
            .mr-2 {
                margin-right: 4px;
            }
            
            .form-width {
                width: 60%;
            }
            .lstyle{
                list-style:none
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
                                <a class="nav-link active" aria-current="page" href="welcome.php">
                                    <?php echo"Hello " . $_SESSION["name"];?>
                                </a>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="questions.php?page=1">
                                    question
                                </a>
                            </li>
                        </ul>

                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success text-light mr-2" type="submit">Search</button>
                        </form>
                        <a class="btn btn-outline-warning text-light mr-2 top-2" href="logout.php">Logout</a>
                        <button type="button" class="btn btn-outline-info top-2" data-bs-toggle="modal" data-bs-target="#InsertModal">
                    Add A User
                </button>
                    </div>

                </div>
            </nav>
            

<!-- Button trigger modal -->
            <!-- Modal -->
            <?php
                    if(isset($_POST['submit'])){
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $c_password = $_POST['c_password'];
                        $hash = md5($password);
                        if($password == $c_password){
                            $sql="INSERT INTO `authentication` (`name`, `email`, `password`) VALUES ('$name', '$email', '$hash');";
                            mysqli_query($conn,$sql);
                            echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            <strong>Success:</strong>User inserted successfully...
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        }
                    }
                ?>
            <div class="modal fade" id="InsertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Insert A New User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="welcome.php" method="post">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                    <input type="name" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                                    <input type="password" name="c_password" class="form-control" id="exampleInputPassword1" required>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </form>

                        </div>
                    </div>




                </div>
            </div>
                    <?php
                    if(isset($_POST['q-submit'])){
                        $Question = $_POST['Question'];
                        $Option_a = $_POST['Option_a'];
                        $Option_b = $_POST['Option_b'];
                        $Option_c = $_POST['Option_c'];
                        $Option_d = $_POST['Option_d'];
                        $answer = $_POST['answer'];
                        $subject = $_POST['subject'];

                        $sql="INSERT INTO `questions` (`question`, `option_a`, `option_b`, `option_c`, `option_d`, `answer`, `catagory`) VALUES ('$Question', '$Option_a', '$Option_b', '$Option_c', '$Option_d', '$answer', '$subject');";
                        mysqli_query($conn,$sql);
                        echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        <strong>Success:</strong>question inserted successfully...
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    }
                ?>
                <div class="container form-width">
                        
                        <h3 class="text-center mt-3">Insert A Question </h3>
                        <form action="welcome.php" method="post">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Question</label>
                                <input type="text" name="Question" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Option A</label>
                                <input type="text" name="Option_a" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Option B</label>
                                <input type="Text" name="Option_b" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Option C</label>
                                <input type="text" name="Option_c" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Option D</label>
                                <input type="text" name="Option_d" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Subject</label>
                                <input type="text" name="subject" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Answer</label>
                                <input type="text" name="answer" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <button type="q-submit" name="q-submit" class="btn btn-primary">Submit</button>
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