<?php
require '../instance.php';
$id = $_POST['id'];
$name = $_POST['name'];

// Обновление данных в базе данных
$sql = "UPDATE `groups` SET `name`='$name' WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    $response = array('success' => true);
} else {
    $response = array('success' => false, 'message' => 'Error updating user: ' . $conn->error);
}

$conn->close();

echo json_encode($response);
