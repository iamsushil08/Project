<?php 
session_start();

if (isset($_POST['verify'])) {
    $vcode = $_POST['verifiedcode'];

    include('./connection.php');

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        
        $sql = "SELECT code FROM users WHERE id = '$user_id'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $acode = $row['code'];

            if ($vcode === $acode) {
                header("Location: changep.php");
                exit();
            } else {
                echo "Incorrect verification code. Please retry.";
            }
        } 
        else {
            echo "No verification code found. Please try again.";
        }
    } else {
        echo "User session expired. Please log in again.";
    }
} 
else {
    echo "Verification code not found in form submission.";
}
?>