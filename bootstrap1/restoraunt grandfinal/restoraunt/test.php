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
        /* Новый стиль для списка пользователей */
        .user {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }
        .user button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }
        .user button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Panel</h1>
        
        <!-- Форма для добавления новых пользователей -->
        <h2>Add New User</h2>
        <form id="addUserForm" method="post">
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
            <button type="button" onclick="addUser()">Add User</button>
        </form>
        
        <!-- Панель с пользователями -->
        <h2>Users</h2>
        <div id="userList">
            <!-- Здесь будут отображаться пользователи -->
        </div>
    </div>

    <script>
        // JavaScript из предыдущего кода

        function addUser() {
            // Получаем данные формы
            var formData = new FormData(document.getElementById("addUserForm"));

            // Отправляем запрос на добавление пользователя
            fetch("add_user.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Очищаем поля формы
                document.getElementById("addUserForm").reset();
                // Показываем уведомление об успешном добавлении пользователя
                alert("User added successfully!");
                // Обновляем список пользователей
                fetchUserList();
            })
            .catch(error => console.error("Error:", error));
        }

        // JavaScript для загрузки списка пользователей при загрузке страницы
        window.onload = fetchUserList;

        function fetchUserList() {
            fetch("get_users.php")
            .then(response => response.text())
            .then(data => {
                document.getElementById("userList").innerHTML = data;
            })
            .catch(error => console.error("Error:", error));
        }
    </script>
</body>
</html>




// JavaScript для открытия модального окна редактирования пользователя
    function editUser(userId) {
        // Открываем страницу редактирования пользователя с передачей идентификатора пользователя
        window.location.href = "edit_user_form.php?id=" + userId;
    }



        // Функция для загрузки списка пользователей при загрузке страницы
        window.onload = fetchUserList;

        function fetchUserList() {
            fetch("get_users.php")
            .then(response => response.text())
            .then(data => {
                document.getElementById("userList").innerHTML = data;
            })
            .catch(error => console.error("Error:", error));
        }




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
        input[type="submit"],
        button[type="button"] {
            width: 100%; /* Ширина кнопки равна 100% */
            padding: 10px; /* Вертикальный и горизонтальный внутренний отступ */
            border: none;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s; /* Плавное изменение цвета при наведении */
        }
        input[type="submit"]:hover,
        button[type="button"]:hover {
            background-color: #45a049; /* Цвет при наведении */
        }
        /* Новый стиль для списка пользователей */
        .user {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }
        .user button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }
        .user button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Panel</h1>
        
        <!-- Форма для добавления новых пользователей -->
        <h2>Add New User</h2>
        <form id="addUserForm" method="post">
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
            <button type="button" onclick="addUser()">Add User</button>
        </form>
        
        <!-- Панель с пользователями -->
        <h2>Users</h2>

        
        <table id="userTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="userList">
                <!-- Здесь будут отображаться пользователи -->
            </tbody>
        </table>



        <div id="userList">
            <!-- Здесь будут отображаться пользователи -->
        </div>
    </div>

    <script>
    window.onload = fetchUserList;

function fetchUserList() {
    fetch("get_users.php")
    .then(response => response.text())
    .then(data => {
        document.getElementById("userList").innerHTML = data;
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
    var input, filter, ul, li, p, i, txtValue;
    input = document.getElementById('searchInput');
    filter = input.value.toUpperCase();
    ul = document.getElementById("userList");
    li = ul.getElementsByTagName('div');
    for (i = 0; i < li.length; i++) {
        p = li[i].getElementsByTagName("p");
        for (var j = 0; j < p.length; j++) {
            txtValue = p[j].textContent || p[j].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
                break;
            } else {
                li[i].style.display = "none";
            }
        }
    }
}
    </script>
</body>
</html>



function addEditButtons() {
    // Получаем все строки пользователей
    var rows = document.querySelectorAll("#userTable tbody tr");

    rows.forEach(row => {
        // Создаем ячейку для кнопки "Edit"
        var editCell = document.createElement("td");
        editCell.className = "edit-cell"; // Добавляем класс для стилизации

        // Создаем кнопку "Edit"
        var editButton = document.createElement("button");
        editButton.textContent = "Изменить";
        editButton.className = "edit-button"; // Добавляем класс для стилизации

        // Обработчик события при клике на кнопку "Edit"
        editButton.addEventListener("click", function() {
            // Получаем данные о пользователе из строки таблицы
            var userData = [];
            row.querySelectorAll("td").forEach(cell => {
                userData.push(cell.textContent.trim());
            });

            // Отправляем пользователя на страницу редактирования с параметрами
            window.location.href = "edit_user.php?name=" + userData[0] + "&surname=" + userData[1] + "&password=" + userData[2] + "&role=" + userData[3] + "&status=" + userData[4];
        });

        // Добавляем кнопку "Edit" в ячейку
        editCell.appendChild(editButton);

        // Добавляем ячейку с кнопкой "Edit" в текущую строку
        row.appendChild(editCell);
    });
}