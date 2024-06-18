<?php
// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Подключаемся к базе данных
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "restoraunt";

    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_set_charset($conn, 'utf8');

    // Проверяем соединение
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Получаем данные из формы
    $userId = $_POST['userId'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $status = $_POST['status'];

    // Готовим SQL запрос для обновления данных пользователя
    $sql = "UPDATE users SET name='$name', surname='$surname', password='$password', role='$role', status='$status' WHERE id_user=$userId";

    // Выполняем SQL запрос
    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully";
    } else {
        echo "Error updating user: " . $conn->error;
    }

    // Закрываем соединение с базой данных
    $conn->close();
}
?>
