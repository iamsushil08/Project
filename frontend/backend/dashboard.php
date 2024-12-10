<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        padding: 0;
        margin: 0;
        font-family: "Roboto", sans-serif;

    }

    .divv {
        background-color: #c45946;
        height: 100vh;
    }

    nav {
        height: 60px;
        width: 100%;
        background-color: white;
        border-radius: 2px;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
    }

    #drivzylogo {
        height: 60px;
        width: 120px;
        margin-left: 20px;
    }

    a {
        text-decoration: none;
        color: black;
    }

    .div {
        height: 50px;
        width: 350px;
        background-color: white;
        border-radius: 3px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        margin-top: 170px;
        margin-left: 450px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .div p {
        text-align: center;
    }

    #addcars {
        margin-top: -36px;
        display: flex;
        justify-content: center;
        gap: 20px;
        padding: 20px;
        background-color: #FFF5EE;
    }

    .box {
        flex: 1;
        max-width: 400px;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    .box h3 {
        text-align: center;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    form label {
        font-size: 14px;
    }

    form input,
    form textarea,
    form select {
        width: 100%;
        padding: 8px;
        border: 1px solid rgba(105, 105, 105, 0.4);
        border-radius: 5px;
        font-size: 14px;
        box-sizing: border-box;
    }

    form input[type="submit"] {
        padding: 10px;
        border: none;
        background-color: royalblue;
        color: white;
        font-size: 14px;
        border-radius: 5px;
        cursor: pointer;
    }

    form input[type="submit"]:hover {
        background-color: rgb(56, 90, 194);
    }

    #feedbacks {
        /* background-color: white; */
        height: 100vh;
        background-color: red;
    }


    table {
        width: 100%;
        text-align: left;
        border-collapse: collapse;

        border: 1px solid black;

    }

    th,
    td {
        border: 1px solid black;

        padding: 8px;

    }

    #feedbacks h3 {
        text-align: center;

    }

    button {
        color: white;
        border: none;
        border-radius: 4px;
    }
    </style>

    </style>
</head>

<body>
    <div class="divv">
        <nav>
            <img src="../images/drivzy (2).png" alt="car image" id="drivzylogo">
            <a href="#addcars" id="ac">Add Cars</a>
            <a href="#feedbacks" id="mf">Manage Feedbacks</a>
            <a href="" id="u">Manage Users</a>
            <a href="" id="pay">Payments</a>
            <a href="">Log Out</a>
        </nav>
        <br><br>

        <div class="div">
            <p>WELCOME, TO ADMIN DASHBOARD!</p>
        </div>
    </div>
    <br><br>

    <div id="addcars">

        <div class="box">
            <h3>Add Cars</h3>
            <form action="./addcars.php" method="POST" enctype="multipart/form-data">
                <label for="name">Car Name</label>
                <input type="text" name="name">
                <label for="model">Car Model</label>
                <input type="text" name="model">
                <label for="color">Car Color</label>
                <input type="text" name="color">
                <label for="mileage">Car Mileage</label>
                <input type="text" name="mileage">
                <label for="description">Description</label>
                <textarea name="description" rows="3" cols="20" required></textarea>
            </form>
        </div>

        <div class="box">
            <h3>Additional Details</h3>
            <form action="./addcars.php" method="POST" enctype="multipart/form-data">

                <label for="charge">Charge</label>
                <input type="text" name="charge">
                <label for="status">Status</label>
                <select name="status" required>
                    <option value="Available">Available</option>
                    <option value="Booked">Booked</option>
                </select>
                <label for="plate_number">Plate Number</label>
                <input type="text" name="plate_number">
                <label for="file">Car Image</label>
                <input type="file" name="file" accept="image/*">
                <input type="submit" name="submit" value="Submit">
                <input type="reset" name="reset" value="Reset">
            </form>
        </div>
    </div>
    <div id="feedbacks">
        <h3>Feedbacks</h3>
        <?php
        include"./connection.php";


        $query="select * from contacts";
        $result=mysqli_query($conn,$query);

        if(mysqli_num_rows($result)>0){
          
            echo "<table>";
            echo "<thead>
            <tr>
            <th>
            ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Edit</th>
            <th>Delete</th>
            
            </tr>
            <thead >";      
            echo "<tbody>";
            while($row =mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
              echo "<td>".$row['name']."</td>";
                echo "<td>".$row['email']."</td>";
                 echo "<td>".$row['message']."</td>";
                 //edit page ma redirect yaha bata
                 echo "<td><a href='id=".$row['id']."'>
                 <button style=\"background-color:green;\">Edit</button></a></td>";

                 //lets do delete thingy
                 echo "<td><a href='./delete.php?id=".$row['id']."'>
                 <button style=\"background-color:red;\">Delete</button></a></td>";
                 echo "</tr>";
                  

            }
            echo "</tbody";
            echo"</table>";
        }
        else{
            echo"<p> No data avalable. </p>";
        }
    
        ?>

    </div>
    <div id="users">
        <h3>Users Data</h3>
        <?php 
        include"./connection.php"
        $query= "select * from users";
        $result=mysqli_query($conn,$query);

        if(mysqli_fetch_assoc($result)>0){
            echo "<table>"
            echo"<thead>
            <tr>
            <th>
            ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Edit</th>
            <th>Delete</th>
            
            </tr>
            <thead >";      
            echo "<tbody>";
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                  echo "<td>".$row['name']."</td>";
                    echo "<td>".$row['email']."</td>";
                     echo "<td>".$row['message']."</td>";
            
        }
        
        
        
        
        
        
        
        
        
        
        ?>

    </div>
</body>

</html>