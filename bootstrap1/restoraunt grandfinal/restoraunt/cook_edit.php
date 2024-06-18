<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Order</h2>
    <form action="process_edit_order.php" method="POST">
        <label for="dish">Блюдо:</label>
        <select id="dish" name="dish">
            <?php
            // Подключение к базе данных
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "restoraunt";

            // Создание соединения
            $conn = new mysqli($servername, $username, $password, $dbname);
            mysqli_set_charset($conn, 'utf8');

            // Проверка соединения
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Запрос для получения данных меню
            $sql = "SELECT id_dish, dish FROM menu";
            $result = $conn->query($sql);

            // Вывод данных в выпадающий список
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['id_dish'] . '">' . $row['dish'] . '</option>';
                }
            }

            // Закрытие соединения
            $conn->close();
            ?>
        </select>
        <label for="table">Стол:</label>
        <select id="table" name="table">
            <?php
            // Вывод списка столов
            for ($i = 1; $i <= 10; $i++) {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }
            ?>
        </select>
        <label for="guests">Количество гостей:</label>
        <select id="guests" name="guests">
            <?php
            // Вывод списка количества гостей
            for ($i = 1; $i <= 6; $i++) {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }
            ?>
        </select>
        <label for="status_pay">Статус оплаты:</label>
        <select id="status_pay" name="status_pay">
            <option value="paid">Оплачено</option>
            <option value="unpaid">Не оплачено</option>
        </select>
        <label for="status_ready">Статус готовности:</label>
        <select id="status_ready" name="status_ready">
            <option value="ready">Готово</option>
            <option value="not_ready">Не готово</option>
        </select>
        <input type="hidden" name="id_orders" value="<?php echo $_GET['id_orders']; ?>">
        <input type="submit" value="Сохранить изменения">
    </form>
</div>

</body>
</html>
