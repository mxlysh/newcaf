<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кафе админ панель</title>
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
    background-color: green;
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
    background-color: darkgreen;
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
    <div class="admin-panel">
            <div></div>
            <div class="button-container">
                <button type="button" onclick="location.href='orders.php';">Заказы</button>
                <button type="button" onclick="location.href='shifts.php';">Смены</button>
            </div>
        </div>
        <h1>Админ панель</h1>
        


        <!-- Форма для добавления новых пользователей -->
        <h2>Добавить нового пользователя</h2>
        <form id="addUserForm" method="post">
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" required><br>
            <label for="surname">Фамилия:</label>
            <input type="text" id="surname" name="surname" required><br>
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required><br>
            <label for="role">Должность:</label>
            <select id="role" name="role">
                <option value="admin">Администратор</option>
                <option value="cook">Повар</option>
                <option value="waiter">Официант</option>
            </select><br>
            <label for="status">Статус:</label>
            <select id="status" name="status">
                <option value="work">Работает</option>
                <option value="rest">Выходной</option>
                <option value="fired">Уволен</option>
            </select><br>
            <button type="button" onclick="addUser()">Добавить</button>
        </form>
        
        <!-- Панель с пользователями в виде таблицы -->
        <h2>Список пользователей</h2>

        <div class="search-container">
            <input type="text" id="searchInput" onkeyup="searchUsers()" placeholder="Поиск...">
        </div>

        <table id="userTable">
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Пароль</th>
                    <th>Должность</th>
                    <th>Статус</th>
                    <th>Увольнение</th>
                </tr>
            </thead>
            <tbody id="userList">
                <!-- Здесь будут отображаться пользователи -->
            </tbody>
        </table>

        <table id="shiftTable" style="display: none;">
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Начало смены</th>
                    <th>Конец смены</th>
                    <th>Дата</th>
                </tr>
            </thead>
            <tbody id="shiftList">
                <!-- Здесь будут отображаться смены -->
            </tbody>
        </table>
    </div>

    <script>
        // JavaScript код
        window.onload = fetchUserList;

        function fetchUserList() {
            fetch("get_users.php")
            .then(response => response.text())
            .then(data => {
                document.getElementById("userList").innerHTML = data;
                addEditButtons();
            })
            .catch(error => console.error("Error:", error));
        }





        function addUser() {
            var formData = new FormData(document.getElementById("addUserForm"));

            fetch("add_user.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById("addUserForm").reset();
                alert("User added successfully!");
                fetchUserList();
            })
            .catch(error => console.error("Error:", error));
        }

        function fireUser(userId, status) {
            if (status !== "fired") {
                fetch("fire_user.php?id=" + userId)
                .then(response => response.text())
                .then(data => {
                    alert("User fired successfully!");
                    fetchUserList();
                })
                .catch(error => console.error("Error:", error));
            }
        }

        function searchUsers() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("userTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        let found = false;
        for (j = 0; j < td.length; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                }
            }
        }
        if (found) {
            for (j = 0; j < td.length; j++) {
                td[j].style.display = "";
            }
        } else {
            for (j = 0; j < td.length; j++) {
                td[j].style.display = "none";
            }
        }
    }
}
    </script>
</body>
</html>
