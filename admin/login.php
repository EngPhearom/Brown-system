<?php
// connection db
include('./config/db.php');

// singup
if (isset($_POST['singup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conPassword = $_POST['conPassword'];

    // query mysql
    $sql = "INSERT INTO `admin`(`name`, `email`, `password`) 
            VALUES ('$username','$email','$password')";
    $result = $conn->query($sql);

    if ($result == false) {
        echo '<script>console.log(`Error`);</script>';
    }
    $conn->close();
    
    // username
    if ($username == "") {
        echo '<script>console.log("Please input username!!!");</script>';
    } else {
        $conditionUsername = '/^[a-zA-Z\s]{3,}+$/';
        if (!preg_match($conditionUsername, $username)) {
            echo '<script>console.log("Incorrect username");</script>';
        }
    }

    // email
    if ($email == "") {
        echo '<script>console.log("Please input email!!!");</script>';
    } else {
        $conditionEmail = '/^[0-9a-zA-Z\(\)\~_\-\.\$\+\*]+@[0-9a-zA-Z]+([\-\.]+[0-9a-zA-Z]+)*\.[0-9a-zA-Z]+([\-\.]+[0-9a-zA-Z]+)*$/';
        if (!preg_match($conditionEmail, $email)) {
            echo '<script>console.log("Incorrect email");</script>';
        }
    }

    // password
    if ($password == "") {
        echo '<script>console.log("Please input password!!");</script>';
    }elseif($password < 8){
        echo '<script>console.log("Password does not smaller 8");</script>';
    }else {
        $conditionPassword = '/^(?=.*[a-zA-Z0-9])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
        if (!preg_match($conditionPassword, $password)) {
            echo '<script>console.log("Incorrect password!!");</script>';
        }
    }

    // confirm password
    if ($conPassword == "") {
        echo '<script>console.log("Please input confirm password!!");</script>';
    } else {
        if ($conPassword != $password) {
            echo '<script>console.log("Please input confirm passsword is the same password");</script>';
        }
    }
}

// login
session_start();
if(isset($_POST['login'])){
    $Email = $_POST['email'];
    $Password = $_POST['password'];

    $mysql = "SELECT `id`, `name`, `email`, `password` FROM `admin` 
              WHERE email = '$Email' AND password = '$Password'";
    $results = $conn->query($mysql);
    $row = mysqli_num_rows($results);
    $count = mysqli_num_rows($results);
    $results->close();

    if($count == 1){
        $_SESSION['email'] = $Email;
        $_SESSION['password'] = $Password;
        header('location: components/admin.php');
    }elseif($Email == "" || $Password == ""){
        echo '<script>console.log(`Please input your email or password`);</script>';
    }else{
        echo '<script>console.log(`Email or Password is invalid`);</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="Style/main.css">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
    <div class="bg-form w-100 d-flex justify-content-center pt-5 d-block ">
        <div class="main border-5 rounded-2 mt-5">
            <input type="checkbox" id="switch" checked class="d-none">
            <div class="singup">
                <form action="" method="post" class="d-flex flex-column align-items-center">
                    <label for="switch" class="pb-2">Sing Up</label>
                    <input type="text" name="username" id="username" placeholder="Username" autocomplete="off">
                    <input type="email" name="email" id="email" placeholder="Email" autocomplete="off">
                    <input type="password" name="password" id="password" placeholder="Password" autocomplete="off">
                    <input type="password" name="conPassword" id="conPassword" placeholder="Confirm Password" autocomplete="off">
                    <button name="singup" id="btn-singup" class="text-white justify-content-center d-block fw-bold">Sing Up</button>
                </form>
            </div>
            <div class="login">
                <form action="" method="post" class="d-flex flex-column align-items-center">
                    <label for="switch" class="pb-3">Login</label>
                    <input type="email" name="email" id="email" placeholder="Email" autocomplete="off">
                    <input type="password" name="password" id="password" placeholder="Password" autocomplete="off">
                    <button name="login" id="btn-login" class="text-white fw-bold">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>

</html>