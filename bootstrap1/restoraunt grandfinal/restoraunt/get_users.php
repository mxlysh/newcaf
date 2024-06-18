<?php
// Получаем список пользователей из базы данных и выводим их в виде HTML
// В этом примере используется простой вывод, в реальном приложении данные должны быть безопасно извлечены из базы данных

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

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Вывод данных каждого пользователя в виде HTML
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["surname"] . "</td>";
        echo "<td>" . $row["password"] . "</td>";
        echo "<td>" . $row["role"] . "</td>";
        echo "<td>" . $row["status"] . "</td>";
        echo "<td>";
        if ($row["status"] != "fired") {
            echo '<button type="button" onclick="fireUser(' . $row["id_user"] . ', \'' . $row["status"] . '\')" class="fire">Уволить</button>';
        }
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
