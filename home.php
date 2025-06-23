<link href="css/style.css" rel="stylesheet">
<style>
   .pagination{
    display: flex;
    justify-content: center;
    height: 40px;
    list-style-type: none;
    
} 
    .pagination li{
        min-width: 40px;
        background-color: brown;
        
        margin: 0 5px;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        
    }
    .pagination li a{
        text-decoration: none;
        color:white;
        font-size: larger;
        font-weight: bolder;
    }
</style>
<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: index.php");
}

include "includes/header.html";
include "includes/config.php";
echo '<h2 style="color: black">Home</h2>';
function timeAgo($times) {
   
  
    $time = new DateTime($times);
    $now = new DateTime();
    $diff = $now->diff($time);

   
    if ($diff->d > 0) {
        if($diff->d > 7) return $times;

        return $diff->d . ' day' . ($diff->d > 1 ? 's' : '') . ' ago';
    }
    if ($diff->h > 0) return $diff->h . ' hour' . ($diff->h > 1 ? 's' : '') . ' ago';
    if ($diff->i > 0) return $diff->i . ' minute' . ($diff->i > 1 ? 's' : '') . ' ago';
    return 'just now';
}


$uid = $_SESSION['userid'];
$now = new DateTime();
if(isset($_GET['page'])){
    $page=$_GET['page'];
}
else{
    $page=1;
}
$limit=5;

$sql2 = "SELECT p.content, p.post_time, u.name, u.username,u.id
        FROM post p
        JOIN users u ON p.user_id = u.id
        JOIN friends f ON f.user_id = '$uid' AND f.friend_id = u.id 
        WHERE f.friend_id IS NOT NULL
        ORDER BY p.post_time DESC";

$rs2 = mysqli_query($conn, $sql2);
$num= mysqli_num_rows($rs2);
$total_pages= ceil($num/$limit);
$offset=($page-1)*$limit;



$sql = "SELECT p.content, p.post_time, u.name, u.username,u.id
        FROM post p
        JOIN users u ON p.user_id = u.id
        JOIN friends f ON f.user_id = '$uid' AND f.friend_id = u.id 
        WHERE f.friend_id IS NOT NULL
        ORDER BY p.post_time DESC limit $offset, $limit";

$rs = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($rs)) {
    $content = $row['content'];
    $timee = $row['post_time'];
    $name = $row['name'];
    $username = $row['username'];
    $id = $row['id'];
    echo '<div class="post-view">';
    echo '<div>';
    echo '<p><a href="profile-view.php?viewProfile=' . $id . '">Name: ' . $name . '</a></p>';

    echo '<p>Username: ' . $username . '</p>';
    echo '</div>';
    echo '<h3>' . $content . '</h3>';
    echo '<p>' . timeAgo($timee, $now) . '</p>';
    echo '</div>';
}
?>
<ul class="pagination">
    <?php
    for($i = 1 ; $i <= $total_pages ; $i++)
    {
        echo '<li><a href=home.php?page='.$i.'>'.$i.'<a></li>';
    }
    ?>
</ul>