<?php

$make = $_GET['make'] ?? '';

if (!empty($make)) {
    
    include('./scripts/db_config.php');

    
    $sql = "SELECT DISTINCT model_samochodu FROM tranzakcje WHERE marka_samochodu = ?";
    
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $make);
    $stmt->execute();
    
    
    $result = $stmt->get_result();
    
    
    $models = [];
    while ($row = $result->fetch_assoc()) {
        $models[] = $row['model_samochodu'];
    }
    
    
    echo json_encode($models);
    
    
    $stmt->close();
    $conn->close();
} else {
    
    echo json_encode(['error' => 'Nie wybrano marki samochodu.']);
}
?>

