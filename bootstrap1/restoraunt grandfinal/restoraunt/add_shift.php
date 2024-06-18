<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление смены</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        .container {
            width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            text-align: center; /* Выравнивание текста по центру */
        }
        h2 {
            margin-top: 0;
            margin-bottom: 20px;
        }
        label {
            margin-bottom: 8px;
            display: block;
            text-align: left;
        }
        select, input[type="time"], input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%; /* Расширение кнопки на всю ширину */
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 0; /* Отступы по вертикали */
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #007bff;
        }
        button[type="button1"] {
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
button[type="button1"].fire {
    background-color: #dc3545; /* Красный цвет */
}

button[type="button1"].fire:hover {
    background-color: #c82333; /* Темно-красный цвет при наведении */
}
    </style>
</head>
<script>
        // JavaScript функция для возврата на предыдущую страницу
        function goBack() {
            window.history.back();
        }
    </script>
<body>
<button type="button1" class="fire" onclick="goBack()">Назад</button>
<div class="container">
    <h2>Добавить смену</h2>
    <form action="process_add_shift.php" method="POST">
        <label for="id_user_shift">Официант:</label>
        <select id="id_user_shift" name="id_user_shift">
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

            // SQL запрос для получения id_user с ролью "waiter"
            $sql = "SELECT id_user FROM users WHERE role = 'waiter'";
            $result = $conn->query($sql);

            // Заполнение списка значениями из базы данных
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id_user"] . "'>" . $row["id_user"] . "</option>";
                }
            }

            // Закрытие соединения
            $conn->close();
            ?>
        </select>
        <label for="time_start">Время начала:</label>
        <input type="time" id="time_start" name="time_start" required>
        <label for="time_end">Время окончания:</label>
        <input type="time" id="time_end" name="time_end" required>
        <label for="date">Дата:</label>
        <input type="date" id="date" name="date" required>
        <input type="submit" value="Добавить смену">
    </form>
</div>

</body>
</html>
