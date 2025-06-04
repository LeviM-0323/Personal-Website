<?php
header('Content-Type: application/json');
echo json_encode([
    "status" => "online",
    "version" => "1.0.0",
    "message" => "Personal website is operational"
]);
?>