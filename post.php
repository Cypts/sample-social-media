<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: index.php");
    exit;
}

include "includes/config.php";
include "includes/header.html";

$uid = $_SESSION['userid'];
$error = '';
$success = '';

// Handle Post Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = trim($_POST['content']);
    $imagePath = NULL;

    if (empty($content)) {
        $error = "Post content cannot be empty.";
    } else {
        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
            if (in_array($_FILES['image']['type'], $allowedTypes)) {
                $targetDir = "uploads/";
                if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
                $imageName = time() . "_" . basename($_FILES['image']['name']);
                $targetFile = $targetDir . $imageName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $imagePath = $targetFile;
                } else {
                    $error = "Image upload failed.";
                }
            } else {
                $error = "Invalid image type.";
            }
        }

        // Insert into DB
        if (!$error) {
            $stmt = mysqli_prepare($conn, "INSERT INTO post (user_id, content, image) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "iss", $uid, $content, $imagePath);
            if (mysqli_stmt_execute($stmt)) {
                $success = "Post added successfully!";
            } else {
                $error = "Database error.";
            }
            mysqli_stmt_close($stmt);
        }
    }
}

// Fetch Posts
$posts = [];
$res = mysqli_query($conn, "SELECT * FROM post WHERE user_id='$uid' ORDER BY post_time DESC");
while ($row = mysqli_fetch_assoc($res)) {
    $posts[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Posts</title>
    <link href="css/style.css" rel="stylesheet">
    <style>
        .post-form {
            width: 70%;
            margin: 20px auto;
            background: #f2f2f2;
            padding: 20px;
            border-radius: 10px;
        }
        .post-form textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
        }
        .post-form input[type="submit"] {
            background: #39398b;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: medium;
        }
        .post-list {
            width: 70%;
            margin: 20px auto;
        }
        .post {
            background: #ddd;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 10px;
        }
        .post img {
            max-width: 100%;
            max-height: 400px;
            display: block;
            margin-top: 10px;
        }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body style="color: black">

<div class="post-form">
    <form action="" method="POST" enctype="multipart/form-data">
        <textarea name="content" placeholder="What's on your mind?"></textarea><br>
        <input type="file" name="image" accept="image/*"><br><br>
        <input type="submit" value="Post">
    </form>
    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php elseif ($success): ?>
        <p class="success"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>
</div>

<div class="post-list">
    <h2>Your Posts</h2>
    <?php foreach ($posts as $post): ?>
        <div class="post">
            <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
            <small>Posted on <?= date("d M Y H:i", strtotime($post['post_time'])) ?></small>
            <?php if ($post['image']): ?>
                <img src="<?= htmlspecialchars($post['image']) ?>" alt="Post Image">
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
