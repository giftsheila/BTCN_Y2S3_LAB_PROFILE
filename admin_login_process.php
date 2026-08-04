<?php
session_start();

include 'config/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM admins WHERE username='$username'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $admin = mysqli_fetch_assoc($result);

        if (password_verify($password, $admin['password'])) {

            $_SESSION['admin_id'] = $admin['admin_id'];
            $_SESSION['username'] = $admin['username'];
            $_SESSION['full_name'] = $admin['full_name'];

            header("Location: admin_dashboard.php");
            exit();

        } else {

            echo "<script>
                    alert('Incorrect password.');
                    window.location='admin_login.php';
                  </script>";
        }

    } else {

        echo "<script>
                alert('Username not found.');
                window.location='admin_login.php';
              </script>";
    }

} else {

    header("Location: admin_login.php");
    exit();

}
?>