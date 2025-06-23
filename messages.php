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
    echo "<script>
    setInterval(function() {
        getMessage($textUser);
    }, 500);
</script>";
    echo '</div>';

    echo '<div class="messageUser">';
    echo '<input type="text" id="message" placeholder="Type a message" required>';
    echo '<button onclick="sendMessage('.$textUser.');" >send</button>';
    echo '</div>';

    echo '</div>';
}
?>

<script>

window.onload = function () {
    

};
function closeChatbox() {
    document.getElementById('chatbox').style.display = 'none';
}
function sendMessage(id){
    var messageToSend= document.getElementById("message").value;
    const xttp = new XMLHttpRequest();
    xttp.onload=function (){
        document.getElementById("chat-messages").innerHTML=this.responseText;
        const chat = document.getElementById('chat-messages');
    chat.scrollTop = chat.scrollHeight;
    }
    xttp.open("GET","sendMessage.php?id=" + encodeURIComponent(id) + "&message=" + encodeURIComponent(messageToSend));
    xttp.send();
}
function getMessage(id){
   const xttp = new XMLHttpRequest();
   xttp.onload=function (){
        document.getElementById("chat-messages").innerHTML=this.responseText;
        const chat = document.getElementById('chat-messages');
        chat.scrollTop = chat.scrollHeight;
    }
    xttp.open("GET","getMessage.php?id="+encodeURIComponent(id));
    xttp.send();

}
</script>
