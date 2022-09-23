<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

for ($i = 3; $i < 50; $i++) {
    $job_title = "Sample job " . $i;
    $brief_description = "This is a sample job " . $i;
    $job_description = "Sample job " . $i . " description";
    $job_openings = generateRandom(3);

    $min_experience = generateRandom(2);
    $max_experience = generateRandom(2);

    $min_salary = (int) generateRandom(1) . '000';
    $max_salary = (int) generateRandom(2) . '000';


    $sql = "INSERT INTO `ci_jobs` (`job_title`, `brief_description`, `job_description`, `job_openings`, `job_location`, `min_experience`, `max_experience`, `min_salary`, `max_salary`, `added_by`, `created_at`, `updated_at`, `status`) VALUES 
    ('{$job_title}', '{$brief_description}', '{$job_description}', '{$job_openings}', '1', '{$min_experience}', '{$max_experience}', '{$min_salary}', '{$max_salary}', '1', '2022-09-21 12:43:08', '2022-09-23 01:22:17', '1'); ";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();


function generateRandom($limit = 0)
{
    $characters = '0123456789';
    $randomString = '';

    for ($i = 0; $i < $limit; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}
