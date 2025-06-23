<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location:index.php");
    exit;
}
include "includes/config.php";
$uid = $_SESSION['userid'];
$friendId = $_GET['id'];
$m = $_GET['message'];

mysqli_query($conn, "INSERT INTO messages(from_id,to_id,message) VALUE('$uid','$friendId','$m')");

$textUser=$friendId;
$getText = mysqli_query($conn, "SELECT * FROM messages 
                                    WHERE (from_id = '$textUser' AND to_id = '$uid') 
                                       OR (from_id = '$uid' AND to_id = '$textUser') 
                                    ORDER BY m_time");

    while ($messages = mysqli_fetch_array($getText)) {
        $isSent = $uid == $messages['from_id'];
        $msgClass = $isSent ? "sent" : "received";
        echo '<div class="message ' . $msgClass . '">';
        echo htmlspecialchars($messages['message']);
        echo '<div class="timestamp">' . $messages['m_time'] . '</div>';
        echo '</div>';
    }
exit();
?>