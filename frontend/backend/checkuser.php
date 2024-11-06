<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('Please log in to continue booking.');
            window.location.href = 'signup.php';
          </script>";
    exit();
} else {
    header('Location: bookcar.php');
    exit();
}
?>