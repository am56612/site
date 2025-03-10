<?php
// API URL
$apiUrl = "https://api.genderize.io?name=alex";

// Initialize a cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $apiUrl);           // Set the URL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   // Return the result as a string
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);   // Follow any redirects automatically

// Execute the cURL session
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
} else {
    // Decode the JSON response
    $data = json_decode($response, true);

    // Display the result
    if ($data) {
        echo "Name: " . htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8') . "<br>";
        echo "Gender: " . htmlspecialchars($data['gender'], ENT_QUOTES, 'UTF-8') . "<br>";
        echo "Probability: " . htmlspecialchars($data['probability'], ENT_QUOTES, 'UTF-8') . "<br>";
        echo "Count: " . htmlspecialchars($data['count'], ENT_QUOTES, 'UTF-8') . "<br>";
    } else {
        echo "Failed to parse the API response.";
    }
}

// Close the cURL session
curl_close($ch);
?>
