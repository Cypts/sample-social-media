<link href="css/style.css" rel="stylesheet">
<style>
.notification-card {
    height: 70px;
    color: black;
    margin: 20px;
    background-color: rgb(239, 207, 160);
    width: 400px;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.notification-card h3 {
    margin: 0;
    font-size: 16px;
}

.notification-card form {
    display: flex;
    gap: 10px;
}

.notification-card button {
    padding: 5px 10px;
    border: none;
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
    border-radius: 3px;
    transition: background-color 0.3s ease;
}

.notification-card button:hover {
    background-color: #45a049;
}

.notification-card button[type="submit"]:last-child {
    background-color: #f44336;
}

.notification-card button[type="submit"]:last-child:hover {
    background-color: #d32f2f;
}
</style>

<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location:index.php");
    exit;
}

include "includes/config.php";
include "includes/header.html";

$uid = $_SESSION['userid'];

// Fetch pending friend requests
$sql = "SELECT * FROM friend_requests WHERE to_user_id = '$uid' AND status = 0";
$rs = mysqli_query($conn, $sql);

echo '<h1 style="color: black">Notifications</h1>';

while ($row = mysqli_fetch_array($rs)) {
    $id = $row['from_user_id'];
    $req_id = $row['id'];

    $sql2 = "SELECT name FROM users WHERE id = '$id'";
    $rs2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($rs2);

    if ($row2) {
        $name = htmlspecialchars($row2['name']);

        echo '<div class="notification-card">';
        echo '<h3>Request from ' . $name . '</h3>';
        echo '<form action="" method="POST">';
        echo '<input type="hidden" name="sender_id" value="' . $id . '">';
        echo '<input type="hidden" name="req_id" value="' . $req_id . '">';
        echo '<button type="submit" name="accept">Accept</button>';
        echo '<button type="submit" name="reject">Reject</button>';
        echo '</form>';
        echo '</div>';
    }
}

// Handle accept/reject after form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senderId = $_POST['sender_id'];

    if (isset($_POST['accept'])) {
        $updateSql = "UPDATE friend_requests SET status = 1 WHERE from_user_id = '$senderId' AND to_user_id = '$uid'";
        mysqli_query($conn, $updateSql);

        mysqli_query($conn, "INSERT INTO friends(user_id, friend_id) VALUES('$uid', '$senderId')");
        mysqli_query($conn, "INSERT INTO friends(user_id, friend_id) VALUES('$senderId', '$uid')");

        header("Location: notifications.php");
        exit;
    }

    if (isset($_POST['reject'])) {
        $updateSql = "UPDATE friend_requests SET status = 2 WHERE from_user_id = '$senderId' AND to_user_id = '$uid'";
        mysqli_query($conn, $updateSql);
        mysqli_query($conn, "DELETE FROM friend_requests WHERE from_user_id='$senderId' AND to_user_id='$uid'");

        header("Location: notifications.php");
        exit;
    }
}
?>
