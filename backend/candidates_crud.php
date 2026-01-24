<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';

switch($action){
    case 'add':
        $first_name = $_POST['first_name'];
        $surname = $_POST['surname'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $house_cond = $_POST['house_conditions'];
        $sex = $_POST['sex'];
        $stmt = $conn->prepare("INSERT INTO adoption_candidates(first_name, surname, address,email,phone_number,house_conditions,sex)
             VALUES (?,?,?,?,?,?,?)");
        $stmt -> bind_param('sssssss',$first_name,$surname,$address,$email,$phone_number,$house_cond,$sex);
        if($stmt->execute()) echo json_encode(['success' => true, 'message' => 'Dodano']);
        else echo json_encode(['success' => false, 'message' => 'Błąd bazy danych']);
        break;
    case 'loadSelect':
        $stmt = $conn->prepare("SELECT * FROM adoption_candidates");
        $stmt->execute();
        $result = $stmt->get_result();
        $candidates = [];
        while ($row = $result->fetch_assoc()) {
            $candidates[] = $row;
        }
        echo json_encode(['success' => true, 'data' => $candidates]);
        break;
        
    }

    $conn->close();
    exit();
 }

?>