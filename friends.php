<link href="css/style.css" rel="stylesheet">
<?php 
session_start();
if(!isset($_SESSION['userid'])){
    header("Location:index.php");
}
include "includes/header.html";
include "includes/config.php";
echo '<h2 style="color: black">Friends List</h2>';
$uid=$_SESSION['userid'];
$sql="SELECT * from friends where user_id='$uid'";
$rs=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($rs)){
    $id=$row['friend_id'];
    $sql2 = "SELECT * FROM users WHERE id = '$id'";
    $rs2 = mysqli_query($conn, $sql2);
    $row2=mysqli_fetch_array($rs2);
    $name = $row2['name'];
    $username = $row2['username'];
    echo '<form action="profile-view.php" method="GET" class="friends-view-form">';
    echo '<input type="hidden" name="viewProfile" value='.$id.'>';
    echo ' <button style="width:100%; height: 100%" type="submit" name="ok" value="1">';
    echo '<div style="width:100%; height: 100%"  class="friends-view">';
    echo '<img src="frappuccino.webp">';
    echo '<h3>Name: ' . htmlspecialchars($name) . '</h3>';
    echo '<h3>Username: ' . htmlspecialchars($username) . '</h3>';;
    echo '</div>';
    echo '</button>';
    echo '</form>';

}
?>