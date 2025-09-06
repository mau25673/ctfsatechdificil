



<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$mysqli = new mysqli("localhost", "root", "test", "sion");

if ($mysqli->connect_error) {
    die("Connection error: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['user'] ?? '';
    $password = $_POST['pass'] ?? '';

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $mysqli->query($query);

    echo "<pre style='color:#00ff00;'>";

    if ($result && $result->num_rows > 0) {
        echo "Access granted. Welcome, $username.";
    } else {
        echo "Access denied.";
    }

    echo "</pre>";
}
?>


<style>


body {
    background-color: black;
    color: #00ff00;
    font-family: 'Courier New', Courier, monospace;
    text-align: center;
    margin-top: 100px;
}

.matrix-container {
    display: inline-block;
    background-color: rgba(0, 255, 0, 0.1);
    padding: 40px;
    border: 2px solid #00ff00;
    border-radius: 10px;
}

</style>
