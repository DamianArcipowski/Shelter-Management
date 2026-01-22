<?php

require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    
    switch($action) {
       
        case 'add':
             $content = $_POST['animal_preferences'] ?? '';
            $candidate = (int) $_POST['candidate_id'] ?? '';
            
            $sql = "INSERT INTO adoption_tickets (creation_date, animal_preferences, status, candidate_id)
                    VALUES ( now(), ?, 'nowe', ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $content,$candidate);
            if($stmt->execute()){
            $stmt->close();
            echo json_encode(['success' => true, 'message' => 'Dodano']);
            }else echo json_encode(['success' => false, 'message' => 'Blad bazy danych']);
            break;
        case 'read':
            $stmt = $conn->prepare("SELECT t.id, t.creation_date, t.animal_preferences, t.status, c.first_name, c.surname, t.animal_id FROM adoption_tickets AS t JOIN adoption_candidates AS c ON t.candidate_id = c.id ORDER BY t.creation_date DESC");
            if($stmt->execute()){
            $result = $stmt->get_result();
            $contracts = [];
            while ($row = $result->fetch_assoc()) {
                $contracts[] = $row;
            }
            echo json_encode(['success' => true, 'data' => $contracts]);
            }else echo json_encode(['success' => false, 'message' => 'Blad bazy danych']);
            break;
            
        default:
            echo json_encode(['success' => false, 'message' => 'Nieznana akcja']);
    }

    $conn->close();
    exit();
}

?>