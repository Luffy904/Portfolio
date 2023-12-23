<?php

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    if (!empty($name) && !empty($email)) {
        $userData = [
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
            'timestamp' => date('Y-m-d H:i:s')
        ];

        $dataFilePath = 'user_data.json';

        // Read existing data
        $existingData = json_decode(file_get_contents($dataFilePath), true) ?? [];

        // Add new data
        $existingData[] = $userData;

        // Save data back to the file
        file_put_contents($dataFilePath, json_encode($existingData, JSON_PRETTY_PRINT));

        echo json_encode(['success' => true, 'message' => 'Data stored successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Name and Email are required']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
