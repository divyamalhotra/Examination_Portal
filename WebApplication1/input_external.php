<?php include ('config.php') ?>
<?php

	session_start();
	$con =$db; //mysqli_connect('localhost','root','','student');
	//mysqli_select_db($con,'assessmentportal');
	if($con === false) 
	{
	die("ERROR:Could not connect.".mysqli_connect_error());
	}

	$table = $_SESSION['tablename'];
	$index = $_SESSION['callindex'];
	//$total = $_SESSION['totalstudents'];
	$index = (int)($index/10) + 1; // column index for marks for finding the subject number

	//echo '$table';
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
			$marks = $_POST['marks'];
            //$res = mysqli_query("SELECT * FROM `".$table."` WHERE 1",$con);
            $colname = "ET" . "$index";
             $col = "Internal"."$index";
            $col2 = "total"."$index";
 
            $query = "SELECT rollno FROM `".$table."` WHERE 1";
            $result1 = mysqli_query($con,$query);
            
            $j=0;
            $count = count($marks);
            //foreach( $marks as $key => $n )
            while($j < $count  && $row = mysqli_fetch_assoc($result1)){
            	$n = $marks[$j];
                $rollno = $row['rollno'];
            	$res = "UPDATE `".$table."` SET  ".$colname." = '".$n."' WHERE rollno = '$rollno'";
            	$result = mysqli_query($con,$res);

            	if( $result == false )
            	{
            		echo 'fail';
            		header('location: rollno_midterm.php');

            	}
              
               $q = "SELECT * FROM `".$table."` WHERE rollno = '$rollno'";
                 $r = mysqli_query($con,$q);
                 $r1=mysqli_fetch_assoc($r);
                 $num1 = $r1[$col];
                 $num2 = $r1[$colname];
                 $sum = $num1 + $num2;
                 $res = "UPDATE `".$table."` SET  ".$col2." = '".$sum."' WHERE rollno = '$rollno'";
            	$result = mysqli_query($con,$res);


            	$j+=1;
            	//echo $i;
            }
			//echo 'success';
			
			echo "<script> alert('Marks Added Successfully'); </script>";
			$_SESSION['midterm'] = 'true';
			$_SESSION['colname'] = $colname;
			header( "refresh:1;url=papers.php" );   // after submitting marks back to papers.php
		  
			//echo 'hello';
	}
	else{
//echo 'fail1';
		header('location: rollno_midterm.php');
	}

?>