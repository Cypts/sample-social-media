<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location:index.php");
    exit;
}
include "includes/config.php";

$uid= $_SESSION['userid'];
    $friendId= file_get_contents("php://input");
    if ($friendId !== $uid) {
        $checkFriend = mysqli_query($conn, "SELECT * FROM friends WHERE user_id='$uid' AND friend_id='$friendId'");
        if (mysqli_num_rows($checkFriend) > 0) {

            mysqli_query($conn, "DELETE FROM friends WHERE user_id='$uid' AND friend_id='$friendId'");
            mysqli_query($conn, "DELETE FROM friends WHERE user_id='$friendId' AND friend_id='$uid'");
            echo "Request";
            exit;

        } else {

            $checkReq = mysqli_query($conn, "SELECT * FROM friend_requests WHERE from_user_id='$uid' AND to_user_id='$friendId' AND status=0");
            if (mysqli_num_rows($checkReq) === 0) {

                mysqli_query($conn, "INSERT INTO friend_requests (from_user_id, to_user_id, status) VALUES ('$uid', '$friendId', 0)");
                echo "Pending";
                exit;

            } else {

                mysqli_query($conn, "DELETE FROM friend_requests WHERE from_user_id='$uid' AND to_user_id='$friendId' AND status=0");
                echo "Request";
                exit;

            }
        }
    }


?>