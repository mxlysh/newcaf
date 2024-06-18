<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restoraunt";

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, 'utf8');

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из формы
$id_user_shift = $_POST['id_user_shift'];
$time_start = $_POST['time_start'];
$time_end = $_POST['time_end'];
$date = $_POST['date'];

// SQL запрос для добавления новой смены в базу данных
$sql = "INSERT INTO shift (id_user_shift, time_start, time_end, date) VALUES ('$id_user_shift', '$time_start', '$time_end', '$date')";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Новая смена успешно добавлена"); window.location.href = "shifts.php";</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Закрытие соединения
$conn->close();
?>
