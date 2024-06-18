<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель повара</title>
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1, h2 {
    text-align: center;
    color: #333;
}

form {
    margin-bottom: 20px;
}

form label {
    display: block;
    margin-bottom: 5px;
}

form input[type="text"],
form input[type="password"],
form select {
    width: calc(100% - 12px);
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

form select {
    width: 100%;
}

button[type="button"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    cursor: pointer;
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

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    border: 1px solid #ddd;
}

th {
    background-color: #f0f0f0;
}

tr:hover {
    background-color: #f2f2f2;
}

.search-container {
    margin-bottom: 20px;
}

.search-container input[type="text"] {
    width: calc(100% - 12px);
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.edit-button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
    margin: auto; /* Добавляем автоматические отступы для центрирования */
    display: block; /* Делаем кнопку блочным элементом для применения автоматических отступов */
}

td.edit-cell {
    text-align: center; /* Центрируем содержимое ячейки по горизонтали */
    vertical-align: middle; /* Центрируем содержимое ячейки по вертикали */
}

.edit-button:hover {
    background-color: #0056b3;
}


        .admin-panel {
            display: flex;
            justify-content: space-between;
        }
        .button-container {
            display: flex;
        }
        .button-container button {
            margin-left: 10px;
        }

    </style>
</head>
<body>


<div class="container">
<h2>Панель повара</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Блюдо</th>
            <th>Стол</th>
            <th>Количество гостей</th>
            <th>Статус оплаты</th>
            <th>Статус готовности</th>
            <th>Изменить статус</th>
        </tr>
    </thead>
    <tbody>
    <?php
            // Подключение к базе данных
            $conn = new mysqli("localhost", "root", "", "restoraunt");
            mysqli_set_charset($conn, 'utf8');
            if ($conn->connect_error) {
                die("Ошибка подключения к базе данных: " . $conn->connect_error);
            }
           
            // Запрос для получения всех заказов
            $sql = "SELECT * FROM orders";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Выводим данные каждого заказа в таблицу
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_orders"] . "</td>";
                    echo "<td>" . $row["id_dish"] . "</td>";
                    echo "<td>" . $row["table"] . "</td>";
                    echo "<td>" . $row["number_of_people"] . "</td>";
                    echo "<td>" . $row["status_pay"] . "</td>";
                    echo "<td>" . $row["status_ready"] . "</td>";
                    echo "<td><button class='edit-button' onclick=\"changeOrderStatus(" . $row["id_orders"] . ")\">Изменить</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Нет данных</td></tr>";
            }
            $conn->close();
            ?>
    </tbody>
</table>
    </div>

    <script>
function changeOrderStatus(orderId) {
    // Создаем новый объект XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Устанавливаем метод запроса и URL-адрес обработчика
    xhr.open("POST", "process_edit_order.php", true);

    // Устанавливаем заголовок Content-Type для отправки данных формы
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Отслеживаем изменения состояния запроса
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Проверяем ответ сервера
                var response = xhr.responseText;
                if (response === 'success') {
                    // Если статус успешно изменен, обновляем страницу
                    location.reload();
                } else {
                    // Если возникла ошибка, выводим сообщение об ошибке
                    alert('Ошибка: ' + response);
                }
            } else {
                // В случае ошибки соединения выводим сообщение об ошибке
                alert('Произошла ошибка при отправке запроса на сервер');
            }
        }
    };

    // Формируем данные для отправки
    var formData = "order_id=" + encodeURIComponent(orderId);

    // Отправляем запрос на сервер
    xhr.send(formData);
}



</script>

</body>
</html>
