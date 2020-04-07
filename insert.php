<?php
$FirstName=$_POST['fname'];
$LastName =$_POST['lname'];
$Gender=$_POST['gender'];
$DateofBirth=$_POST['dob'];
 if(!empty($FirstName) || !empty($LastName) || !empty($Gender) || !empty(DateofBirth) )
 {
   $host ="127.0.0.1";
   $dbUsername ="root";
   $dbPassword = "";
   $dbname = "register";
    // create connection 
   $conn =new mysqli($host,$dbUsername.$dbPassword,$dbname);
     if(mysqli_connect_error()){
		 die('Connect_Error('.mysqli_connect_errno().')'.mysqli_connect_error());
	 }
	 else {
		 $SELECT = "SELECT FirstName FROM user_info where FirstName=? LIMIT 1";
		 $INSERT = "INSERT INTO user_info(FirstName,LastName,Gender,DateofBirth) values(?,?,?,?)";
		 // prepare statement
		  $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $FirstName);
     $stmt->execute();
     $stmt->bind_result($FirstName);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssi", $FirstName, $LastName, $Gender, $DateofBirth);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this FirstName";
     }
     $stmt->close();
     $conn->close();
		 
	 }
 }
  else {
		echo "All fields are required.";
		die(); #Server side validation
	} 
 
?>