<?php include ('config.php') ?>
<?php
  session_start();
//$db = mysqli_connect('localhost', 'root', '', 'student');
$user = $_SESSION['username'];
$_SESSION['link'] = 'homeA.php';
?>
<!DOCTYPE html>
<html lan="en">
<head>
    <title>exam portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style5.css" />

</head>
<body>
<?php 
if(isset($_POST['check'])){
	$q = "update admin set Checked = 1";
	mysqli_query($db,$q);?>
	<script>
	alert("Results declared successfully");
	</script>

	<?php
}
?>
   <div id="image">
        <img src="https://img.collegepravesh.com/2015/12/IGDTUW-Logo.png" alt="IGDTUW" width="150" height="150"  style="margin-left:8%">
    </div>
	<div class="top" style=" margin-top:-10%;margin-left:23%; align:center">
	<p style="font-size:30px; color:green"><b>INDIRA GANDHI DELHI TECHNICAL UNIVERSITY FOR WOMEN</b></p>
	<p style="margin-left:33%; margin-top:-2%; font-size:20px"><b>Kashmere Gate, Delhi-110006<b></p>
	</div>
	<br>
	<hr size='10'; color='green'></hr>
    <div id="navbar">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#about">Notifications</a></li>
        </ul>
    </div>
    <br>
    <div id="navbar1">
        <ul>
            <li><a href="#enrollno.">Welcome <?php echo $user; ?></a></li>
            <li><a href="front.php?logout='1'">Log Out</a></li>

        </ul>
    </div>
	<div id="maincontent">
	<form method="post" action ="#">
	<button type="submit" value="submit" name="check"  style="background:green">Declare Results</button>
	</form>
	</div>
<div id="last" >
        <h2 style="color: white">Copyright of IGDTUW</h2>
    </div>
    <div id="blc">
        <h2>IGDTUW-EXAMINATION DIVISION</h2>
    </div>
    
</body>
</html>