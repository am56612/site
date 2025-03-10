<?php
// API URL
$apiUrl = "https://api.genderize.io?name=alex";

// Send GET request to the API
$response = file_get_contents($apiUrl);

// Check if the request was successful
if ($response !== false) {
    // Decode the JSON response
    $data = json_decode($response, true);

    // Display the result
    echo "Name: " . $data['name'] . "<br>";
    echo "Gender: " . $data['gender'] . "<br>";
    echo "Probability: " . $data['probability'] . "<br>";
    echo "Count: " . $data['count'] . "<br>";
} else {
    echo "Failed to fetch data from the API.";
}
?>
