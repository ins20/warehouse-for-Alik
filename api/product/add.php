<?php
require '../instance.php';

// Получаем данные из POST-запроса
$name = $_POST['name'];
$brand = $_POST['brand'];
$group_id = $_POST['group_id'];
$cost = $_POST['cost'];

$sql = "INSERT INTO `products`( `name`, `group_id`, `brand`, `cost`) VALUES ('$name','$group_id','$brand','$cost')";

if ($conn->query($sql) === TRUE) {
    $response = array('success' => true);
} else {
    $response = array('success' => false, 'message' => $conn->error);
}

$conn->close();

echo json_encode($response);
