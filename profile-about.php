<link href="css/style.css" rel="stylesheet">
<style>
.elseProfile {
    margin-top: 70px;
    padding: 20px;
    width: 70%;
    background-color: #614e41;
    margin-left: auto;
    margin-right: auto;
    border-radius: 10px;
}

.image {
    padding: 10px;
    width: 100%;
    height: 350px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.image img {
    height: 300px;
    width: 300px;
    border-radius: 150px;
    margin-right: 20px;
}

.image .info {
    flex-grow: 1;
    color: white;
}

.bio {
    margin: 20px 0;
    width: 100%;
    height: auto;
    padding: 10px;
    color: white;
}

.details {
    display: flex;
    align-items: center;
    justify-content: space-around;
    width: 100%;
    height: 40px;
    margin-top: 10px;
}

.details a {
    text-decoration: none;
    color: white;
    font-size: larger;
    font-weight: bold;
}

.edit button {
    background-color: rgb(4, 15, 98);
    height: 40px;
    width: 120px;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.user-friends {
    box-shadow: 0 0 10px rgba(0,0,0,0.8);
    width: 70%;
    margin: 10px auto;
    padding: 10px;
    display: flex;
    justify-content: space-around;
    background-color: white;
    border-radius: 5px;
}

.user-friends img {
    height: 70px;
    width: 70px;
    border-radius: 50%;
}
.details{
        width: 100%;
        margin-bottom : 20px ;
        border-bottom: solid;
        height: 50px
    }
     .friends-button{
        background-color: white;
        
        color: black !important;
        text-align: center;
        height: 100%;
        padding: 15px;
    }
    .details a{
        width: 33%;
        text-align: center;
    }
</style>

<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location:index.php");
    exit;
}

include "includes/header.html";
include "includes/config.php";

$Searchuid = $_GET['viewProfile'];
$uid = $_SESSION['userid'];

$sql3 = "SELECT * FROM users WHERE id = '$Searchuid'";
$rs3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_array($rs3);

$name1 = $row3['name'];
$username1 = $row3['username'];

$sqlFriend = "SELECT * FROM friends WHERE user_id='$uid' AND friend_id='$Searchuid'";
$rsFriend = mysqli_query($conn, $sqlFriend);

if (mysqli_num_rows($rsFriend) > 0) {
    $friendStatus = "Remove";
} else {
    $sqlRequest = "SELECT * FROM friend_requests WHERE from_user_id='$uid' AND to_user_id='$Searchuid' AND status=0";
    $rsRequest = mysqli_query($conn, $sqlRequest);
    
    if (mysqli_num_rows($rsRequest) > 0) {
        $friendStatus = "Pending";
    } else {
        $friendStatus = "Request";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['friendAction'])) {
    if ($friendStatus === "Remove") {
        mysqli_query($conn, "DELETE FROM friends WHERE user_id='$uid' AND friend_id='$Searchuid'");
        mysqli_query($conn, "DELETE FROM friends WHERE user_id='$Searchuid' AND friend_id='$uid'");
        echo '<script>alert("Friend Removed"); window.location.href="profile-view.php?viewProfile='.$Searchuid.'";</script>';
        exit;
    } elseif ($friendStatus === "Request") {
        mysqli_query($conn, "INSERT INTO friend_requests (from_user_id, to_user_id, status) VALUES ('$uid', '$Searchuid', 0)");
        echo '<script>alert("Friend Request Sent!"); window.location.href="profile-view.php?viewProfile='.$Searchuid.'";</script>';
        exit;
    } elseif ($friendStatus === "Pending") {
        mysqli_query($conn, "DELETE FROM friend_requests WHERE from_user_id='$uid' AND to_user_id='$Searchuid'");
        echo '<script>alert("Friend Request Canceled!"); window.location.href="profile-view.php?viewProfile='.$Searchuid.'";</script>';
        exit;
    }
}
?>

<body>
<div class="elseProfile">
    <div class="image">
        <img src="frappuccino.webp" alt="Profile Image">
        <div class="info">
            <h2>Username: <?= htmlspecialchars($username1) ?></h2>
            <h2>Name: <?= htmlspecialchars($name1) ?></h2>
        </div>
        <div class="edit">
            <form action="" method="POST">
                <button name="friendAction" type="submit"><?= $friendStatus ?></button>
            </form>
        </div>
    </div>

    <div class="bio">
        <p>bio</p>
    </div>

    <div class="details">
        <a href="profile-view.php?viewProfile=<?= urlencode($Searchuid) ?> " >Posts</a>
        <a href="profile-friend.php?viewProfile=<?= urlencode($Searchuid) ?>">Friends</a>
        <a href="profile-about.php?viewProfile=<?= urlencode($Searchuid) ?>" class="friends-button">About</a>
    </div>
</div>
</body>
