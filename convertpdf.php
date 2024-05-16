<?php

require 'tcpdf/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

// Initialize HTTP client
$client = new Client();

// API URL
$url = "https://rest.apitemplate.io/v2/create-pdf?template_id=71877b234e09959a";

// Payload data
$payload = [
    'name' => "Educish",
    // Add other payload data if required
];

// Set headers
$headers = [
    'X-API-KEY' => '4052MTk0NDk6MTY1NTE6UDgxQWVSRTRTRVZQZnVjRw=',
    'Content-Type' => 'application/json',
];

try {
    // Make the POST request
    $response = $client->post($url, [
        'json' => $payload,
        'headers' => $headers,
    ]);

    // Print the response
    $responseJson = $response->getBody();
    //echo $responseJson; // Uncomment this line if you want to see the response

    $response = json_decode($responseJson);

    if ($response && isset($response->download_url)) {
        $fileUrl = $response->download_url;
        $fileName = basename($fileUrl);

        // Save file to local directory
        $saved = file_put_contents("/Users/kekelebaka/Downloads/".$fileName, file_get_contents($fileUrl));
        if ($saved !== false) {
            echo "File downloaded successfully.";
        } else {
            echo "Error saving the file.";
        }
    } else {
        echo "Invalid response format or download URL not found.";
    }

} catch (RequestException $e) {
    // If an exception occurs, catch it and print the error message
    echo 'Error: ' . $e->getMessage();
}

?>
