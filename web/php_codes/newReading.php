<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "poject_login_db";

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!empty($_POST)) {
        // Keep track POST values
        $percentage = $_POST['percentage'];
        // $percentage = "454.426";
        $time = $_POST['time'];

        // Prepare the SQL query
        $query = "UPDATE readings SET percentage = :percentage, time = :time LIMIT 1"; // Assuming there's only one row in the table

        $statement = $pdo->prepare($query);

        // Bind parameters
        $statement->bindParam(':percentage', $percentage, PDO::PARAM_INT);
        $statement->bindParam(':time', $time);

        // Execute the query
        $statement->execute();

        echo "Data updated successfully.";
    }
} catch(PDOException $e) {
    // Print error message
    echo "Error: " . $e->getMessage();
}
?>
