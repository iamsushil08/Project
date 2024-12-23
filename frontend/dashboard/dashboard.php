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
        line-height: 1.6;


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

    #addcars h3 {
        text-align: center;

    }


    #addcars {
        background-color: #FFF5EE;
        padding: 20px;
        height: 500px;
        width: 100%;

    }

    .formm {
        height: 400px;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }

    form {
        display: flex;
        flex-direction: row;
        gap: 20px;
        justify-content: center;
        align-items: center;

    }


    .box {
        flex: 1;
        box-sizing: border-box;
        max-width: 400px;
        height: 430px;
        background-color: white;
        padding: 20px;
        gap: 10px;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        overflow: hidden;

    }

    input::placeholder,
    textarea::placeholder {
        color: #aaa;
        font-size: 14px;
        font-family: Arial, sans-serif;
    }

    input,
    textarea,
    select {
        font-family: Arial, sans-serif;
        font-size: 14px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        width: 100%;
    }

    textarea {
        resize: none;
        line-height: 1.5;
    }


    label {
        font-size: 14px;

    }

    .formbuttons {
        margin-top: 10px;
        display: flex;
        gap: 10px;
        flex-direction: column;
        justify-content: space-between;
    }


    .formbuttons input[type="submit"],
    .formbuttons input[type="reset"] {
        height: 30px;
        border: none;
        background-color: royalblue;
        color: white;
        font-size: 14px;
        border-radius: 5px;
        cursor: pointer;
    }


    #fdb {
        margin-top: -19px;
        width: 100%;
        height: 600px;
        background-color: #F5FFFA;


    }

    #fdb h3 {
        text-align: center;
    }

    #manage-users {
        height: 650px;
        width: 100%;
        background-color: red;
    }

    .cart {
        display: flex;
        align-items: center;

    }

    input#electric,
    input#nonelectric {
        width: 25px;
        margin: 0px;
    }

    #status {
        font-size: 12px;
    }

    table {

        width: 100%;
        text-align: left;
        border-collapse: collapse;
        border: 1px solid black;
        background-color: white;
        color: black;
        margin: 20px 0;
        padding: 0px;

    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;

    }


    button {
        color: white;
        border: none;
        border-radius: 4px;
        background-color: black;
    }
    </style>


</head>

