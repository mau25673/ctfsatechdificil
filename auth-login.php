<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SpiritAdmins Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="matrix-container">
        <h1>Connect to freedom net</h1>
        <form method="POST" action="login.php">
            <input type="text" name="user" placeholder="Usuario" required><br>
            <input type="password" name="pass" placeholder="Contraseña" required><br>
            <input type="submit" value="Ingresar">
        </form>
    </div>
</body>
</html>


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

input[type="text"],
input[type="password"] {
    background-color: black;
    color: #00ff00;
    border: 1px solid #00ff00;
    padding: 10px;
    margin: 10px;
    width: 80%;
}

input[type="submit"] {
    background-color: black;
    color: #00ff00;
    border: 1px solid #00ff00;
    padding: 10px 20px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #00ff00;
    color: black;
}


</style> 
