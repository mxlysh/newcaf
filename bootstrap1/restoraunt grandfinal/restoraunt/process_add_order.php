<?php
// Параметры подключения к базе данных
$servername = "localhost"; // Имя сервера
$username = "root"; // Имя пользователя базы данных
$password = ""; // Пароль пользователя базы данных
$dbname = "restoraunt"; // Имя базы данных

// Подключение к базе данных
$mysqli = new mysqli($servername, $username, $password, $dbname);
$mysqli->set_charset("utf8");

// Проверка успешности подключения
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
// Проверка наличия данных в POST-запросе
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $id_dish = $_POST['id_dish'];
    $table = $_POST['table'];
    $number_of_people = $_POST['number_of_people'];
    $status_pay = $_POST['status_pay'];
    $id_user = $_POST['id_user'];

    // Установка значения "Не готов" для столбца status_ready по умолчанию
    $status_ready_default = 'Не готов';

    // Запрос на добавление заказа с установкой значения по умолчанию для столбца status_ready
    $sql = "INSERT INTO orders (id_dish, `table`, number_of_people, status_pay, status_ready, id_user) VALUES ('$id_dish', '$table', '$number_of_people', '$status_pay', '$status_ready_default', '$id_user')";

    // Выполнение запроса
    $result = $mysqli->query($sql);

    // Проверка успешности выполнения запроса
    if ($result) {
        // В случае успешного добавления заказа
        header("Location: waiter.php"); // Перенаправление на страницу официанта
        exit();
    } else {
        // В случае ошибки при добавлении заказа
        echo "Ошибка: " . $mysqli->error;
    }
}

// Закрытие соединения с базой данных
$mysqli->close();
?>
