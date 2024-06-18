<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить заказ</title>
    <style>

body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        }

        .container {
            width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
        }

        h2 {
            margin-top: 0;
            color: #333;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .select-field {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            display: block; /* Сделать кнопку блочным элементом */
    width: 100%; /* Растянуть кнопку по ширине панели */
    margin: 0 auto; /* Центрировать кнопку по горизонтали */

        }

        .button:hover {
            background-color: #0056b3;
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
        <h2>Добавить заказ</h2>
        <form action="process_add_order.php" method="POST">
        <div class="form-group">
            <label for="id_dish" class="label">Блюдо:</label>
            <select id="id_dish" name="id_dish"  class="select-field">
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "restoraunt";
                    
                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    mysqli_set_charset($conn, 'utf8');
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    
                    $sql = "SELECT id_dish FROM menu";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["id_dish"] . "'>" . $row["id_dish"] . "</option>";
                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                ?>
            </select>
            </div>
            <br>
            <div class="form-group">
            <label for="table" class="label">Столик:</label>
            <select id="table" name="table"  class="select-field">
                <?php
                    for ($i = 1; $i <= 10; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                ?>
            </select>
            </div>
            <br>
            <div class="form-group">
            <label for="number_of_people" class="label">Количество посетителей:</label>
            <select id="number_of_people" name="number_of_people" class="select-field">
                <?php
                    for ($i = 1; $i <= 6; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                ?>
            </select>
            </div>
            <br>
            <div class="form-group">
            <label for="status_pay" class="label"  class="label">Статус оплаты:</label>
            <select id="status_pay" name="status_pay"  class="select-field">
                <option value="Оплачено">Оплачено</option>
                <option value="Не оплачено">Не оплачено</option>
            </select>
            </div>
            <br>
            <div class="form-group">
            <label for="id_user" class="label">Официант:</label>
            <select id="id_user" name="id_user"  class="select-field">
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "restoraunt";
                    
                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    
                    $sql = "SELECT id_user FROM users WHERE role = 'waiter'";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["id_user"] . "'>" . $row["id_user"] . "</option>";
                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                ?>
            </select>
            </div>
            <br>
            <input type="submit" class="button" value="Добавить заказ">
        </form>
    </div>
</body>
</html>
