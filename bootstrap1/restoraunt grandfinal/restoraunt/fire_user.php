<?php
// Увольнение пользователя (изменение статуса на "fired")
// В этом примере используется простой вариант, в реальном приложении данные должны быть безопасно обработаны

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $userId = $_GET["id"];

    // Подключение к базе данных
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

    $sql = "UPDATE users SET status='fired' WHERE id_user='$userId'";

    if ($conn->query($sql) === TRUE) {
        echo "User fired successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
