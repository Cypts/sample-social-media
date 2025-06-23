<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: index.php");
    exit;
}

include "includes/header.html";
include "includes/config.php";

$Searchuid = (int) $_GET['viewProfile'];
$uid = (int) $_SESSION['userid'];

// Fetch user profile data
$sql3 = "SELECT * FROM users WHERE id = '$Searchuid'";
$rs3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_array($rs3);

$name1 = $row3['name'];
$username1 = $row3['username'];
$bio = 'bio'; // Assuming a 'bio' column exists

// Check friendship status
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


?>

<link href="css/style.css" rel="stylesheet">
<style>
    .elseProfile {
        margin-top: 70px;
        padding: 20px;
        width: 70%;
        background-color: #614e41;
    }

    .image {
        padding: 10px;
        width: 100%;
        height: 350px;
        display: flex;
        align-items: center;
    }

    .image img {
        height: 300px;
        width: 300px;
        border-radius: 150px;
        margin: 0 20px;
    }

    .image .info {
        width: 50%;
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
    }

    .details a {
        text-decoration: none;
        color: white;
        font-size: larger;
        font-weight: bold;
    }

    .edit button {
        background-color: rgb(4, 15, 98);
        height: 80px;
        width: 150px;
        text-decoration: none;
        color: white;
        font-size: larger;
        font-weight: bold;
        cursor: pointer;
    }

    .edit {
        height: 100%;
        width: auto;
    }

    .user-friends {
        border: none;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
        width: 500px;
        margin: 10px 0;
        padding: 5px;
        height: 80px;
        display: flex;
        justify-content: space-around;
        align-items: center;
        border-radius: 10px;
        transition: background 0.3s ease;
    }

    .user-friends:hover {
        background-color: #e0d4c7;
    }

    .user-friends h3 {
        border: none;
        margin: 0 10px;
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

<body>
    <div class="elseProfile">
        <div class="image">
            <img src="frappuccino.webp" alt="Profile Picture">
            <div class="info">
                <h2>Username: <?php echo htmlspecialchars($username1); ?></h2>
                <h2>Name: <?php echo htmlspecialchars($name1); ?></h2>
            </div>
            <div class="edit">
                <button id="reqbutton" onclick ="sendreq(<?php echo $Searchuid ?>);" name="friendAction" type="submit"><?= $friendStatus ?></button>
        </div>
        </div>

        <div class="bio">
            <p><?php echo htmlspecialchars($bio); ?></p>
        </div>

        <div class="details">
            <a href="profile-view.php?viewProfile=<?php echo urlencode($Searchuid); ?>">Posts</a>
            <a href="profile-friend.php?viewProfile=<?php echo urlencode($Searchuid); ?>" class="friends-button">Friends</a>
            <a href="profile-about.php?viewProfile=<?php echo urlencode($Searchuid); ?>">About</a>
        </div>

        <div class="posts"></div>

        <div style="display: flex; flex-direction: column;
        align-items: center;
        justify-content: center;">
            <?php
            $sql = "SELECT f.friend_id, u.name, u.username
                    FROM friends f
                    JOIN users u ON f.friend_id = u.id
                    WHERE f.user_id = '$Searchuid'";
            $rs = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($rs)) {
                $fid = $row['friend_id'];
                $fname = $row['name'];
                $fusername = $row['username'];

                echo '<a href="profile-view.php?viewProfile=' . urlencode($fid) . '" style="text-decoration: none; color: inherit;">';
                echo '<div class="user-friends">';
                echo '<img src="frappuccino.webp" alt="Friend Image">';
                echo '<h3>Name: ' . htmlspecialchars($fname) . '</h3>';
                echo '<h3>Username: ' . htmlspecialchars($fusername) . '</h3>';
                echo '</div>';
                echo '</a>';
            }
            ?>
        </div>
    </div>
</body>
<script>
    function sendreq(id){
        const xttp = new XMLHttpRequest();
        xttp.onload=function (){
           document.getElementById("reqbutton").innerHTML=this.responseText;
        }
        xttp.open("POST","sendRequest.php");
        xttp.send(id);
    }
</script>
