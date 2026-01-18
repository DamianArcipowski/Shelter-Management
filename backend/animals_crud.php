<?php

require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    
    switch($action) {
        case 'read':
            $result = $conn->query('SELECT * FROM animals');
            $data = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode(['success' => true, 'data' => $data]);
            break;
            
        case 'create':
            $name = $_POST['name'] ?? '';
            $species = $_POST['species'] ?? '';
            $arrival_date = $_POST['arrival_date'] ?? '';
            $loosebox = $_POST['loosebox'] ?? 0;
            $description = $_POST['description'] ?? '';
            $sex = $_POST['sex'] ?? '';
            $status = $_POST['status'] ?? '';
            
            $sql = 'INSERT INTO animals (name, species, arrival_date, loosebox, description, sex, status)
                    VALUES (?, ?, ?, ?, ?, ?, ?)';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssisss', $name, $species, $arrival_date, $loosebox, $description, $sex, $status);
            $stmt->execute();
            $stmt->close();
            echo json_encode(['success' => true, 'message' => 'Dodano']);
            break;
            
        case 'update':
            //Update logic todo
            echo json_encode(['success' => true, 'message' => 'Zaktualizowano']);
            break;
            
        case 'delete':
            $id = intval($_POST['id']) ?? 0;
            $stmt = $conn->prepare('DELETE FROM animals WHERE id = ?');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();
            echo json_encode(['success' => true, 'message' => 'Usunięto']);
            break;
            
        default:
            echo json_encode(['success' => false, 'message' => 'Nieznana akcja']);
    }

    $conn->close();
    exit();
}

?>