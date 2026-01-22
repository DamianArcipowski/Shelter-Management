<?php
require_once("connection.php");

$action = $_POST['action'] ?? '';

if ($action === 'read') {
    $stmt = $conn->prepare("SELECT id, first_name, surname, position FROM employees ORDER BY first_name, surname ASC");
    $stmt->execute();
    $result = $stmt->get_result();
    $employees = [];
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
    echo json_encode(['success' => true, 'data' => $employees]);
    exit();
}

$conn->close();
exit();
?>