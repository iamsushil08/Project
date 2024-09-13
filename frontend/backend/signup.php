
<?php
session_start();
include "./connection.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $sql = "SELECT * FROM users WHERE email = '" . mysqli_real_escape_string($conn, $email) . "'";
        $result = mysqli_query($conn, $sql);


        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

        
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];

            
                header("Location:index.html");
         
            } else {
                echo "Invalid password. Please try again.";
            }
        } else {
            echo "No user found with that email.";
        }
    } else {
        echo "Please enter both email and password.";
    }
}
?>
