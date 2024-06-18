<?php
// Подключаемся к базе данных
$conn = new mysqli("localhost", "root", "", "restoraunt");
mysqli_set_charset($conn, 'utf8');

if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}
mysqli_set_charset($conn, 'utf8');
// Получаем ID заказа из POST-запроса
$orderId = $_POST['order_id'];

// Проверяем текущий статус готовности заказа
$sql = "SELECT status_ready FROM orders WHERE id_orders = $orderId";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentStatus = $row['status_ready'];

    // Определяем новый статус готовности заказа
    $newStatus = ($currentStatus == 'готово') ? 'не готово' : 'готово';

    // Обновляем статус готовности заказа в базе данных
    $updateSql = "UPDATE orders SET status_ready = '$newStatus' WHERE id_orders = $orderId";
    if ($conn->query($updateSql) === TRUE) {
        // Если запрос выполнен успешно, отправляем ответ 'success'
        echo 'success';
    } else {
        // Если возникла ошибка, отправляем сообщение об ошибке
        echo 'Ошибка при изменении статуса заказа: ' . $conn->error;
    }
} else {
    // Если заказ с указанным ID не найден, отправляем сообщение об ошибке
    echo 'Заказ с указанным ID не найден';
}

// Закрываем соединение с базой данных
$conn->close();
?>
