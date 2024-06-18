<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"],
        select {
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
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Panel</h1>
        
        <!-- Форма для добавления новых пользователей -->
        <h2>Add New User</h2>
        <form id="addUserForm" action="add_user.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>
            <label for="surname">Surname:</label>
            <input type="text" id="surname" name="surname" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <label for="role">Role:</label>
            <select id="role" name="role">
                <option value="admin">Admin</option>
                <option value="cook">Cook</option>
                <option value="waiter">Waiter</option>
            </select><br>
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="work">Work</option>
                <option value="rest">Rest</option>
                <option value="fired">Fired</option>
            </select><br>
            <input type="submit" value="Add User">
        </form>
    </div>

    <script>
        // JavaScript для отправки формы асинхронно и предотвращения перезагрузки страницы
        document.getElementById("addUserForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Предотвращаем стандартное поведение отправки формы

            // Создаем объект FormData для сбора данных формы
            var formData = new FormData(this);

            // Отправляем POST запрос с помощью Fetch API
            fetch("add_user.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Обработка ответа, здесь вы можете выполнить дополнительные действия,
                // например, показать сообщение об успешном добавлении пользователя
                console.log(data); // Вывод ответа в консоль (можно удалить)
                alert("User added successfully!"); // Показываем сообщение об успешном добавлении
                // Опционально: очищаем поля формы после успешного добавления
                document.getElementById("name").value = "";
                document.getElementById("surname").value = "";
                document.getElementById("password").value = "";
            })
            .catch(error => {
                console.error("Error:", error); // Обработка ошибок (можно удалить)
                alert("An error occurred. Please try again."); // Показываем сообщение об ошибке
            });
        });
    </script>
</body>
</html>
