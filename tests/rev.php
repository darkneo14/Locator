<?php
error_reporting(0);
$conn = mysql_pconnect("localhost", "root", "");

if (!$conn) {
    echo "Unable to connect to DB: " . mysql_error();
    exit;
}
mysql_select_db("locator");

session_start();
$rid   = $_GET['rid'];

//echo $rid;
$sql =  "SELECT * FROM review WHERE rid = '$rid' ";


//$result1 = mysql_query($sql,$conn);
$result = mysql_query($sql,$conn);

if ((!$result)) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}
$ii=mysql_num_rows($result);
if (mysql_num_rows($result) != 0)
{   
//echo "hello";
$row = mysql_fetch_assoc($result);
//print_r($row);
//$row1 = mysql_fetch_assoc($result1);

 //$_SESSION['uname']=$row['uname'] ; 
//	header("Location:http://localhost/event/index1.php");
?>





<!DOCTYPE html>
<head>

	<link rel="stylesheet" href="stylesheets/base.css"> <!-- Paragraph styling -->
	<link rel="stylesheet" href="stylesheets/skeleton.css">  <!-- Giving them one third of the area. -->
	<link rel="stylesheet" href="stylesheets/3_app.css">  <!-- Providing boxes -->



    
</head>

<body background="img/images11.jpg">

<!-- Part 5: #Services -->

<div class="pixfort_app_3">

<div class="services_style">
	<div class="container">
    <?php for($i=1;$i<=$ii;$i++)
			{ ?>
                <div class="one-third column">
                    <div class="th1_style">

                        <p class="a3_style"><?php echo $row['rev'] ?></p>

                        <div class="a_bloc3_style">
                            <div class="subscribe_st">
                                <p>Ratings:<?php echo $row['rat'] ?></p>
                            </div>
                        </div>
                     </div>
    	        </div>

               <?php $row = mysql_fetch_assoc($result);}?>
	</div>
</div>

</div>
</body>
</html>
<?php
//echo "Yo";
//echo "Yo";
}
else
 {
    echo "No rows found, nothing to print so am exiting";
    exit;
}
//mysql_free_result($result);



?>
