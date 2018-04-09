<?php
error_reporting(0);
$conn = mysql_pconnect("localhost", "root", "");

if (!$conn) {
    echo "Unable to connect to DB: " . mysql_error();
    exit;
}
mysql_select_db("locator");

session_start();
$sid   = $_GET['sid'];


$sql =  "SELECT * FROM res WHERE sid = '$sid' ";


$result1 = mysql_query($sql,$conn);
$result = mysql_query($sql,$conn);

if ((!$result)) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}
$ii=mysql_num_rows($result);
if (mysql_num_rows($result) != 0)
{   
$row = mysql_fetch_assoc($result);
$row1 = mysql_fetch_assoc($result1);

 //$_SESSION['uname']=$row['uname'] ; 
//	header("Location:http://localhost/event/index1.php");
?>

<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Jaldi:700,400' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
  	
	<title>Animated SVG Hero Slider | CodyHouse</title>
</head>
<body>
	<section class="cd-slider-wrapper">
		<ul class="cd-slider">
			<li class="visible">
				<div>
					<h2><?php echo $row['rname'] ?></h2>
                    <p>Rating: <?php echo $row['urat'] ?></p>
					<p>Address: <?php echo $row['loc'];  ?></p>
					<a href="http://locator.com/locator/tests/rev.php?rid=<?php echo $row['rid'];?>" class="cd-btn">Reviews</a>
				</div>
			</li>
            <?php for($i=1;$i<$ii;$i++)
			{ $row = mysql_fetch_assoc($result);?>
				
			<li>
				<div>
						<h2><?php echo $row['rname'] ?></h2>
                    <p>Rating: <?php echo $row['urat'] ?></p>
					<p>Address: <?php echo $row['loc']; $_SESSION['rid']   = $row['rid']; ?></p>
					<a href="http://locator.com/locator/tests/rev.php?rid=<?php echo $row['rid'];?>" class="cd-btn">Reviews</a>
				</div>
			</li>
            <?php }?>

		<!--	<li>
				<div>
					<h2>Slide #3 Title</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae, distinctio!.</p>
					<a href="http://codyhouse.co/?p=854" class="cd-btn">Learn more</a>
				</div>
			</li>

			<li>
				<div>
					<h2>Slide #4 Title</h2>
					<p>Lorem ipsum dolor sit amet.</p>
					<a href="http://codyhouse.co/?p=854" class="cd-btn">Learn more</a>
				</div>
			</li> -->
		</ul> <!-- .cd-slider -->
	
		<ol class="cd-slider-navigation">
			<li class="selected"><a href="#0"><em><?php echo $row1['rname'] ?></em></a></li>
			  <?php for($i=1;$i<$ii;$i++)
			  {
				  $row1 = mysql_fetch_assoc($result1); ?>
            <li><a href="#0"><em><?php echo $row1['rname'] ?></em></a></li>
			<!-- <li><a href="#0"><em>Item 3</em></a></li>
			<li><a href="#0"><em>Item 4</em></a></li>
           	<li><a href="#0"><em>Item 5</em></a></li> -->
     <?php  } ?>
		</ol> <!-- .cd-slider-navigation -->
		
		<div class="cd-svg-cover" data-step1="M1402,800h-2V0.6c0-0.3,0-0.3,0-0.6h2v294V800z" data-step2="M1400,800H383L770.7,0.6c0.2-0.3,0.5-0.6,0.9-0.6H1400v294V800z" data-step3="M1400,800H0V0.6C0,0.4,0,0.3,0,0h1400v294V800z" data-step4="M615,800H0V0.6C0,0.4,0,0.3,0,0h615L393,312L615,800z" data-step5="M0,800h-2V0.6C-2,0.4-2,0.3-2,0h2v312V800z" data-step6="M-2,800h2L0,0.6C0,0.3,0,0.3,0,0l-2,0v294V800z" data-step7="M0,800h1017L629.3,0.6c-0.2-0.3-0.5-0.6-0.9-0.6L0,0l0,294L0,800z" data-step8="M0,800h1400V0.6c0-0.2,0-0.3,0-0.6L0,0l0,294L0,800z" data-step9="M785,800h615V0.6c0-0.2,0-0.3,0-0.6L785,0l222,312L785,800z" data-step10="M1400,800h2V0.6c0-0.2,0-0.3,0-0.6l-2,0v312V800z">
			<svg height='100%' width="100%" preserveAspectRatio="none" viewBox="0 0 1400 800">
				<title>SVG cover layer</title>
				<desc>an animated layer to switch from one slide to the next one</desc>
				<path id="cd-changing-path" d="M1402,800h-2V0.6c0-0.3,0-0.3,0-0.6h2v294V800z"/>
			</svg>
		</div> <!-- .cd-svg-cover -->
	</section> <!-- .cd-slider-wrapper -->
<script src="js/jquery-2.1.4.js"></script>
<script src="js/snap.svg-min.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>
<?php
}
else
 {
    echo "No rows found, nothing to print so am exiting";
    exit;
}
//mysql_free_result($result);



?>




