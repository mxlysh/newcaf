<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Смены</title>
    <style>
        /* Стили CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            position: relative;
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-right: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }



        tr:hover {
            background-color: #ddd;
        }
button[type="button"] {
    background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            position: absolute;
            left: 20px;
            top: 20px;
}

button[type="button"]:hover {
    background-color: #0056b3;
}

button[type="button"].fire {
    background-color: #dc3545; /* Красный цвет */
}

button[type="button"].fire:hover {
    background-color: #c82333; /* Темно-красный цвет при наведении */
}
.add-shift-button {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    position: absolute;
    top: 20px;
    right: 0px;
    margin-top: 20px;
    margin-right: 20px;
    border-radius: 4px;
}
    </style>
</head>
<body>
    <button type="button" class="fire" onclick="goBack()">Назад</button>
    <div class="container">
        <h1>Смены</h1>
        <button class="add-shift-button" onclick="showAddShiftForm()">Добавить смену</button>
        
        <?php
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

        // SQL запрос для выборки всех смен
        $sql = "SELECT * FROM shift";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Выводим данные всех смен в виде таблицы
            echo "<table>";
            echo "<tr><th>ID смены</th><th>ID пользователя</th><th>Время начала</th><th>Время окончания</th><th>Дата</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id_shift'] . "</td>";
                echo "<td>" . $row['id_user_shift'] . "</td>";
                echo "<td>" . $row['time_start'] . "</td>";
                echo "<td>" . $row['time_end'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        // Закрываем соединение с базой данных
        $conn->close();
        ?>
    </div>
    <script>
        // JavaScript функция для возврата на предыдущую страницу
        function goBack() {
            window.history.back();
        }

        // JavaScript функция для отображения формы добавления смены
        function showAddShiftForm() {
            // Замените "add_shift.php" на путь к файлу обработчику добавления смены
            window.location.href = "add_shift.php";
        }
    </script>
</body>
</html>
