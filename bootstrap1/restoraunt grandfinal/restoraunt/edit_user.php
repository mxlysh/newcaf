<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        /* Стили CSS */
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit User</h1>
        
        <?php
        // Проверяем, был ли передан идентификатор пользователя в URL
        if(isset($_GET['id'])) {
            // Подключение к базе данных
            $servername = "localhost";
            $username = "username";
            $password = "password";
            $dbname = "restoraunt";

            $conn = new mysqli($servername, $username, $password, $dbname);
            mysqli_set_charset($conn, 'utf8');

            // Проверяем соединение
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Получаем идентификатор пользователя из URL
            $userId = $_GET['id'];

            // Получаем данные о пользователе из базы данных
            $sql = "SELECT * FROM users WHERE id_user = $userId";
            $result = $conn->query($sql);

            // Проверяем, успешно ли был получен результат запроса
            if ($result) {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
        ?>
        <!-- Форма для редактирования данных пользователя -->
        <form id="editUserForm" method="post" action="update_user.php">
            <input type="hidden" name="userId" value="<?php echo $row['id_user']; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br><br>
            <label for="surname">Surname:</label>
            <input type="text" id="surname" name="surname" value="<?php echo $row['surname']; ?>" required><br><br>
            <label for="role">Role:</label>
            <input type="text" id="role" name="role" value="<?php echo $row['role']; ?>" required><br><br>
            <label for="status">Status:</label>
            <input type="text" id="status" name="status" value="<?php echo $row['status']; ?>" required><br><br>
            <input type="submit" value="Save">
        </form>
        <?php
                } else {
                    echo "User not found";
                }
            } else {
                echo "Error: " . $conn->error;
            }

            // Закрываем соединение с базой данных
            $conn->close();
        } else {
            echo "User ID not provided";
        }
        ?>
    </div>
</body>
</html>
