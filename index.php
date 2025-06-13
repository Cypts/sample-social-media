<?php 
session_start();
?>
<style>
    .registration{
        height: 500px;
        width: 400px !important;
    }
</style>
<link href="css/style.css" rel="stylesheet">
<body>
    <div class="registration">
        <div class="nav-tabs">
            <a href="index.php" class="nav-button active">Login</a>
            <a href="registration.php" class="nav-button ">Register</a>
        </div>

        <form action="" method="POST">
            <h1>Login</h1>
            <h3>Enter username</h3>
            <input name="username" type="text" placeholder="Enter username or email or phone number">
            <h3>Enter Password</h3>
            <input name="password" type="password" placeholder="Enter Password">
            <button type="submit" value="1" name="login">Submit</button>
        </form>
    </div>
</body >
<?php
    include "includes/config.php";
    
    if(isset($_POST['login'])){
        $id = $_POST['username'];
        $password= $_POST['password'];
        $sql="select * from users where username LIKE '$id' or email LIKE '$id' or phoneNumber LIKE '$id'; ";
        $rs=mysqli_query($conn,$sql);
        if(mysqli_num_rows($rs)==0){
            echo '<script>alert("No user found")</script>';
            exit;
        }
        else{
            $row=mysqli_fetch_array($rs);
            if($password==$row['password']){
                $_SESSION['userid']=$row['id'];
                header("Location:home.php");
            }
            else{
                echo '<script>alert("Wrong password")</script>';
            }
        }
    }

?>
