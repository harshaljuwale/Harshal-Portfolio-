<?php
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$message = $_POST['message'];

if (!empty($fullname) || !empty($email) || !empty($message))
{
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "harshal";

    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

      if (mysqli_connect_error()){
        die('Connect Error('. mysqli_connect_errno().')'.mysqli_connect());

      }else{
         $SELECT = "SELECT email From register Where email = ? Limit 1";
         $INSERT = "INSERT Into register(fullname , email , message) values(?,?,?)";

         //prepare statement

         $stmt = $conn->prepare($SELECT);
         $stmt->bind_param("s", $email,);
         $stmt->execute();
         $stmt->bind_result($email);
         $stmt->store_result();
         $rnum = $stmt->num_rows;

         if ($rnum == 0)
         {
            $stmt->close();

            $stmt = $conn->prepare("$INSERT");
            $stmt->bind_param("sss",$fullname,$email,$message);
            $stmt->execute();
            echo "New record inserted sucessfully";
         }
         else
           {
             echo "Someone already register using this email";
           }
           $stmt->close();
           $conn->close();
         }
      }



else
  { echo "All fields are required";
die();
  }

