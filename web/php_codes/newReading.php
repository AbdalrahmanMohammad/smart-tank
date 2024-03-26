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
        $percentage = $_POST['percentage'];
        $time = $_POST['time'];

        if ($percentage == 100 || $percentage == 0) { // to send email 
            $url = 'http://192.168.8.55/tank/web/mail/full.php';
            if ($percentage == 0)
                $url = 'http://192.168.8.55/tank/web/mail/empty.php';

            $postData = [

            ];

            $options = [
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => http_build_query($postData)
                ]
            ];

            $context = stream_context_create($options);
            $response = file_get_contents($url, false, $context);
        }

        if ($percentage == 100 || $percentage == 0) { // to send email 
            $query = "INSERT INTO records (state, time) VALUES (:state, :time)";

            $statement = $pdo->prepare($query);
            
            $state = ($percentage == 0) ? "empty" : "full"; // Determine the state based on the percentage
            
            // Bind parameters
            $statement->bindParam(':state', $state, PDO::PARAM_STR);
            $statement->bindParam(':time', $time);
            
            // Execute the query
            $statement->execute();
        }



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
} catch (PDOException $e) {
    // Print error message
    echo "Error: " . $e->getMessage();
}
?>