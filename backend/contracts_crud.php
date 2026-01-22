<?php

require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    
    switch($action) {
       
        case 'create':
           
            $content = $_POST['animal_preferences'] ?? '';
            $candidate = $_POST['candidate_id'] ?? '';
            
            $sql = 'INSERT INTO adoption_tickets (creation_date, animal_preferences, status, candidate_id)
                    VALUES ( now(), ?, nowe, ?)';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $content,$candidate);
            $stmt->execute();
            $stmt->close();
            echo json_encode(['success' => true, 'message' => 'Dodano']);
            break;
            
        default:
            echo json_encode(['success' => false, 'message' => 'Nieznana akcja']);
    }

    $conn->close();
    exit();
}

?>