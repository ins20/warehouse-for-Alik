<?php
require '../instance.php';

// Получаем данные из POST-запроса
$name = $_POST['name'];

$sql = "INSERT INTO `groups`(`name`) VALUES ('$name')";

if ($conn->query($sql) === TRUE) {
    $response = array('success' => true);
} else {
    $response = array('success' => false, 'message' => $conn->error);
}

$conn->close();

echo json_encode($response);
