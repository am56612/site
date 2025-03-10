<?php
// Check if the POST request contains a 'string' parameter
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['string'])) {
    // Retrieve the string from the POST request
    $receivedString = $_POST['string'];

    // Display the string
    echo "Received string: " . htmlspecialchars($receivedString, ENT_QUOTES, 'UTF-8');
} else {
    // Handle the case where the POST request doesn't contain the parameter
    echo "No string was sent in the POST request.";
}
?>
