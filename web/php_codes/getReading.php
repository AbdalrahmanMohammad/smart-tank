<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "poject_login_db";

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL query to select data
    $query = "SELECT percentage, time FROM readings LIMIT 1"; // Assuming there's only one row in the table

    $statement = $pdo->prepare($query);

    // Execute the query
    $statement->execute();

    // Fetch the result
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    // Check if result is not empty
    if ($result) {
        // Echo the result
        echo json_encode($result);
    } else {
        echo "No data found.";
    }

} catch(PDOException $e) {
    // Print error message
    echo "Error: " . $e->getMessage();
}
?>
