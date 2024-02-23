<?php
require '../instance.php';
$id = $_POST['id'];
$sql = "SELECT * FROM `groups` WHERE `id` = '$id'";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

echo json_encode($data);
