<?php
// Verify Token set in the Facebook App Dashboard
$verify_token = 'ten@123456';
file_put_contents('webhooklog.txt', $_GET['hub_mode']);
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['hub_mode']) && $_GET['hub_mode'] === 'subscribe' && isset($_GET['hub_verify_token']) && $_GET['hub_verify_token'] === $verify_token) {
    // Respond with hub.challenge if verification is successful
    echo $_GET['hub_challenge'];
    http_response_code(200);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle incoming webhook events
    $data = file_get_contents('php://input');
    // Your code to process the incoming events goes here
    // For example, you can log the event data
    file_put_contents('response.txt', $data);
    http_response_code(200);
} else {
    // Invalid request method or verification failed
    http_response_code(400);
    echo "Invalid request";
}
