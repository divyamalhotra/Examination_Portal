<?php include ('config.php') ?>
<?php

session_start();
$con = $db;
//mysqli_select_db($con,'assessmentportal');
if($con === false) 
{
	die("ERROR:Could not connect.".mysqli_connect_error());
}
$rollno = $_SESSION['username'];    //roll no of the student
		$sql =  "SELECT * FROM `register` WHERE  Enrollment_No = '$rollno' ";
            $result = mysqli_query($con,$sql);
            $obj = mysqli_fetch_row($result); 
            if($obj[3] == 'B.Tech')
            {
                    if($obj[4] == 'CSE')
                    { if( $rollno <= '07001012019'){
                             $code = '20'.'_';
                            }else{
                                $code = '21'.'_';}
                    }
                    else if($obj[4] == 'IT')
                                { if( $rollno <= '07001012019'){
                             $code = '22'.'_';
                            }else{
                                $code = '23'.'_';}
                    }
                    else if($obj[4] == 'ECE')
                                 $code = '24'.'_';
                    else if($obj[4] == 'MECH')
                                 $code = '25'.'_';
            }
            else if($obj[3] == 'BBA'){
                                    $code = '27'.'_';
            }else if($obj[3] == 'MCA'){
                                    $code = '28'.'_';
            }else if($obj[3] == 'M.Tech'){
                                    if($obj[4] == 'CSE'){
                                        $code = '29'.'_';
                                    }else if($obj[4] == 'IT'){
                                        $code = '30'.'_';
                                    }else if($obj[4] == 'ECE'){
                                         $code = '31'.'_';
                                    }else{
                                         $code = '32'.'_';
                                    }
            }
            $sem = $obj[5].'_';
            $year = $obj[6];
           //$subcode = $obj[2];
        $mysql_tb = $code.$sem.$year;   // database name
            // query to be run again to fetch values
            $sql =  "SELECT * FROM `register` WHERE  Enrollment_No = '$rollno' ";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_assoc($result);
            $name = $row['Name'];
            $branch = $row['Branch'];
            $course = $row['Course'];
            $sem = $row['Semester'];
  require("fpdf/fpdf.php");
class PDF extends FPDF{
        function header()
        {
            $this->SetFont('Arial','B',15);
            //$this->Cell(12);  // is equivalent to Cell(12,0,'',0,0);
            $this->Image('logo.jpg',10,10,30);
            $this->Cell(30); 
            $this->Cell(50,10,'INDIRA GANDHI DELHI TECHNICAL UNIVERSITY FOR WOMEN',0,1);
            $this->Cell(70); 
            $this->SetFont('Arial','B',13);
            $this->Cell(50,10,'Kashmere Gate , New Delhi',0,1);
            $this->Ln(15);
            $this->SetFillColor(103,111,101);
            $this->Cell(190,2,"",0,1,"",TRUE);
            $this->Ln(15);
        }
}
 $pdf = new PDF('P','mm','A4');
 $pdf->AddPage();
 //$pdf->Image("logo.jpg");
 
 
//$pdf->SetFont("Arial","B",15);
//$pdf->Cell(0,10,"INDIRA GANDHI DELHI TECHNICAL UNIVERSITY FOR WOMEN",0,1);
$pdf->SetFont("Arial","",13);
$pdf->Cell(50,10,"Enrollment Number: ",0,0); // width,height,string,border,next line
$pdf->Cell(30,10,$rollno,0,1);
//$pdf->Cell(0,10,"Name: ".$name,0,1);
$pdf->Cell(50,10,"Name: ",0,0); // width,height,string,border,next line
$pdf->Cell(30,10,$name,0,1);
$pdf->Cell(50,10,"Department: ",0,0); // width,height,string,border,next line
$pdf->Cell(30,10,$branch,0,1);
$pdf->Cell(50,10,"Course: ",0,0); // width,height,string,border,next line
$pdf->Cell(30,10,$course,0,1);
$pdf->Cell(50,10,"Semester: ",0,0); // width,height,string,border,next line
$pdf->Cell(30,10,$sem,0,1);
//$pdf->Ln();
//$pdf->Cell(0,10,"Department: ".$branch,0,1);
//$pdf->Cell(0,10,"Course: ".$course,0,1);
$pdf->Ln();
$pdf->SetFont("Arial","B");
$pdf->SetFillColor(103,111,101);
$pdf->Cell(50,10,"Subject Code",1,0,"",TRUE);
$pdf->Cell(0,10,"Subject Name",1,1,"",TRUE);
$pdf->SetFont("Arial","",13);
$query = "SELECT * FROM `".$mysql_tb."` WHERE rollno = '$rollno' ";
        $result = mysqli_query($con,$query);
    $i = 2; 
    
while($obj = mysqli_fetch_row($result))
{    $fieldcount = mysqli_num_fields($result);
      while($i < $fieldcount - 4)
       {  if($obj[$i] != NULL)
             {$subcode = $obj[$i] ;
         $sub = $obj[$i+1];
         $pdf->Cell(50,10,$subcode,1,0);
         $pdf->Cell(0,10,$sub,1,1);}
             
             $i+=10;
             
         }
}
 $pdf->output(); 
 ?>