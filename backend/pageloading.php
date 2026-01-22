<?php
    $pages = [
        'animals' => '../views/office_animals.php',
        'schedule' => '../views/schedule.php',
        'adoption'=> '../views/adoption.php',
    ];
    $page = $_GET['page'] ?? 'animals';
    $file = $pages[$page] ?? null;

    if($file && file_exists($file)) include($file);
    else echo '<p>Brak pliku strony</p>' ;
?>