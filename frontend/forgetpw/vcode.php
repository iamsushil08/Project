<?php 
session_start();

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    $email = 'your email';
}
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verification Code</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
    * {
        font-family: "Open Sans", sans-serif;
        box-sizing: border-box;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f4f4f9;
    }

    .container {
        text-align: center;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 300px;
    }

    .container h2 {
        font-size: 20px;
        margin-bottom: 10px;
    }

    .container p {
        font-size: 14px;
        color: #555;
        margin-bottom: 20px;
    }

    #codebox {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-bottom: 20px;
    }

    #codebox input {
        width: 40px;
        height: 40px;
        text-align: center;
        font-size: 18px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    #submit {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        color: #fff;
        background-color: #4a90e2;
        border: none;
        border-radius: 5px;

    }

    #login {
        text-align: center;
    }

    #login a {
        font-size: 12px;
        color: blue;
        margin-left: 4px;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Enter Verification Code</h2>


        <p>
            We have sent a verification code to <strong>
                <?php echo htmlspecialchars($email); ?>
            </strong>.
        </p>

        <form id="vform" action="./verifycode.php" method="POST">
            <div id="codebox">
                <input type="text" name="code1" id="code1" maxlength="1" oninput="moveToNext(this, 'code2')" required />
                <input type="text" name="code2" id="code2" maxlength="1" oninput="moveToNext(this, 'code3')" required />
                <input type="text" name="code3" id="code3" maxlength="1" oninput="moveToNext(this, 'code4')" required />
                <input type="text" name="code4" id="code4" maxlength="1" required />
            </div>
            <input type="hidden" name="verifiedcode" id="verifiedcode" />
            <button id="verify" type="submit" name="verify" onclick="combined()">Verify</button>

            <p id="login"><a href="../connect/connection.php">Back to log in</a></p>
        </form>
    </div>

    <script>
    function moveToNext(current, nextID) {
        if (current.value.length === 1 && nextID) {
            document.getElementById(nextID).focus();
        }
    }

    function combined() {

        const c1 = document.getElementById("code1").value;
        const c2 = document.getElementById("code2").value;
        const c3 = document.getElementById("code3").value;
        const c4 = document.getElementById("code4").value;
        const combinedCode = c1 + c2 + c3 + c4;

        document.getElementById("verifiedcode").value = combinedCode;
        console.log("Combined Code:", combinedCode);
        document.getElementById("vform").submit();


    }
    </script>
</body>

</html>