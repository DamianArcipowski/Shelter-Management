<?php
include_once("connection.php"); 

$action = $_POST['action'] ?? '';

    switch($action) {
case 'create':
    $stmt = $conn->prepare("SELECT id, first_name, surname, position FROM employees ORDER BY first_name, surname ASC");
    $stmt->execute();
    $result = $stmt->get_result();
    $employees = [];
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
    echo json_encode(['success' => true, 'data' => $employees]);
    $conn->close();
    exit();

case 'add_schedule':

    $start = $_POST['start_date'] ?? null;
    $end   = $_POST['finish_date'] ?? null;

    if (!$start || !$end || $start > $end || strtotime($start) < strtotime(date('Y-m-d'))) {
        echo json_encode(['success' => false, 'message' => 'Niepoprawne daty']);
        $conn->close();
        exit();
    }
    $stmt = $conn->prepare("
        SELECT 1 FROM schedule
        WHERE date_from <= ? AND date_to >= ?
        LIMIT 1
    ");
    $stmt->bind_param("ss", $end, $start);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Plan koliduje z innym planem']);
        $conn->close();
        exit();
    }
    $stmt = $conn->prepare("INSERT INTO schedule (date_from, date_to) VALUES (?, ?)");
    $stmt->bind_param("ss", $start, $end);
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Plan dodany pomyślnie']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Błąd bazy danych']);
    }
    break;

case 'add_task':

    $employee_id = $_POST['employee_id'] ?? null;
    $date        = $_POST['task_date'] ?? null;
    $opis        = $_POST['opis'] ?? null;

    $stmt = $conn->prepare("SELECT id FROM schedule WHERE date_from <= ? AND date_to >= ? LIMIT 1");
    $stmt->bind_param("ss", $date, $date);
    $stmt->execute();
    $result = $stmt->get_result();
    $schedule = $result->fetch_assoc();

    if (!$schedule) {
        echo json_encode(['success' => false, 'message' => 'Brak planu w tym dniu']);
        $conn->close();
        exit;
    }
    $schedule_id = $schedule['id'];

    $stmt = $conn->prepare("SELECT position FROM employees WHERE id = ?");
    $stmt->bind_param("i", $employee_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $employee = $result->fetch_assoc();
    if (!$employee) {
        echo json_encode(['success' => false, 'message' => 'Nie znaleziono pracownika']);
        $conn->close();
        exit;
    }
    $position = $employee['position'];

    $stmt = $conn->prepare("INSERT INTO scheduled_tasks (date, content, position, employee_id, schedule_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssii", $date, $opis, $position, $employee_id, $schedule_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Zadanie dodane pomyślnie']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Błąd bazy danych']);
    }
    break;

    case 'read_tasks':
    $stmt = $conn->prepare("
    SELECT st.id, e.first_name, e.surname, e.position, st.date, st.content AS opis
    FROM scheduled_tasks st 
    JOIN employees e ON st.employee_id = e.id 
    WHERE st.date > CURRENT_DATE
    ORDER BY st.date ASC;
    ");
    if($stmt->execute()){
    $result = $stmt->get_result();
    if($result && $result->num_rows > 0){
        $data = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        echo json_encode(['success' => true, 'data' => [], 'message' => 'Brak zadań']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Błąd bazy danych']);
}
break;
    
   case 'delete_task':
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM scheduled_tasks WHERE id = ?");
    $stmt->bind_param("i", $id);
    if($stmt->execute()){
        echo json_encode(['success'=>true, 'message'=>'Zadanie usunięte']);
    } else {
        echo json_encode(['success'=>false, 'message'=>'Błąd bazy danych']);
    }
    break;
}
$conn->close();
exit();
?>