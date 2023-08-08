<?php 
// Establecer la conexión con la base de datos 
$servername = "localhost:3306"; 
$username = "root"; 
$password = "root"; 
$dbname = "registro"; 
$conn = new mysqli($servername, $username, $password, $dbname); 
if ($conn->connect_error) { 
     die("Error de conexión: " . $conn->connect_error); 
} 
// Obtener datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST"){ 
     $nombre = $_POST["nombre"];
     $email = $_POST["email"];
     $usuario = $_POST["usuario"];
     $contraseña = md5($_POST["contraseña"]);
     
     // Verificar si el usuario ya existe en la base de datos
     $sql = "SELECT id FROM sesion WHERE nombre_usuario = '$usuario'";
     $result = $conn->query($sql);

     if ($result->num_rows > 0) {
          echo "El usuario ya esta registrado. Por favor, elige otro nombre de usuario.";
     } else{ 

     // Insertar datos en la base de datos
     $sql = "INSERT INTO sesion (nombre, email, nombre_usuario, contraseña) VALUES ('$nombre', '$email', '$usuario', '$contraseña')";
     
     if ($conn->query($sql) === TRUE) {
     // Redireccionar a la página de inicio de sesión
          echo "Datos Insertados Correctamente";
          exit();
     } else {
          echo "Error al realizar el registro". $conn->error;
     }
     }
     }

     $conn->close();
?>