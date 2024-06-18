<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1,h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        button {
            width: calc(100% - 22px); /* Ширина минус двойная величина padding (10px) и границы (1px) */
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box; /* Чтобы padding не увеличивал ширину элемента */
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Кафе "Русская кухня"</h1>
        <h2>Авторизация</h2>
        <form id="loginForm" action="do_enter.php" method="post">
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" required>
            <label for="surname">Фамилия:</label>
            <input type="text" id="surname" name="surname" required>
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" name="submit">Войти</button>
        </form>
    </div>

    <?php
    if(isset($_POST['submit'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "restoraunt";

        require_once

        $conn = new mysqli($servername, $username, $password, $dbname);
        mysqli_set_charset($conn, 'utf8');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE name='$name' AND surname='$surname' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Пользователь найден
            $row = $result->fetch_assoc();
            $role = $row['role'];
            switch ($role) {
                case "admin":
                    header("Location: /admin_panel.php");
                    exit;
                case "cook":
                    header("Location: /cook.php");
                    exit;
                case "waiter":
                    header("Location: /waiter.php");
                    exit;
                default:
                    echo "Unknown role";
            }
        } else {
            echo "<script>alert('Invalid name, surname, or password');</script>";
        }

        $conn->close();
    }
    ?>
</body>
</html>
