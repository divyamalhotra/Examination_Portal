﻿<?php include ('config.php') ?>
<?php 
// connect to the database
//$db = mysqli_connect('localhost', 'root', '', 'student');

$errors = array(); 
// REGISTER USER
if (isset($_POST['submit'])) {
	$username = mysqli_real_escape_string($db, $_POST['enrollment_no']);
	$query = "SELECT * FROM register WHERE Enrollment_No='$username'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
	  array_push($errors, "Already Registered");
	 }
    else{
	$name= mysqli_real_escape_string($db, $_POST['name']);
	$c_b = mysqli_real_escape_string($db, $_POST['course_branch']);
	$arr = explode(" ", $c_b);
	$course = $arr[0];
	$branch = $arr[1];
		if(empty($branch)){
			$branch = "NULL";
		}
	$semester = mysqli_real_escape_string($db, $_POST['sem']);
	$FName = mysqli_real_escape_string($db, $_POST['Father_Name']);
	$MName = mysqli_real_escape_string($db, $_POST['Mother_Name']);
	$dob = mysqli_real_escape_string($db, $_POST['dob']);
	$add = mysqli_real_escape_string($db, $_POST['Address']);
	$City = mysqli_real_escape_string($db, $_POST['City']);
	$state = mysqli_real_escape_string($db, $_POST['state']);
	$distt = mysqli_real_escape_string($db, $_POST['distt']);
	$pin = mysqli_real_escape_string($db, $_POST['Pin_Code']);
	$contact = mysqli_real_escape_string($db, $_POST['contact']);
	$alt_cont = mysqli_real_escape_string($db, $_POST['alt_cont']);
	$password = mysqli_real_escape_string($db, $_POST['Password']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$sec_ques = mysqli_real_escape_string($db, $_POST['security_question']);
	$sec_ans = mysqli_real_escape_string($db, $_POST['security_ans']);
	$ten = mysqli_real_escape_string($db, $_POST['tenth']);
	$twelve = mysqli_real_escape_string($db, $_POST['twelvth']);
	$pass = mysqli_real_escape_string($db, $_POST['passyear']);
	$password = password_hash($password,PASSWORD_DEFAULT);
    $pic = addslashes(file_get_contents($_FILES["pic"]["tmp_name"]));
	$sign = addslashes(file_get_contents($_FILES["sign"]["tmp_name"]));
	$user = ltrim($username, '0');
	//array_push($errors, "Select * from verify1 where 'Enrollment_No' = '$user' and Course = '$c_b' and Email = '$email' and DOB = '$dob'");
	$q1 = "Select * from verify1 where Enrollment_No = '$user' and Course = '$c_b' and Email = '$email' and DOB = '$dob'";
	$results = mysqli_query($db, $q1);
	$row=mysqli_fetch_assoc($results);
  	if (mysqli_num_rows($results) == 1){
     // Insert record
		$query = "INSERT INTO `register` (`ID`, `Enrollment_No`, `Name`, `Course`, `Branch`, `Semester`, `Year`, `Father's_Name`, `Mother's_Name`, `DOB`, `Address Line 1`, `City`, `District`, `State`, `Pincode`, `Contact_No`, `Alternate_Contact`, `Password`, `Email_ID`, `Security_Question`, `Security_Answer`, `10th_percent`, `12th_percent`, `Passing_12th`, `Photo`, `Signature`) VALUES (NULL, '$username', '$name', '$course', '$branch', '$semester', 2019, '$FName', '$MName', '$dob', '$add', '$City', '$distt', '$state', '$pin', '$contact', '$alt_cont', '$password', '$email', '$sec_ques', '$sec_ans', '$ten', '$twelve', '$pass', '$pic', '$sign')";
		mysqli_query($db, $query);
		header('location:front.php');
	}else{
			array_push($errors, "Incorrect student details. Please check DOB, Branch and Email ID");
		}
	}
}

?>