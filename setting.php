<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: index.php");
    exit;
}
?>

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
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
        width: 70%;
        margin: 10px 0;
        padding: 5px;
        height: 80px;
        display: flex;
        justify-content: space-around;
        background-color: white;
        border-radius: 10px;
    }

    .user-friends h3 {
        margin: 0 10px;
    }

    .user-friends img {
        height: 70px;
        width: 70px;
        border-radius: 50%;
    }

    .post-view {
        width: 70%;
        background-color: #fff;
        margin: 10px 0;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.5);
    }

    .post-view h3 {
        margin: 0;
    }

    .post-view p {
        font-size: 0.9rem;
        color: #555;
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

<link href="css/style.css" rel="stylesheet">

<?php
include "includes/header.html";
include "includes/config.php";


$uid =  $_SESSION['userid'];
$Searchuid = $uid ;
$sql3 = "SELECT * FROM users WHERE id = '$Searchuid'";
$rs3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_array($rs3);

$name1 = $row3['name'];
$username1 = $row3['username'];
$bio = "bio";

?>

<body>
    <div class="elseProfile">
        <div class="image">
            <img src="frappuccino.webp" alt="Profile Picture">
            <div class="info">
                <h2>Username: <?php echo htmlspecialchars($username1); ?></h2>
                <h2>Name: <?php echo htmlspecialchars($name1); ?></h2>
            </div>
            <div class="edit">

                <button >edit</button>

        </div>
        </div>

        <div class="bio">
            <p><?php echo htmlspecialchars($bio); ?></p>
        </div>

        <div class="details">
            <a href="" class="friends-button">Posts</a>
            <a href="friends.php">Friends</a>
            <a href="">About</a>
        </div>

        <div style="display: flex; flex-direction: column; align-items: center;">
            <?php
            function timeAgo($timestamp) {
                $time = new DateTime($timestamp);
                $now = new DateTime();
                $diff = $now->diff($time);

                if ($diff->i < 1) return "Just now";
                if ($diff->i < 60) return $diff->i . " minutes ago";
                if ($diff->h < 24) return $diff->h . " hours ago";
                if ($diff->d < 30) return $diff->d . " days ago";
                return $time->format("d M Y");
            }

            $sql2 = "SELECT * FROM post WHERE user_id = '$Searchuid' ORDER BY post_time DESC";
            $rs2 = mysqli_query($conn, $sql2);

            while ($row2 = mysqli_fetch_array($rs2)) {
                $content = $row2['content'];
                $timestamp2 = $row2['post_time'];

                echo '<div class="post-view">';
                echo '<h3>' . htmlspecialchars($content) . '</h3>';
                echo '<p>' . timeAgo($timestamp2) . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>

