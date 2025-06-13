
<link href="css/style.css" rel="stylesheet">
<body >
    <div class="registration">
        <div class="nav-tabs">
            <a href="index.php" class="nav-button">Login</a>
            <a href="registration.php" class="nav-button active">Register</a>
        </div>

        <form action="" method="POST">
            <h1>Register</h1>
            <h3>Name</h3>
            <input type="text" name="name" placeholder="Enter your name">
            <h3>Username</h3>
            <input type="text" name="username" placeholder="Enter username">
            <h3>Email</h3>
            <input type="email" name="email" placeholder="Enter your email">
            <h3>Phone Number</h3>
            <input type="number" name="phoneNumber" placeholder="Enter your phone number">
            <h3>Password</h3>
            <input type="text" name="password" placeholder="Enter password">
            <h3>Confirm Password</h3>
            <input type="password" name="confPassword" placeholder="Confirm password">
            <button type="submit" value='1' name="register">Submit</button>
        </form>
    </div>
</body>
<?php 
    include "includes/config.php";
    if(isset($_POST['register'])){
        $name=$_POST['name'];
        $username=$_POST['username'];
        $email=$_POST['email'];
        $number=$_POST['phoneNumber'];
        $password=$_POST['password'];
        $confPassword=$_POST['confPassword'];
        if (strlen($password) < 8 || 
            !preg_match('/[A-Z]/', $password) || 
            !preg_match('/\d/', $password)) {
            echo '<script>alert("Password must be at least 8 characters and contain at least 1 uppercase letter and 1 number.");</script>';
            exit;
        }
        if ($password !== $confPassword) {
            echo '<script>alert("Passwords do not match.");</script>';
            exit;
        }
        $sql="SELECT * FROM users WHERE username='$username'";
        $rs=mysqli_query($conn,$sql);
        if(mysqli_num_rows($rs)>0){
            echo '<scrpit>alert("Same username found.<br>Enter another username")</script>';
            exit;
        }
        $sql="SELECT * FROM users WHERE email='$email'";
        if(mysqli_num_rows($rs)>0){
            echo '<scrpit>alert("Same email found.<br>Enter another email ")</script>';
            exit;
        }
        $rs=mysqli_query($conn,$sql);
        $sql="SELECT * FROM users WHERE phoneNumber='$number'";
        $rs=mysqli_query($conn,$sql);
        if(mysqli_num_rows($rs)>0){
            echo '<scrpit>alert("Same number found.<br>Enter another number ")</script>';
            exit;
        }
        $sql = "INSERT INTO users (name, username, email, phoneNumber, password) VALUES ('$name', '$username', '$email', '$number', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("Registration successful!"); window.location.href = "index.php";</script>';
        } else {
            echo '<script>alert("Error during registration. Please try again.");</script>';
        }
        }
?>