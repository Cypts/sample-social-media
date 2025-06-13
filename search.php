<link href="css/style.css" rel="stylesheet">
<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location:index.php");
    exit;
}
include "includes/config.php";
include "includes/header.html";

$uid = $_SESSION['userid'];
$searchHere = $_GET['search'] ?? '';
$searchHere = mysqli_real_escape_string($conn, $searchHere);

// Handle friend request form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['requestSend'])) {
    $friendId = intval($_POST['reqid']); // Sanitize input
    if ($friendId !== $uid) {
        $checkFriend = mysqli_query($conn, "SELECT * FROM friends WHERE user_id='$uid' AND friend_id='$friendId'");
        if (mysqli_num_rows($checkFriend) > 0) {
            // Remove friend
            mysqli_query($conn, "DELETE FROM friends WHERE user_id='$uid' AND friend_id='$friendId'");
            mysqli_query($conn, "DELETE FROM friends WHERE user_id='$friendId' AND friend_id='$uid'");
            echo '<script>alert("Friend removed."); window.location.href="search.php";</script>';
            exit;
        } else {
            // Check if request already sent
            $checkReq = mysqli_query($conn, "SELECT * FROM friend_requests WHERE from_user_id='$uid' AND to_user_id='$friendId' AND status=0");
            if (mysqli_num_rows($checkReq) === 0) {
                // Send request
                mysqli_query($conn, "INSERT INTO friend_requests (from_user_id, to_user_id, status) VALUES ('$uid', '$friendId', 0)");
                echo '<script>alert("Friend request sent!"); window.location.href="search.php";</script>';
                exit;
            } else {
                // Cancel request
                mysqli_query($conn, "DELETE FROM friend_requests WHERE from_user_id='$uid' AND to_user_id='$friendId' AND status=0");
                echo '<script>alert("Friend request canceled."); window.location.href="search.php";</script>';
                exit;
            }
        }
    }
}

// Search users excluding the current user
$sql = "SELECT * FROM users WHERE (username LIKE '%$searchHere%' OR name LIKE '%$searchHere%') AND id != '$uid'";
$rs = mysqli_query($conn, $sql);
?>

<!-- Search Bar -->
<form action="" method="GET" class="searchBar">
    <input type="text" name="search" placeholder="Search here" value="<?= htmlspecialchars($searchHere) ?>">
    <input type="submit" value="Search">
</form>

<!-- Search Results -->
<?php
while ($row = mysqli_fetch_array($rs)) {
    $userId = $row['id'];
    $name = htmlspecialchars($row['name']);
    $username = htmlspecialchars($row['username']);

    // Determine status: Remove / Pending / Request
    $status = "Request";
    $isFriend = mysqli_query($conn, "SELECT * FROM friends WHERE user_id='$uid' AND friend_id='$userId'");
    if (mysqli_num_rows($isFriend) > 0) {
        $status = "Remove";
    } else {
        $isPending = mysqli_query($conn, "SELECT * FROM friend_requests WHERE from_user_id='$uid' AND to_user_id='$userId' AND status=0");
        if (mysqli_num_rows($isPending) > 0) {
            $status = "Pending";
        }
    }

    echo '<div style="display: flex; width: 70%; justify-content: center; align-items: center; margin: 10px auto;">';

    // Profile View Button
    echo '<form action="profile-view.php" method="GET" style="flex-grow: 1;">';
    echo '<input type="hidden" name="viewProfile" value="' . $userId . '">';
    echo '<button type="submit" name="ok" value="1" style="width: 100%; height: 100%; border: none; background: none;">';
    echo '<div class="friends-view" style="display: flex; align-items: center; background-color: #f2f2f2; border-radius: 10px; padding: 10px;">';
    echo '<img src="frappuccino.webp" style="height: 70px; width: 70px; border-radius: 50%; margin-right: 15px;">';
    echo '<div>';
    echo '<h3>Name: ' . $name . '</h3>';
    echo '<h3>Username: ' . $username . '</h3>';
    echo '</div>';
    echo '</div>';
    echo '</button>';
    echo '</form>';

    // Friend Request / Remove Button
    echo '<form action="" method="POST" style="margin-left: 15px;">';
    echo '<input type="hidden" name="reqid" value="' . $userId . '">';
    echo '<button name="requestSend" value="1" style="background-color: #39398b; height: 70px; color: white; width: 100px; border: none; border-radius: 7px; font-weight: bold;">' . $status . '</button>';
    echo '</form>';

    echo '</div>';
}
?>
