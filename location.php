<?php
error_reporting(0);
$conn = mysql_pconnect("localhost", "root", "");
mysql_select_db("locator");

$qrr="select distinct title,sid from res";
$ab=mysql_query($qrr);
?>
<style>

#data{
	padding-left:10px;
	margin-bottom:10px
	display:block;
	text-decoration:none;
	border-width:2px;
}


</style>

<a href="login.php" style="padding-left:600px">Login With Facebook</a>
<br>
<br>
<ul>
<?php

while($bc=mysql_fetch_assoc($ab))
{
?>

<li>
<a id="data" href="tests/index.php?sid=<?php echo $bc['sid']; ?>"><?php echo $bc['title']."<br>"; ?></a> 
</li>
<?php
}
?>
</ul>