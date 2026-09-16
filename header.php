<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Library</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<header>
    <h2>Library Reservation System</h2>

    <nav>
        <?php if (!isset($_SESSION['account'])): ?>
            <a href="index.php">Home</a>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php else: ?>
            <a href="index.php">Home</a>
            <a href="search.php">Search Books</a>
            <a href="resbooks.php">My Reservations</a>
            <a href="logout.php">Logout</a>
        <?php endif; ?>
    </nav>
</header>
<div class="container">
