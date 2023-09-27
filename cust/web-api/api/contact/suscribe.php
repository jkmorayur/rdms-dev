<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Content-Type');

  // Check if the request method is POST
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // API endpoint URL
    $apiUrl = 'https://cust.royaldrive.in/api/v1/subscribe';

    // API key
    $apiKey = 'AIzaSyAZmL90WX_iYSDEiuCeJU0PrsdD9WuHfpw'; // Replace with your actual API key

    // Check if the email is provided in the request body
    $requestBody = file_get_contents('php://input');
    $requestData = json_decode($requestBody);

    if ($requestData && isset($requestData->email)) {
      // Get the email value from the request
      $email = $requestData->email;

      // Validate the email format
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Invalid email format
        echo json_encode(
          array('message' => 'Invalid email format')
        );
        exit;
      }

      // API request data
      $data = array(
        'email' => $email
      );

      // Convert data to JSON
      $jsonData = json_encode($data);

      // Create cURL request
      $ch = curl_init($apiUrl);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'x-api-key: ' . $apiKey // Include the x-api-key header
      ));
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

      // Execute the API request
      $response = curl_exec($ch);
      curl_close($ch);

      // Handle the API response
      if ($response) {
        // API request successful, process the response
        $responseData = json_decode($response, true);
        // Handle the response data as needed
        echo json_encode($responseData);
      } else {
        // API request failed
        echo json_encode(
          array('message' => 'Sorry')
        );
      }
    } else {
      // Email is not provided in the request body
      echo json_encode(
        array('message' => 'Email not provided')
      );
    }
  } else {
    // Invalid request method
    echo json_encode(
      array('message' => 'Invalid request method')
    );
  }
?>