<body>
    <div class="divv">
        <nav>
            <a href="./dashboard.php"> <img src="../images/drivzy (2).png" alt="car image" id="drivzylogo"></a>
            <a href="#addcars" id="ac">Add Cars</a>
            <a href="#fdb" id="mf">Manage Feedbacks</a>
            <a href="#manage-users" id="u">Manage Users</a>
            <a href="#manage-cars">Manage Cars</a>
            <a href="" id="pay">Payments</a>
            <a href="../admin/alogout.php">Log Out</a>
        </nav>
        <br><br>

        <div class="div">
            <p>WELCOME, TO ADMIN DASHBOARD!</p>
        </div>
    </div>


    <div id="addcars">
        <!-- <h3>Car Details</h3> -->
        <div class="formm">
            <form action="./addcars.php" method="POST" enctype="multipart/form-data">
                <div class="box">
                    <label>Car Name</label>
                    <input type="text" name="name">
                    <span id="name-error" style="color:red;"></span>
                    <label>Car Model</label>
                    <input type=" text" name="model">
                    <span id="model-error" style="color:red;"></span>
                    <label>Car Color</label>
                    <input type=" text" name="color">
                    <span id="color-error" style="color:red;"></span>
                    <label>Car Mileage</label>
                    <input type=" text" name="mileage">
                    <span id="mileage-error" style="color:red;"></span>
                    <div class="cart">
                        <label>Type</label>
                        <input type="radio" name="cartype" value="Electric" id="electric">
                        <label>Electric</label>
                        <input type="radio" name="cartype" value="Non-Electric" id="nonelectric">
                        <label>Non-Electric</label>
                    </div>
                    <span id="type-error" style="color:red;"></span>

                    <label>Description</label>
                    <textarea name=" description" rows="2" cols="20" required></textarea>
                    <span id="des-error" style="color:red;"></span>

                </div>

                <div class="box">
                    <label>No of Seats</label>
                    <input type="text" name="noofseats">
                    <span id="seat-error" style="color:red;"></span>

                    <label>Charge</label>
                    <input type=" text" name="charge">
                    <span id="charge-error" style="color:red;"></span>
                    <label>Status</label>
                    <select name=" status" id="status" required>
                        <option value="Available">Available</option>
                        <option value="Booked">Booked</option>
                    </select>
                    <span id="status-error" style="color:red;"></span>
                    <label>Plate Number</label>
                    <input type="text" name="plate_number">
                    <span id="num-error" style="color:red;"></span>
                    <label>Car Image</label>
                    <input type=" file" name="file" accept="image/*" required>
                    <!-- <span id="img-error" style="color:red;"></span> -->
                    <div class="formbuttons">
                        <input type="submit" name="submit" value="Submit">
                        <input type="reset" name="reset" value="Reset">
                    </div>

                </div>
            </form>
        </div>

    </div>
    <!-- page2 -->
    <div id="fdb">
        <h3>Feedbacks</h3>
        <?php
        include "../connect/connection.php";


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
            </thead >";      
            echo "<tbody>";
            while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
              echo "<td>".$row['name']."</td>";
                echo "<td>".$row['email']."</td>";
                 echo "<td>".$row['message']."</td>";
                 //edit page ma redirect yaha bata
                 echo "<td><a href='id=".$row['id']."'>
                 <button>Edit</button></a></td>";

                 //lets do delete thingy
                 echo "<td><a href='./delete.php?id=".$row['id']."'>
                 <button>Delete</button></a></td>";
                 echo "</tr>";
                  

            }
            echo "</tbody>";
            echo "</table>";
           
        }
        else{
            echo"<p> No data avalable. </p>";
        }
    
        ?>
    </div>






    <div id="manage-users">




        <h3>User Data</h3>
        <?php 
        include("../connect/connection.php");

        $query="select * from users";
        $result=mysqli_query($conn,$query);

       if(mysqli_num_rows($result)>0){
        echo "<table>";
        echo "<thead>
        <tr>
        <th>
        User_id</th>
        <th>Username</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Profile_image</th>
        <th>Booking_count</th>
          <th>Edit</th>
            <th>Delete</th>
        

        
        </tr>
        </thead >";
        echo "<tbody>";
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row['user_id']."</td>";
              echo "<td>".$row['username']."</td>";
                echo "<td>".$row['email']."</td>";
                 echo "<td>".$row['phone']."</td>";
                 $profileimg = $row['profile_image'];
                 $imagepath = "../" . $profileimg;
                       if (file_exists($imagepath)) {
                             echo "<td><img src='$imagepath' style='width:100px;height:90px;'></td>";
                                   }

 else {
    echo "<td>No Image</td>";
}
echo "<td>".$row['booking_count']."</td>";
echo "<td><a href='user_id=".$row['user_id']."'>
<button>Edit</button></a></td>";


echo "<td><a href='./delete.php?user_id=".$row['user_id']."'>
<button>Delete</button></a></td>";


                 echo "</tr>";
               
       }
                //    echo"</tbody>";
                   echo"</table>";           
           }
                   else{
                   echo "<p> No data found </p>";
           }





        ?>
    </div>
    <!-- page4 -->
    <div id="manage-cars">

        <h3>Car Data</h3>
        <?php 
        include("../connect/connection.php");

        $query="select * from cars";
        $result=mysqli_query($conn,$query);

       if(mysqli_num_rows($result)>0){
        echo "<table>";
        echo "<thead>
        <tr>
        <th>
        id</th>
        <th>name</th>
        <th>charge</th>
        <th>status</th>
        <th>image_url</th>
        
         <th>color</th>
          <th>description</th>
          <th>mileage</th>
          <th>plate_number</th>
        
          <th>Edit</th>
            <th>Delete</th>
        

        
        </tr>
        </thead >";
        echo "<tbody>";
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
              echo "<td>".$row['name']."</td>";
                echo "<td>".$row['charge']."</td>";
                 echo "<td>".$row['status']."</td>";
                 $carimg =$row['image_url'];
                 $carimage="../".$carimg;
                       if (file_exists($carimage)) {
                             echo "<td><img src='$carimage' style='width:100px;height:60px;'></td>";
                                   }

 else {
    echo "<td>No Image</td>";
}
echo "<td>".$row['color']."</td>";
echo "<td>".$row['description']."</td>";
echo "<td>".$row['mileage']."</td>";
echo "<td>".$row['plate_number']."</td>";

echo "<td><a href='car_id=".$row['id']."'>
<button>Edit</button></a></td>";


echo "<td><a href='./delete.php?car_id=".$row['id']."'>
<button>Delete</button></a></td>";
echo "</tr>";

                 echo "</tr>";
               
       }
                   echo"</tbody>";
                   echo"</table>";           
           }
                   else{
                   echo "<p> No data found </p>";
           }





        ?>
    </div>
</body>

</html>