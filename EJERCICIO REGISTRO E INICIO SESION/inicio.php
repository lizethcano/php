<?php
// Conexión a la base de datos
$servername = "localhost:3306"; 
$username = "root"; 
$password = "root"; 
$dbname = "registro"; 
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
	die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$usuario = $_POST["nombre_usuario"];
$contraseña = $_POST["contraseña"];

 // Consultar la base de datos para verificar las credenciales
 $sql = "SELECT * FROM sesion WHERE nombre_usuario = '$usuario' AND contraseña = '$contraseña'";
 $result = $conn->query($sql);

 if ($result->num_rows == 1) {
	 // Inicio de sesión exitoso
	 session_start();
	 $_SESSION["nombre_usuario"] = $usuario;
	 header("Location:bienvenido.html");
	 exit();
 } else {
	 // Credenciales incorrectas
	echo $error_message = "Usuario o contraseña incorrectos";
 }
}

$conn->close();
?>