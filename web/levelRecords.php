<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "poject_login_db";

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL query
    $query = "SELECT *, DATE_FORMAT(time, '%H:%i') AS time, DATE_FORMAT(time, '%Y-%m-%d') AS date FROM records";

    $statement = $pdo->prepare($query);

    // Execute the query
    $statement->execute();

    // Fetch all the results as an associative array
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    // Print error message
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Records</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Records</h2>
    <table>
        <thead>
            <tr>
                <th>State</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $row): ?>
            <tr>
                <td><?php echo $row['state']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['time']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
