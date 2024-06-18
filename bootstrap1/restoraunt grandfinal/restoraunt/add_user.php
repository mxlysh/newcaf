<?php
// Подключение к базе данных (вам может потребоваться изменить параметры подключения)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restoraunt";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, 'utf8');

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из формы
$name = $_POST['name'];
$surname = $_POST['surname'];
$password = $_POST['password']; 
$role = $_POST['role'];
$status = $_POST['status'];

// SQL запрос для добавления пользователя в базу данных
$sql = "INSERT INTO users (name, surname, password, role, status)
VALUES ('$name', '$surname', '$password', '$role', '$status')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
