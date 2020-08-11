<?php
session_start();
?>

<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color: <?= $_SESSION['color']; ?>">
<div class="container">
    <h1>Your Profile</h1>
    <h3>First Name: <?= $_SESSION['fname']; ?></h3>
    <h3>Second Name: <?= $_SESSION['sname']; ?></h3>
    <h3>Gender: <?= $_SESSION['gender']; ?></h3>
    <h3>D.O.B: <?= $_SESSION['dob']; ?></h3>
    <h3>Email: <?= $_SESSION['email']; ?></h3>
    <h3>Department: <?= $_SESSION['department']; ?></h3>

    <div class="form-btn">
        <button class="submit-btn"><a href="index.php">Home</a></button>
    </div>
</div>
</body>
</html>
