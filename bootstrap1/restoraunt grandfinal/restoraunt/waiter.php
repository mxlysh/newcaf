<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказы</title>
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

        h1,h2 {
            text-align: center;
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
.add-order-button {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    position: absolute;
    top: 70px;
    right: 0px;
    margin-top: 20px;
    margin-right: 20px;
    border-radius: 4px;
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
    <button type="button" class="fire" onclick="goBack()">Назад</button>
    <div class="container">
        <h1>Панель официанта</h1>
        <h2>Заказы</h2>
        <button class="add-order-button" onclick="openAddOrderPage()">Добавить заказ</button>
        
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

        // SQL запрос для выборки всех заказов
        $sql = "SELECT * FROM orders";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Выводим данные всех заказов в виде таблицы
            echo "<table>";
            echo "<tr><th>Номер заказа</th>
            <th>Блюдо</th>
            <th>Стол</th>
            <th>Количество гостей</th>
            <th>Статус оплаты</th>
            <th>Статус готовности</th>
            <th>Официант</th></tr>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id_orders'] . "</td>";
                echo "<td>" . $row['id_dish'] . "</td>";
                echo "<td>" . $row['table'] . "</td>";
                echo "<td>" . $row['number_of_people'] . "</td>";
                echo "<td>" . $row['status_pay'] . "</td>";
                echo "<td>" . $row['status_ready'] . "</td>";
                echo "<td>" . $row['id_user'] . "</td>";
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
        function openAddOrderPage() {
            window.location.href = 'add_order.php';
        }
</script>
</body>
</html>
