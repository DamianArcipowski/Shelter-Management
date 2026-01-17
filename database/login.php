<?php

$username = $_POST['username'];
$password = $_POST['password'];

require_once '../database/connection.php';

$sql = 'SELECT password, position FROM employees WHERE login = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows == 0) {
    header('Location: ../index.php?user_exist=false');
    $conn->close();
    exit();
}

$row = $result->fetch_assoc();
if (password_verify($password, $row['password'])) {
    session_start();
    $_SESSION['signed_in'] = true;

    if ($row['position'] == 'pracownik_biurowy') {
        $_SESSION['role'] = 'pracownik_biurowy';
        header('Location: ../views/office_worker.php');
        $conn->close();
        exit();
    }
} else {
    header('Location: ../index.php?password_match=false');
    $conn->close();
    exit();
}

?>