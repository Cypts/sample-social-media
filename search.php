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



$sql = "SELECT * FROM users WHERE (username LIKE '%$searchHere%' OR name LIKE '%$searchHere%') AND id != '$uid'";
$rs = mysqli_query($conn, $sql);
?>


<form action="" method="GET" class="searchBar">
    <input type="text" name="search" placeholder="Search here" value="<?= htmlspecialchars($searchHere) ?>">
    <input type="submit" value="Search">
</form>

<?php
function getStatus($id, $conn,$uid){
    $status = "Request";
    $isFriend = mysqli_query($conn, "SELECT * FROM friends WHERE user_id='$uid' AND friend_id='$id'");
    if (mysqli_num_rows($isFriend) > 0) {
        $status = "Remove";
    } else {
        $isPending = mysqli_query($conn, "SELECT * FROM friend_requests WHERE from_user_id='$uid' AND to_user_id='$id' AND status=0");
        if (mysqli_num_rows($isPending) > 0) {
            $status = "Pending";
        }
    }
    return $status;

}
while ($row = mysqli_fetch_array($rs)) {
    $userId = $row['id'];
    $name = htmlspecialchars($row['name']);
    $username = htmlspecialchars($row['username']);


    

    echo '<div style="display: flex; width: 70%; justify-content: center; align-items: center; margin: 10px auto;">';


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
    $status = getStatus($userId, $conn,$uid);
    echo '<div style="margin-left: 15px;">';
    echo '<button id="reqbutton'.$userId.'" onclick="sendreq('.$userId.');" value="1" style="background-color: #39398b; height: 70px; color: white; width: 100px; border: none; border-radius: 7px; font-weight: bold;">' .$status. '</button>';
    echo '</div>';

    echo '</div>';
}
?>

<script>
    function sendreq(id){
        alert("sed");
        const xttp = new XMLHttpRequest();
        xttp.onload=function (){
           document.getElementById("reqbutton"+id).innerHTML=this.responseText;
        }
        xttp.open("POST","sendRequest.php");
        xttp.send(id);
    }
</script>
