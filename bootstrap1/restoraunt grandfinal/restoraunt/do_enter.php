<?php
    if(isset($_POST['submit'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "restoraunt";

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
                case "Admin":
                    header("Location: /restoraunt/admin_panel.php");
                    exit;
                case "Cook":
                    header("Location: /restoraunt/cook.php");
                    exit;
                case "Waiter":
                    header("Location: /restoraunt/waiter.php");
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