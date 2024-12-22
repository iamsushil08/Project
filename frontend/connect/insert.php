<?php 

if($_SERVER['REQUEST_METHOD']=='POST'){
    include("./connection.php");
    
    $uname=$_POST["uname"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $password=$_POST["password"];
    $cpassword=$_POST["cpassword"];

    if ($password !== $cpassword) {
        echo "Passwords do not match!";
  
    }
    
    $uploadimg = "../userimages/";  
    $password_hashed= password_hash($password, PASSWORD_DEFAULT);

    if(isset($_FILES['file']) && $_FILES['file']['error']== 0){

        $filename=$_FILES['file']['name'];
        $filesize=$_FILES['file']['size'];
        $filetemp=$_FILES['file']['tmp_name']; 
        $filetype=$_FILES['file']['type'];
        
        $extensions= array("image/jpeg","images/png","image/jpg");
        if(in_array($filetype,$extensions)){
            //overwrite avoid gardaii chu repeat nagarna
            $unique_file=time() . "_" . basename($filename);
            $destination= $uploadimg.$unique_file;


            if(move_uploaded_file($filetemp, $destination)){
                $profile_image="userimages/".$unique_file;
            }
         
            else{
                echo "Failed to move uploaded file";
            }
        }
        else{
            echo "File is invalid type";
        }
    }
    else{
        $profile_image="userimages/default.jpeg";
        
    }
    $sql="INSERT INTO users(username,email,phone,password,profile_image) VALUES ('$uname','$email','$phone','$password_hashed','$profile_image')";
    $result=mysqli_query($conn,$sql);
    
    if($result){
       header("Location:./signup.php");
       exit();
    }
    else{
        echo "Error:".mysqli_error($conn);
    }
    
}

        
  


  
  





?>