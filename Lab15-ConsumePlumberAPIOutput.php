<!DOCTYPE html>
<html>
<head>
    <title>Symptoms Prediction Form For Diagnosis</title>
</head>
<body>
    <h2>Symptoms Prediction</h2>
    <form method="post" action="prediction.php">
        <!-- Input fields for symptoms -->
        <label for="Symptom_1">Symptom One:</label>
        <input type="text" id="Symptom_1" name="Symptom_1"><br><br>
        
        <label for="Symptom_2">Symptom Two:</label>
        <input type="text" id="Symptom_2" name="Symptom_2"><br><br>

        <label for="Symptom_3">Symptom Three:</label>
        <input type="text" id="Symptom_3" name="Symptom_3"><br><br>

        <label for="Symptom_4">Symptom Four:</label>
        <input type="text" id="Symptom_4" name="Symptom_4"><br><br>

        <label for="Symptom_5">Symptom Five:</label>
        <input type="text" id="Symptom_5" name="Symptom_5"><br><br>

        <label for="Symptom_6">Symptom Six:</label>
        <input type="text" id="Symptom_6" name="Symptom_6"><br><br>

        <label for="Symptom_7">Symptom Seven:</label>
        <input type="text" id="Symptom_7" name="Symptom_7"><br><br>

        <label for="Symptom_8">Symptom Eight:</label>
        <input type="text" id="Symptom_8" name="Symptom_8"><br><br>
        
        <!-- Add more input fields for other symptoms (Symptom_3, Symptom_4, etc.) -->

        <input type="submit" value="Predict">
    </form>
</body>
</html>
<?php
# *****************************************************************************
# Lab 14: Consume data from the Plumber API Output (using PHP) ----
#
# Course Code: BBT4206
# Course Name: Business Intelligence II
# Semester Duration: 21st August 2023 to 28th November 2023
#
# Lecturer: Allan Omondi
# Contact: aomondi [at] strathmore.edu
#
# Note: The lecture contains both theory and practice. This file forms part of
#       the practice. It has required lab work submissions that are graded for
#       coursework marks.
#
# License: GNU GPL-3.0-or-later
# See LICENSE file for licensing information.
# *****************************************************************************

// Full documentation of the client URL (cURL) library: https://www.php.net/manual/en/book.curl.php

// STEP 1: Set the API endpoint URL
$apiUrl = 'http://127.0.0.1:5022/symptoms';

// Initiate a new cURL session/resource
$curl = curl_init();

// STEP 2: Set the values of the parameters to pass to the model ----

// Modify the symptoms values accordingly
$Symptom_1 = 'symptom1_value';
$Symptom_2 = 'symptom2_value';
$Symptom_3 = 'symptom3_value';
$Symptom_4 = 'symptom4_value';
$Symptom_5 = 'symptom5_value';
$Symptom_6 = 'symptom6_value';
$Symptom_7 = 'symptom7_value';
$Symptom_8 = 'symptom8_value';

/*
$Symptom_1 = 'example_value_1';
$Symptom_2 = 'example_value_2';
$Symptom_3 = 'example_value_3';
$Symptom_4 = 'example_value_4';
$Symptom_5 = 'example_value_5';
$Symptom_6 = 'example_value_6';
$Symptom_7 = 'example_value_7';
$Symptom_8 = 'example_value_8';*/

$params = array('Symptom_1' => $Symptom_1, 'Symptom_2' => $Symptom_2,
                'Symptom_3' => $Symptom_3, 'Symptom_4' => $Symptom_4,
                'Symptom_5' => $Symptom_5, 'Symptom_6' => $Symptom_6,
                'Symptom_7' => $Symptom_7, 'Symptom_8' => $Symptom_8);

// STEP 3: Set the cURL options
// CURLOPT_RETURNTRANSFER: true to return the transfer as a string of the
// return value of curl_exec() instead of outputting it directly.
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$apiUrl = $apiUrl . '?' . http_build_query($params);
curl_setopt($curl, CURLOPT_URL, $apiUrl);

// For testing:
echo "The generated URL sent to the API is:<br>".$apiUrl."<br><br>";

// Make a GET request
$response = curl_exec($curl);

// Check for cURL errors
if (curl_errno($curl)) {
    $error = curl_error($curl);
    // Handle the error appropriately
    die("cURL Error: $error");
}

// Close cURL session/resource
curl_close($curl);

// Process the response
// echo "<br>The predicted output in JSON format is:<br>" . var_dump($response) . "<br><br>";

// Decode the JSON into normal text
$data = json_decode($response, true);

// echo "<br>The predicted output in decoded JSON format is:<br>" . var_dump($data) . "<br><br>";

// Check if the response was successful
if (isset($data['0'])) {
    // API request was successful
    // Access the data returned by the API
	echo "The predicted status is:<br>";
	
    // Process the data
	foreach($data as $repository) {
		echo $repository['0'], $repository['1'], $repository['2'], "<br>";
	}
} else {
    // API request failed or returned an error
    // Handle the error appropriately
    echo "API Error: " . $data['message'];
}
?>