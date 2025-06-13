<link href="css/style.css" rel="stylesheet">
<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: index.php");
}

include "includes/header.html";
include "includes/config.php";
echo '<h2 style="color: black">Home</h2>';
function timeAgo($timestamp, $now) {
    $time = new DateTime($timestamp);
    $diff = $now->diff($time);

    if ($diff->i < 1) {
        return "Just now";
    } elseif ($diff->i < 60) {
        return $diff->i . " minutes ago";
    } elseif ($diff->h < 24) {
        return $diff->h . " hours ago";
    } elseif ($diff->d < 30) {
        return $diff->d . " days ago";
    } else {
        return $time->format("d M Y");
    }
}

$uid = $_SESSION['userid'];
$now = new DateTime();


$sql = "SELECT p.content, p.post_time, u.name, u.username
        FROM post p
        JOIN users u ON p.user_id = u.id
        LEFT JOIN friends f ON f.user_id = '$uid' AND f.friend_id = u.id
        WHERE f.friend_id IS NOT NULL
        ORDER BY p.post_time DESC";

$rs = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($rs)) {
    $content = $row['content'];
    $timee = $row['post_time'];
    $name = $row['name'];
    $username = $row['username'];

    echo '<div class="post-view">';
    echo '<div>';
    echo '<p>Name: ' . $name . '</p>';
    echo '<p>Username: ' . $username . '</p>';
    echo '</div>';
    echo '<h3>' . $content . '</h3>';
    echo '<p>' . timeAgo($timee, $now) . '</p>';
    echo '</div>';
}
?>