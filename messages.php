<link rel="stylesheet" href="css/style.css">
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .chatbox {
        position: absolute;
        width: 500px;
        background-color: #5e4f43;
        right: 0;
        top: 0;
        height: 100vh;
        display: flex;
        flex-direction: column;
        color: white;
        padding: 0;
        z-index: 1000;
    }

    .chat-header {
        background-color: #4a3e35;
        padding: 15px;
        font-size: 18px;
        font-weight: bold;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chat-messages {
        flex-grow: 1;
        padding: 20px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        background-color: #5e4f43;
    }

    .message {
        max-width: 70%;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 10px;
        position: relative;
        word-wrap: break-word;
        font-size: 14px;
    }

    .message.sent {
        align-self: flex-end;
        background-color: #a1c99a;
        color: black;
    }

    .message.received {
        align-self: flex-start;
        background-color: #ffffff;
        color: black;
    }

    .timestamp {
        font-size: 10px;
        color: black;
        margin-top: 5px;
        text-align: right;
    }

    .messageUser {
        display: flex;
        padding: 10px;
        background-color: #4a3e35;
    }

    .messageUser input[type="text"] {
        flex-grow: 1;
        padding: 10px;
        font-size: 14px;
        border: none;
        outline: none;
    }

    .messageUser input[type="submit"] {
        width: 80px;
        background-color: #2f2b27;
        color: white;
        border: none;
        font-size: 16px;
        cursor: pointer;
    }
</style>

<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: index.php");
}
include "includes/header.html";
include "includes/config.php";

$uid = $_SESSION['userid'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sendMessage'])) {
    $friendId = $_POST['id'];
    $m = $_POST['message'];
    mysqli_query($conn, "INSERT INTO messages(from_id,to_id,message) VALUE('$uid','$friendId','$m')");
    header("Location: messages.php?ok=1&friend_id=" . $friendId);
    exit();
}

echo '<h2 style="color: black">Messages</h2>';

$sql = "SELECT * FROM friends WHERE user_id='$uid'";
$rs = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($rs)) {
    $id = $row['friend_id'];
    $sql2 = "SELECT * FROM users WHERE id = '$id'";
    $rs2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($rs2);
    $name = $row2['name'];
    $username = $row2['username'];

    echo '<form action="" method="GET" class="friends-view-form">';
    echo '<input type="hidden" name="friend_id" value=' . $id . '>';
    echo '<button style="width:800px; height: 100%" type="submit" name="ok" value="1">';
    echo '<div style="width:100%; height: 100%"  class="friends-view">';
    echo '<img src="frappuccino.webp">';
    echo '<h3>Name: ' . htmlspecialchars($name) . '</h3>';
    echo '<h3>Username: ' . htmlspecialchars($username) . '</h3>';
    echo '</div>';
    echo '</button>';
    echo '</form>';
}

if (isset($_GET['ok'])) {
    $textUser = $_GET['friend_id'];

    echo '<div class="chatbox" id="chatbox">';
    echo '<div class="chat-header">';
    $getName = mysqli_query($conn, "SELECT name FROM users WHERE id='$textUser'");
    $getUser = mysqli_fetch_array($getName);
    echo '<span>' . htmlspecialchars($getUser['name']) . '</span>';
    echo '<button onclick="closeChatbox()" style="background:none;border:none;color:white;font-size:20px;">×</button>';
    echo '</div>';

    echo '<div class="chat-messages" id="chat-messages">';
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
    echo '</div>';

    echo '<form class="messageUser" action="" method="POST">';
    echo '<input type="text" name="message" placeholder="Type a message" required>';
    echo '<input type="hidden" name="id" value="' . $textUser . '">';
    echo '<input type="submit" name="sendMessage" value="Send">';
    echo '</form>';

    echo '</div>';
}
?>

<script>
function closeChatbox() {
    document.getElementById('chatbox').style.display = 'none';
}
window.onload = function () {
    const chat = document.getElementById('chat-messages');
    if (chat) {
        chat.scrollTop = chat.scrollHeight;
    }
};
</script>
