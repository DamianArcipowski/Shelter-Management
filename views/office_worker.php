<?php

session_start();
if (!isset($_SESSION['signed_in']) || $_SESSION['role'] != 'pracownik_biurowy') {
    header('Location: ../index.php?access=false');
    exit(); 
}
$currentPage = $_GET['page'] ?? 'animals';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Damian Arcipowki, Dawid Lewandowski">
    <title>Schronisko</title>
    <link rel="icon" type="image/x-icon" href="../images/paws.ico">
    <link rel="stylesheet" type="text/css" href="../css/views.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="../js/office_worker.js" defer></script>
</head>
<body>
    <div class="container">
        <nav class="nav-tabs">
    <a href="?page=schedule" class="nav-tab <?= ($currentPage === 'schedule') ? 'active' : '' ?>">Plan</a>
    <a href="?page=adoption" class="nav-tab <?= ($currentPage === 'adoption') ? 'active' : '' ?>">Adopcja</a>
    <a href="?page=animals"  class="nav-tab <?= ($currentPage === 'animals') ? 'active' : '' ?>">Zwierzęta</a>
    <a class="nav-tab logout-btn">Wyloguj</a>
</nav>
        <div class="content">
            <div class="layout">
               <?php include_once("../backend/pageloading.php"); ?>
            </div>
        </div>
    </div>
    <div class="footer">2026 | Damian Arcipowski & Dawid Lewandowski | All rights reserved &copy</div>
</body>
</html>