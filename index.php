<?php 

session_start();

require_once __DIR__ . '/vendor/autoload.php';



?>

<?php

$fb = new Facebook\Facebook([
  'app_id' => 'facebook_app_id',
  'app_secret' => 'facebook_app_secret',
  'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'user_likes','user_posts','user_tagged_places','user_location']; // optional
$loginUrl = $helper->getLoginUrl('http://locator.com/locator/login-callback.php', $permissions);

//echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
//header("Location: '$loginUrl'");

error_reporting(0);

mysql_pconnect("localhost","root","");
mysql_select_db("locator");

$ss="select DISTINCT(city) from checkin ";
$ck=mysql_query($ss);


?>


<!DOCTYPE html>
<html>
<head>
<title>Travel Best</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link rel="stylesheet" href="css/menu.css" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="My Show Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<link href='//fonts.googleapis.com/css?family=Oxygen:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
	<!-- start menu -->
<link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/megamenu.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
<link rel="stylesheet" href="css/font-awesome.min.css" />
<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
		    <script type="text/javascript">
			    $(document).ready(function () {
			        $('#horizontalTab').easyResponsiveTabs({
			            type: 'default', //Types: default, vertical, accordion           
			            width: 'auto', //auto or any width like 600px
			            fit: true   // 100% fit in a container
			        });
			    });
</script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<!---- start-smoth-scrolling---->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
				});
			});
		</script>
<!---- start-smoth-scrolling---->

</head>
<body>
	<!-- header-section-starts -->
		<div class="header-top-strip">
			<div class="container">
				<div class="header-top-left">
					<p><a href="support.html">24/7 Customer Care</a>	
				</div>
				<div class="header-top-right">
	<!-- Button trigger modal  -->
	<a class="play-icon popup-with-zoom-anim" href="#small-dialog1">Select a Region</a>
	<!---pop-up-box---->  
					<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
					<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
					<!---//pop-up-box---->
					<div id="small-dialog1" class="mfp-hide">
						<div class="select-city">
							<h3>Select Your City</h3>
							<select class="list_of_cities"><option value="">Select Your City</option><optgroup label="Andhra Pradesh"><option style="padding-left: 10px;" value="ANAN">Anantapur</option><option style="padding-left: 10px;" value="CHDM">Chinnamandem</option><option style="padding-left: 10px;" value="GUDR">Gudur</option><option style="padding-left: 10px;" value="GUNT">Guntur</option><option style="padding-left: 10px;" value="JANG">Jangareddy Gudem</option><option style="padding-left: 10px;" value="KAKI">Kakinada</option><option style="padding-left: 10px;" value="KURN">Kurnool</option><option style="padding-left: 10px;" value="MART">Martur</option><option style="padding-left: 10px;" value="PRVT">Parvathipuram</option><option style="padding-left: 10px;" value="RAJA">Rajahmundry</option><option style="padding-left: 10px;" value="TENA">Tenali</option><option style="padding-left: 10px;" value="TIRU">Tirupati</option><option style="padding-left: 10px;" value="VIJA">Vijayawada</option><option style="padding-left: 10px;" value="VIZA">Vizag</option><option style="padding-left: 10px;" value="VIZI">Vizianagaram</option></optgroup><optgroup label="Arunachal Pradesh"><option style="padding-left: 10px;" value="TAWA">Tawang</option><option style="padding-left: 10px;" value="ZIRO">Ziro</option></optgroup><optgroup label="Assam"><option style="padding-left: 10px;" value="DIB">Dibrugarh</option><option style="padding-left: 10px;" value="GUW">Guwahati</option><option style="padding-left: 10px;" value="JORT">Jorhat</option><option style="padding-left: 10px;" value="SIL">Silchar</option><option style="padding-left: 10px;" value="TINS">Tinsukia</option></optgroup><optgroup label="Bihar"><option style="padding-left: 10px;" value="HAJI">Hajipur</option><option style="padding-left: 10px;" value="PATN">Patna</option></optgroup><optgroup label="Chhattisgarh"><option style="padding-left: 10px;" value="BHILAI">Bhilai</option><option style="padding-left: 10px;" value="BILA">Bilaspur</option><option style="padding-left: 10px;" value="CHAM">Champa</option><option style="padding-left: 10px;" value="DHMT">Dhamtari</option><option style="padding-left: 10px;" value="DURG">Durg</option><option style="padding-left: 10px;" value="JAGD">Jagdalpur</option><option style="padding-left: 10px;" value="KAWA">Kawardha</option><option style="padding-left: 10px;" value="KNGN">Kondagaon</option><option style="padding-left: 10px;" value="KRBA">Korba</option><option style="padding-left: 10px;" value="RAIG">Raigarh</option><option style="padding-left: 10px;" value="RAIPUR">Raipur</option><option style="padding-left: 10px;" value="TNO">Tilda Neora</option></optgroup><optgroup label="Croatia"><option style="padding-left: 10px;" value="DBRV">Dubrovnik</option></optgroup><optgroup label="Goa"><option style="padding-left: 10px;" value="GOA">Goa</option></optgroup><optgroup label="Gujarat"><option style="padding-left: 10px;" value="ADPR">Adipur</option><option style="padding-left: 10px;" value="AHD">Ahmedabad</option><option style="padding-left: 10px;" value="AND">Anand</option><option style="padding-left: 10px;" value="ANKL">Ankleshwar</option><option style="padding-left: 10px;" value="BHAR">Bharuch</option><option style="padding-left: 10px;" value="BHNG">Bhavnagar</option><option style="padding-left: 10px;" value="DAMA">Daman</option><option style="padding-left: 10px;" value="GDHAM">Gandhidham</option><option style="padding-left: 10px;" value="GNAGAR">Gandhinagar</option><option style="padding-left: 10px;" value="HIMM">Himmatnagar</option><option style="padding-left: 10px;" value="IDAR">Idar</option><option style="padding-left: 10px;" value="JAM">Jamnagar</option><option style="padding-left: 10px;" value="JETP">Jetpur</option><option style="padding-left: 10px;" value="JUGH">Junagadh</option><option style="padding-left: 10px;" value="KTCH">Kutch</option><option style="padding-left: 10px;" value="NADI">Nadiad</option><option style="padding-left: 10px;" value="NVSR">Navsari</option><option style="padding-left: 10px;" value="PALN">Palanpur</option><option style="padding-left: 10px;" value="PATA">Patan</option><option style="padding-left: 10px;" value="RAJK">Rajkot</option><option style="padding-left: 10px;" value="SANA">Sanand</option><option style="padding-left: 10px;" value="SILV">Silvassa</option><option style="padding-left: 10px;" value="SURT">Surat</option><option style="padding-left: 10px;" value="VAD">Vadodara</option><option style="padding-left: 10px;" value="VLSD">Valsad</option><option style="padding-left: 10px;" value="VAPI">Vapi</option></optgroup><optgroup label="Haryana"><option style="padding-left: 10px;" value="AMB">Ambala</option><option style="padding-left: 10px;" value="DHRA">Dharuhera</option><option style="padding-left: 10px;" value="FARI">Faridabad</option><option style="padding-left: 10px;" value="HISR">Hisar</option><option style="padding-left: 10px;" value="JHAJ">Jhajjar</option><option style="padding-left: 10px;" value="JIND">Jind</option><option style="padding-left: 10px;" value="KAIT">Kaithal</option><option style="padding-left: 10px;" value="KARN">Karnal</option><option style="padding-left: 10px;" value="KUND">Kundli</option><option style="padding-left: 10px;" value="KURU">Kurukshetra</option><option style="padding-left: 10px;" value="PNCH">Panchkula</option><option style="padding-left: 10px;" value="PAN">Panipat</option><option style="padding-left: 10px;" value="REWA">Rewari</option><option style="padding-left: 10px;" value="ROH">Rohtak</option><option style="padding-left: 10px;" value="SISA">Sirsa</option><option style="padding-left: 10px;" value="RAIH">Sonipat</option><option style="padding-left: 10px;" value="YAMU">Yamunanagar</option></optgroup><optgroup label="Himachal Pradesh"><option style="padding-left: 10px;" value="BADD">Baddi</option><option style="padding-left: 10px;" value="DMSL">Dharamsala</option><option style="padding-left: 10px;" value="HAMI">Hamirpur (HP)</option><option style="padding-left: 10px;" value="KANG">Kangra</option><option style="padding-left: 10px;" value="KULU">Kullu</option><option style="padding-left: 10px;" value="MANA">Manali</option><option style="padding-left: 10px;" value="SMLA">Shimla</option><option style="padding-left: 10px;" value="SCO">Solan</option></optgroup><optgroup label="Jammu and Kashmir"><option style="padding-left: 10px;" value="JAMM">Jammu</option><option style="padding-left: 10px;" value="KATH">Kathua</option><option style="padding-left: 10px;" value="KATR">Katra</option><option style="padding-left: 10px;" value="LEHA">Ladakh</option></optgroup><optgroup label="Jharkhand"><option style="padding-left: 10px;" value="BOKA">Bokaro</option><option style="padding-left: 10px;" value="DOGH">Deoghar</option><option style="padding-left: 10px;" value="DHAN">Dhanbad(Jharkhand)</option><option style="padding-left: 10px;" value="JMDP">Jamshedpur</option><option style="padding-left: 10px;" value="RANC">Ranchi</option></optgroup><optgroup label="Karnataka"><option style="padding-left: 10px;" value="BELG">Belgaum</option><option style="padding-left: 10px;" value="BANG">Bengaluru</option><option style="padding-left: 10px;" value="BIDR">Bidar</option><option style="padding-left: 10px;" value="COOR">Coorg</option><option style="padding-left: 10px;" value="DAVA">Davangere</option><option style="padding-left: 10px;" value="GULB">Gulbarga</option><option style="padding-left: 10px;" value="HUBL">Hubli</option><option style="padding-left: 10px;" value="KWAR">Karwar</option><option style="padding-left: 10px;" value="MLR">Mangalore</option><option style="padding-left: 10px;" value="MANI">Manipal</option><option style="padding-left: 10px;" value="MYS">Mysore</option><option style="padding-left: 10px;" value="TUMK">Tumkur</option><option style="padding-left: 10px;" value="UDUP">Udupi</option></optgroup><optgroup label="Kerala"><option style="padding-left: 10px;" value="99">Alappuzha</option><option style="padding-left: 10px;" value="ANHL">Anchal</option><option style="padding-left: 10px;" value="ANGA">Angamaly</option><option style="padding-left: 10px;" value="ERNK">Ernakulam</option><option style="padding-left: 10px;" value="KANN">Kannur</option><option style="padding-left: 10px;" value="KARG">Karunagapally</option><option style="padding-left: 10px;" value="KOCH">Kochi</option><option style="padding-left: 10px;" value="KOLM">Kollam</option><option style="padding-left: 10px;" value="KTYM">Kottayam</option><option style="padding-left: 10px;" value="MVLR">Mavellikara</option><option style="padding-left: 10px;" value="THAL">Thalayolaparambu</option><option style="padding-left: 10px;" value="THSR">Thrissur</option><option style="padding-left: 10px;" value="TRIV">Trivandrum</option></optgroup><optgroup label="Madhya Pradesh"><option style="padding-left: 10px;" value="BLGT">Balaghat</option><option style="padding-left: 10px;" value="BETU">Betul</option><option style="padding-left: 10px;" value="BHOP">Bhopal</option><option style="padding-left: 10px;" value="CHIN">Chhindwara</option><option style="padding-left: 10px;" value="DEWAS">Dewas</option><option style="padding-left: 10px;" value="GWAL">Gwalior</option><option style="padding-left: 10px;" value="HRDA">Harda</option><option style="padding-left: 10px;" value="IND">Indore</option><option style="padding-left: 10px;" value="JABL">Jabalpur</option><option style="padding-left: 10px;" value="KHDW">Khandwa</option><option style="padding-left: 10px;" value="NMCH">Neemuch</option><option style="padding-left: 10px;" value="RATL">Ratlam</option><option style="padding-left: 10px;" value="SAMP">Sagar</option><option style="padding-left: 10px;" value="SARN">Sarni</option><option style="padding-left: 10px;" value="SEHO">Sehore</option><option style="padding-left: 10px;" value="SEON">Seoni</option><option style="padding-left: 10px;" value="SHIV">Shivpuri</option><option style="padding-left: 10px;" value="UJJN">Ujjain</option></optgroup><optgroup label="Maharashtra"><option style="padding-left: 10px;" value="AHMED">Ahmednagar</option><option style="padding-left: 10px;" value="AKOL">Akola</option><option style="padding-left: 10px;" value="ALBG">Alibaug</option><option style="padding-left: 10px;" value="AMRA">Amravati</option><option style="padding-left: 10px;" value="AURA">Aurangabad</option><option style="padding-left: 10px;" value="BARA">Baramati</option><option style="padding-left: 10px;" value="BEED">Beed</option><option style="padding-left: 10px;" value="BHIW">Bhiwandi</option><option style="padding-left: 10px;" value="BOIS">Boisar</option><option style="padding-left: 10px;" value="BULD">Buldana</option><option style="padding-left: 10px;" value="CHAN">Chandrapur</option><option style="padding-left: 10px;" value="DHLE">Dhule</option><option style="padding-left: 10px;" value="DHUL">Dhulia</option><option style="padding-left: 10px;" value="INDA">Indapur</option><option style="padding-left: 10px;" value="JALG">Jalgaon</option><option style="padding-left: 10px;" value="KHED">Khed</option><option style="padding-left: 10px;" value="KHOP">Khopoli</option><option style="padding-left: 10px;" value="KOLH">Kolhapur</option><option style="padding-left: 10px;" value="LAT">Latur</option><option style="padding-left: 10px;" value="LAVA">Lavasa</option><option style="padding-left: 10px;" value="LNVL">Lonavala</option><option style="padding-left: 10px;" value="MHAD">Mahad</option><option style="padding-left: 10px;" value="MALE">Malegaon</option><option style="padding-left: 10px;" value="MUMBAI">Mumbai</option><option style="padding-left: 10px;" value="NAGP">Nagpur</option><option style="padding-left: 10px;" value="NAND">Nanded</option><option style="padding-left: 10px;" value="NASK">Nashik</option><option style="padding-left: 10px;" value="PALG">Palghar</option><option style="padding-left: 10px;" value="PANC">Panchgani</option><option style="padding-left: 10px;" value="PARB">Parbhani</option><option style="padding-left: 10px;" value="PEN">Pen</option><option style="padding-left: 10px;" value="PHAL">Phaltan</option><option style="padding-left: 10px;" value="PIMP">Pimpri</option><option style="padding-left: 10px;" value="PUNE">Pune</option><option style="padding-left: 10px;" value="RAI">Raigad</option><option style="padding-left: 10px;" value="SANG">Sangli</option><option style="padding-left: 10px;" value="SATA">Satara</option><option style="padding-left: 10px;" value="SOLA">Solapur</option><option style="padding-left: 10px;" value="TMB">Tembhode</option><option style="padding-left: 10px;" value="UDGR">Udgir</option><option style="padding-left: 10px;" value="WARD">Wardha</option></optgroup><optgroup label="Meghalaya"><option style="padding-left: 10px;" value="RNG">Rongjeng</option><option style="padding-left: 10px;" value="SHLG">Shillong</option></optgroup><optgroup label="Nagaland"><option style="padding-left: 10px;" value="DMPR">Dimapur</option></optgroup><optgroup label="NCR"><option style="padding-left: 10px;" value="NCR">National Capital Region (NCR)</option></optgroup><optgroup label="Orissa"><option style="padding-left: 10px;" value="BLSR">Balasore</option><option style="padding-left: 10px;" value="BHUB">Bhubaneshwar</option><option style="padding-left: 10px;" value="PURI">Puri</option><option style="padding-left: 10px;" value="SAMB">Sambalpur</option></optgroup><optgroup label="Punjab"><option style="padding-left: 10px;" value="ABOR">Abohar</option><option style="padding-left: 10px;" value="AHMG">Ahmedgarh</option><option style="padding-left: 10px;" value="AMRI">Amritsar</option><option style="padding-left: 10px;" value="BNGA">Banga</option><option style="padding-left: 10px;" value="BAR">Barnala</option><option style="padding-left: 10px;" value="BHAT">Bathinda</option><option style="padding-left: 10px;" value="CHD">Chandigarh</option><option style="padding-left: 10px;" value="HOSH">Hoshiarpur</option><option style="padding-left: 10px;" value="JALA">Jalandhar</option><option style="padding-left: 10px;" value="KHAN">Khanna</option><option style="padding-left: 10px;" value="KOTK">Kotkapura</option><option style="padding-left: 10px;" value="LUDH">Ludhiana</option><option style="padding-left: 10px;" value="MNSA">Mansa</option><option style="padding-left: 10px;" value="MOGA">Moga</option><option style="padding-left: 10px;" value="MOHL">Mohali</option><option style="padding-left: 10px;" value="NAVN">Nawanshahr</option><option style="padding-left: 10px;" value="PATH">Pathankot</option><option style="padding-left: 10px;" value="PATI">Patiala</option><option style="padding-left: 10px;" value="PATR">Patran</option><option style="padding-left: 10px;" value="RUPN">Rupnagar</option><option style="padding-left: 10px;" value="SANR">Sangrur</option><option style="padding-left: 10px;" value="ZIRK">Zirakpur</option></optgroup><optgroup label="Rajasthan"><option style="padding-left: 10px;" value="ABRD">Abu Road</option><option style="padding-left: 10px;" value="AJMER">Ajmer</option><option style="padding-left: 10px;" value="ALSR">Alsisar (Rajasthan)</option><option style="padding-left: 10px;" value="ALWR">Alwar</option><option style="padding-left: 10px;" value="BANS">Banswara</option><option style="padding-left: 10px;" value="BEAW">Beawar</option><option style="padding-left: 10px;" value="BHIL">Bhilwara</option><option style="padding-left: 10px;" value="BHWD">Bhiwadi</option><option style="padding-left: 10px;" value="BIK">Bikaner</option><option style="padding-left: 10px;" value="DAUS">Dausa</option><option style="padding-left: 10px;" value="JAIP">Jaipur</option><option style="padding-left: 10px;" value="JSMR">Jaisalmer</option><option style="padding-left: 10px;" value="JODH">Jodhpur</option><option style="padding-left: 10px;" value="KISH">Kishangarh</option><option style="padding-left: 10px;" value="KOTA">Kota</option><option style="padding-left: 10px;" value="NEEM">Neemrana</option><option style="padding-left: 10px;" value="SIKR">Sikar</option><option style="padding-left: 10px;" value="SRIG">Sri Ganganagar</option><option style="padding-left: 10px;" value="UDAI">Udaipur</option></optgroup><optgroup label="Singapore"><option style="padding-left: 10px;" value="SING">Singapore</option></optgroup><optgroup label="Tamil Nadu"><option style="padding-left: 10px;" value="ARIY">Ariyalur</option><option style="padding-left: 10px;" value="ARNI">Arni</option><option style="padding-left: 10px;" value="ARUP">Aruppukottai</option><option style="padding-left: 10px;" value="CHEN">Chennai</option><option style="padding-left: 10px;" value="COIM">Coimbatore</option><option style="padding-left: 10px;" value="CUDD">Cuddalore</option><option style="padding-left: 10px;" value="DHAR">Dharapuram</option><option style="padding-left: 10px;" value="DMPI">Dharmapuri</option><option style="padding-left: 10px;" value="DIND">Dindigul</option><option style="padding-left: 10px;" value="EROD">Erode</option><option style="padding-left: 10px;" value="KNPM">Kanchipuram</option><option style="padding-left: 10px;" value="KUMB">Kumbakonam</option><option style="padding-left: 10px;" value="MADU">Madurai</option><option style="padding-left: 10px;" value="MTPM">Mettuppalayam</option><option style="padding-left: 10px;" value="OOTY">Ooty</option><option style="padding-left: 10px;" value="POND">Pondicherry</option><option style="padding-left: 10px;" value="PUDH">Pudhukottai</option><option style="padding-left: 10px;" value="SALM">Salem</option><option style="padding-left: 10px;" value="SIV">Sivakasi</option><option style="padding-left: 10px;" value="TAJO">Tanjore</option><option style="padding-left: 10px;" value="TENK">Tenkasi</option><option style="padding-left: 10px;" value="TIRV">Tirunelveli</option><option style="padding-left: 10px;" value="TIRP">Tirupur</option><option style="padding-left: 10px;" value="TRIC">Trichy</option><option style="padding-left: 10px;" value="VELL">Vellore</option></optgroup><optgroup label="Telangana"><option style="padding-left: 10px;" value="ADIL">Adilabad</option><option style="padding-left: 10px;" value="AMAN">Amangal</option><option style="padding-left: 10px;" value="HYD">Hyderabad</option><option style="padding-left: 10px;" value="KARIM">Karimnagar</option><option style="padding-left: 10px;" value="KHAM">Khammam</option><option style="padding-left: 10px;" value="MRGD">Miryalaguda</option><option style="padding-left: 10px;" value="NIZA">Nizamabad</option><option style="padding-left: 10px;" value="PEDA">Peddapalli</option><option style="padding-left: 10px;" value="POCH">Pochampally</option><option style="padding-left: 10px;" value="SDDP">Siddipet</option><option style="padding-left: 10px;" value="SURY">Suryapet</option><option style="padding-left: 10px;" value="UPPA">Uppal</option><option style="padding-left: 10px;" value="WAR">Warangal</option></optgroup><optgroup label="Tripura "><option style="padding-left: 10px;" value="AGAR">Agartala</option></optgroup><optgroup label="Uttar Pradesh"><option style="padding-left: 10px;" value="AGRA">Agra</option><option style="padding-left: 10px;" value="ALI">Aligarh</option><option style="padding-left: 10px;" value="ALLH">Allahabad</option><option style="padding-left: 10px;" value="BARE">Bareilly</option><option style="padding-left: 10px;" value="BIJ">Bijnor</option><option style="padding-left: 10px;" value="GHAR">Ghazipur</option><option style="padding-left: 10px;" value="GRKP">Gorakhpur</option><option style="padding-left: 10px;" value="KANP">Kanpur</option><option style="padding-left: 10px;" value="LUCK">Lucknow</option><option style="padding-left: 10px;" value="MATH">Mathura</option><option style="padding-left: 10px;" value="MERT">Meerut</option><option style="padding-left: 10px;" value="MORA">Moradabad</option><option style="padding-left: 10px;" value="MUZ">Muzaffarnagar</option><option style="padding-left: 10px;" value="RENU">Renukoot</option><option style="padding-left: 10px;" value="SAHA">Saharanpur</option><option style="padding-left: 10px;" value="VAR">Varanasi</option></optgroup><optgroup label="Uttarakhand"><option style="padding-left: 10px;" value="DEH">Dehradun</option><option style="padding-left: 10px;" value="HRDR">Haridwar</option><option style="padding-left: 10px;" value="MSS">Mussoorie</option><option style="padding-left: 10px;" value="NAIN">Nainital</option><option style="padding-left: 10px;" value="RAMN">Ramnagar</option><option style="padding-left: 10px;" value="RKES">Rishikesh</option><option style="padding-left: 10px;" value="ROOR">Roorkee</option><option style="padding-left: 10px;" value="RUDP">Rudrapur</option></optgroup><optgroup label="West Bengal"><option style="padding-left: 10px;" value="ASANSOL">Asansol</option><option style="padding-left: 10px;" value="BEHA">Berhampore</option><option style="padding-left: 10px;" value="BLPR">Bolpur</option><option style="padding-left: 10px;" value="BURD">Burdwan</option><option style="padding-left: 10px;" value="COBE">Cooch Behar</option><option style="padding-left: 10px;" value="DARJ">Darjeeling</option><option style="padding-left: 10px;" value="DURGA">Durgapur</option><option style="padding-left: 10px;" value="HALD">Haldia</option><option style="padding-left: 10px;" value="HOOG">Hooghly</option><option style="padding-left: 10px;" value="HWRH">Howrah</option><option style="padding-left: 10px;" value="JPG">Jalpaiguri</option><option style="padding-left: 10px;" value="KOLK">Kolkata</option><option style="padding-left: 10px;" value="RANA">Ranaghat</option><option style="padding-left: 10px;" value="SILI">Siliguri</option></optgroup></select>
							<div class="clearfix"></div>
						</div>
					</div>	

                     <script>
                     	var i=0;
						$(document).ready(function() {
						$('.popup-with-zoom-anim').magnificPopup({
							type: 'inline',
							fixedContentPos: false,
							fixedBgPos: true,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in'
						});
																						
						});
				</script>
				<!-- Large modal 
<button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Login</button>-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;</button>
                <h4 class="modal-title" id="myModalLabel" style="text-align: center">
                    Don't Wait, Login now!</h4>
            </div>
            <div class="modal-body">
                <div class="row">
               <!--     <div class="col-md-8">
                    	<h3 class="other-nw" style="text-align: center">Sign in with</h3>                     
                    </div>-->
                    <div class="row text-center sign-with">
                        <div class="col-md-12">
                            <div class="btn-group btn-group-justified">
                                <a href="<?php echo $loginUrl; ?>" class="btn btn-primary" >Facebook</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
<?php
if(!isset($_SESSION['facebook_access_token'])){?>
	$('#myModal').modal('show');
	
	<?php } ?>
</script>
</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="container">
		  <div class="main-content">
			<div class="header">
				<div class="logo">
					<a href="home.html"><h1>Places To Visit</h1></a>
				</div>
				<div class="search">
					<div class="search2">
					  <form>
						<i class="fa fa-search"></i>
						 <input type="text" value="Search for a place" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for a place';}"/>
					  </form>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
	<div class="bootstrap_container">
            <nav class="navbar navbar-default w3_megamenu" role="navigation">
                <div class="navbar-header">
          			<button type="button" data-toggle="collapse" data-target="#defaultmenu" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a href="home.php" class="navbar-brand"><i class="fa fa-home"></i></a>
				</div><!-- end navbar-header -->
        
            <div id="defaultmenu" class="navbar-collapse collapse">
                <ul class="nav navbar-nav"><!--
                    <li class="active"><a href="home.html">Places</a></li>	
                     Mega Menu -->
					<li class="active dropdown w3_megamenu-fw"><a href="home.php" data-toggle="dropdown" class="dropdown-toggle">Places<b class="caret"></b></a>
                        <ul class="dropdown-menu fullwidth">
                            <li class="w3_megamenu-content">
                                <div class="row">
					<h5 class="movies-page">for places page - <a href="regions.php">Click here</a> </h5>
                                    <div class="col-sm-4">
										<ul class="mov_list">
						<li><a href="#">Most Visited Places</a></li>
					</ul>
					<ul class="mov_list">
						<li><a href="#">Least Visited Places</a></li>
					</ul>
                                <hr>
                    
							</li>
                        </ul>
                    </li>
					<li class="dropdown w3_megamenu-fw"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Restaurants<b class="caret"></b></a>
                        <ul class="dropdown-menu half">
                            <li class="w3_megamenu-content withdesc">
                                <div class="row">
					<h5 class="movies-page">for restaurants page - <a href="restaurant.php">Click here</a> </h5>
								<h3 class="title">Featured Restaurants</h3>
                                    <div class="col-sm-3">
                                    	<div class="e-movie">
								<div class="e-movie-img">
									<a href="restaurant.php"><img src="images/restaurants/bangala.jpg" alt="" /></a>
								</div>
								<div class="e-buy-tickets">
									<a href="#">Learn More</a>
								</div>
							</div>
                                    </div>
                                    <div class="col-sm-3">
                                    	<div class="e-movie">
								<div class="e-movie-img">
									<a href="restaurant.php"><img src="images/restaurants/bukhara.jpg" alt=""></a>
								</div>
								<div class="e-buy-tickets">
									<a href="#">Learn More</a>
								</div>
							</div>
                                    </div>
                                    <div class="col-sm-3">
                                    	<div class="e-movie">
								<div class="e-movie-img">
									<a href="restaurant.php"><img src="images/restaurants/indianaccent.jpg" alt="" /></a>
								</div>
								<div class="e-buy-tickets">
									<a href="#">Learn More</a>
								</div>
							</div>
                                    </div>
                                    <div class="col-sm-3">
                                    	<div class="e-movie">
								<div class="e-movie-img">
									<a href="restaurant.php"><img src="images/restaurants/table.jpg" alt="" /></a>
								</div>
								<div class="e-buy-tickets">
									<a href="#">Learn More</a>
								</div>
							</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
					</li>
					<li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Pages<b class="caret"></b></a>
							 <ul class="dropdown-menu" role="menu">

	<li><a href="about.html">About</a></li>
	<li><a href="contact.html">Contact us</a></li>
	<li><a href="faq.html">FAQs</a></li>
                        </ul>
                       <!-- end dropdown-menu -->
					</li><!-- end standard drop down -->
					<!-- end dropdown w3_megamenu-fw -->
                </ul><!-- end nav navbar-nav -->
                
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Contact Us<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <form id="contact1" action="#" name="contactform" method="post">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <input type="text" name="name" id="name1" class="form-control" placeholder="Name"> 
                                        <input type="text" name="email" id="email1" class="form-control" placeholder="Email"> 
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <input type="text" name="phone" id="phone1" class="form-control" placeholder="Phone">
                                        <input type="text" name="subject" id="subject1" class="form-control" placeholder="Subject"> 
                                    </div>                 
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <textarea class="form-control" name="comments" id="comments1" rows="6" placeholder="Your Message ..."></textarea>
                                    </div>   
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="pull-right">
                                            <input type="submit" value="SEND" id="submit1" class="btn btn-primary small">
                                        </div>  
                                    </div>
									<div class="clearfix"></div>  
                                </form>
                            </li>
                        </ul>
					</li>
				</ul><!-- end nav navbar-nav navbar-right -->
			</div><!-- end #navbar-collapse-1 -->
            
			</nav><!-- end navbar navbar-default w3_megamenu -->
		</div><!-- end container -->
    

<!-- AddThis Smart Layers END -->


	<div class="main-banner">
		 <div class="banner col-md-8">
			<section class="slider">
				<div class="flexslider">
						<ul class="slides">
						<li>
							<img src="images/pslider/mumbai.jpg" class="img-responsive" alt="taj"/>
						</li>
						<li>
							<img src="images/pslider/taj.jpg" class="img-responsive" alt="Mumbai" />
						</li>
						<li>
							<img src="images/pslider/kasol.jpg" class="img-responsive" alt="Agra" />
						</li>
						<li>
							<img src="images/pslider/jaisalmer.jpg" class="img-responsive" alt="Kasol" />
						</li>
				  </ul>
				</div>
			</section>
				 <!-- FlexSlider -->
				 <script defer src="js/jquery.flexslider.js"></script>
				 <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
					<script type="text/javascript">
				$(function(){
				 SyntaxHighlighter.all();
				});
				$(window).load(function(){
				  $('.flexslider').flexslider({
					animation: "slide",
					start: function(slider){
					  $('body').removeClass('loading');
					}
				 });
				});
			 </script>
         </div>
		 <div class="col-md-4 banner-right">
			<h4>Time to Take A Hike!</h4>
			<div class="grid_3 grid_5">
				   <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
			<div id="myTabContent" class="tab-content">
			  <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">				  
                    <div class="fleft">
                        <span class="fleft mr20">From:</span>
                    </div>
							<select class="list_of_cities" id="city1"><option value="">Select Another City</option>
							<?php 
							while($val=mysql_fetch_assoc($ck)){
							?>
							<option style="padding-left: 10px;" value="<?php echo $val['city'] ; ?>"><?php echo $val['city'] ;?></option>
							<?php } ?>
							</select><br>
							
							<?php  
							$ck=mysql_query($ss);
							?>
						<span class="fleft mr20">To:</span>
							<select class="list_of_cities" id="city2"><option value="">Select Another City</option>
							<?php 
							while($val=mysql_fetch_assoc($ck)){
							?>
							<option style="padding-left: 10px;" value="<?php echo $val['city'] ; ?>"><?php echo $val['city'] ;?></option>
							<?php } ?>
							</select>
							<br><br>
                   


				   <div class="btn-group btn-group-justified">
                        <a  class="btn btn-primary" onclick="pathFunc()" >Search</a>
                    </div>
					<h5 class="pre"><i class="fa fa-heart"></i>Most Loved Places :<h5>
					<h6 class="ipre"><a href="#">Chennai, </a> <a href="#"> Mcleodganj</a>, <a href="#">Goa</a></h6>
			  </div>
			</div>
		   </div>
		  </div>
		 </div>
		 
		 <script>
		 
		 function pathFunc(){
			 var c1=document.getElementById("city1").value;
			 var c2=document.getElementById("city2").value;
			 
			 alert(c1);
			 
			 //location.href="path.php";
			 
			 //alert("HI");
			 
			 location.href="http://locator.com/locator/path.php?src="+c1+"&dest="+c2;
			 
		 }
		 
		 </script>
		 
		 <div class="clearfix"></div>
	</div>
				<div class="review-slider">
			 <ul id="flexiselDemo1">
			<li>
				<a href="movies.html"><img src="images/pslider/ooty.jpg" alt=""/></a>
				<div class="slide-title"><h4>Ooty</div>
				<div class="date-city">
					<h5>beautiful</h5>
					<h6>beautiful</h6>
					<div class="buy-tickets">
						<a href="#">View</a>
					</div>
				</div>
			</li>
			<li>
				<a href="movies.html"><img src="images/pslider/taj.jpg" alt=""/></a>
				<div class="slide-title"><h4>Taj Mahal</h4></div>
				<div class="date-city">
					<h5>beautiful</h5>
					<h6>beautiful</h6>
					<div class="buy-tickets">
						<a href="#">View</a>
					</div>
				</div>
			</li>
			<li>
				<a href="movies.html"><img src="images/pslider/jaisalmer.jpg" alt=""/></a>
				<div class="slide-title"><h4>Jaisalmer</h4></div>
				<div class="date-city">
					<h5>beautiful</h5>
					<h6>beautiful</h6>
					<div class="buy-tickets">
						<a href="#">View</a>	
					</div>
				</div>
			</li>
			<li>
				<a href="movies.html"><img src="images/pslider/mumbai.jpg" alt=""/></a>
				<div class="slide-title"><h4>Mumbai</h4></div>
				<div class="date-city">
					<h5>beautiful</h5>
					<h6>beautiful</h6>
					<div class="buy-tickets">
						<a href="#">View</a>
					</div>
				</div>
			</li>
			<li>
				<a href="movies.html"><img src="images/pslider/kerela.jpg" alt=""/></a>
				<div class="slide-title"><h4>Kerela</h4></div>
				<div class="date-city">
					<h5>beautiful</h5>
					<h6>beautiful</h6>
					<div class="buy-tickets">
						<a href="#">View</a>
					</div>
				</div>
			</li>
			<li>
				<a href="movies.html"><img src="images/pslider/Kashmir.jpg" alt=""/></a>
				<div class="slide-title"><h4>Kashmir</h4></div>
				<div class="date-city">
					<h5>beautiful</h5>
					<h6>beautiful</h6>
					<div class="buy-tickets">
						<a href="#">View</a>
					</div>
				</div>
			</li>
		</ul>
			<script type="text/javascript">
		$(window).load(function() {
			
		  $("#flexiselDemo1").flexisel({
				visibleItems: 5,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,    		
				pauseOnHover: false,
				enableResponsiveBreakpoints: true,
				responsiveBreakpoints: { 
					portrait: { 
						changePoint:480,
						visibleItems: 2
					}, 
					landscape: { 
						changePoint:640,
						visibleItems: 3
					},
					tablet: { 
						changePoint:800,
						visibleItems: 4
					}
				}
			});
			});
		</script>
		<script type="text/javascript" src="js/jquery.flexisel.js"></script>	
		</div>
		<div class="footer-top-grid">
		<div class="list-of-movies col-md-8">
			<div class="tabs">
				<div class="sap_tabs">	
						 <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                        </div>
					</div>
				</div>	
				<div class="clearfix"></div>
				<div class="featured">
					<h4>Featured</h4>
					<ul>
						<li>
							<div class="f-movie">
								<div class="f-movie-img">
									<a href="movies.html"><img src="images/pslider/Kashmir.jpg" alt="" /></a>
								</div>
									<div class="f-movie-name">
										<a href="movies.html">Kashmir</a>
										<p class="pre">Kashmir</p>
									</div>
								<div class="f-buy-tickets">
						<a href="#">View</a>
								</div>
							</div>
						</li>
						<li>
							<div class="f-movie">
								<div class="f-movie-img">
									<a href="movies.html"><img src="images/pslider/kerela.jpg" alt="" /></a>
								</div>
									<div class="f-movie-name">
										<a href="movies.html">Kerela</a>
										<p>Kerela</p>
									</div>
								<div class="f-buy-tickets">
						<a href="#">View</a>
								</div>
							</div>
						</li>
						<li>
							<div class="f-movie">
								<div class="f-movie-img">
									<a href="movies.html"><img src="images/pslider/qutubminar.jpg" alt="" /></a>
								</div>
									<div class="f-movie-name">
										<a href="movies.html">Qutub Minar</a>
										<p>Qutub Minar</p>
									</div>
								<div class="f-buy-tickets">
						<a href="#">View</a>
								</div>
							</div>
						</li>
						<li>
							<div class="f-movie">
								<div class="f-movie-img">
									<a href="movies.html"><img src="images/pslider/jalmahal.jpg" alt=""></a>
								</div>
									<div class="f-movie-name">
										<a href="movies.html">Jal Mahal</a>
										<p>Jal Mahal</p>
									</div>
								<div class="f-buy-tickets">
						<a href="#">View</a>
								</div>
							</div>
						</li>
						<li>
							<div class="f-movie">
								<div class="f-movie-img">
									<a href="movies.html"><img src="images/pslider/bangalore.jpg" alt=""></a>
								</div>
									<div class="f-movie-name">
										<a href="movies.html">Bangalore</a>
										<p>Bangalore</p>
									</div>
								<div class="f-buy-tickets">
						<a href="#">View</a>
								</div>
							</div>
						</li>
						<li>
							<div class="f-movie">
								<div class="f-movie-img">
									<a href="movies.html"><img src="images/pslider/ooty.jpg" alt=""></a>
								</div>
									<div class="f-movie-name">
										<a href="movies.html">Ooty</a>
										<p>Ooty</p>
									</div>								 
								<div class="f-buy-tickets">
						<a href="#">View</a>
								</div>
							</div>
						</li>
						<div class="clearfix"></div>
					</ul>
				</div>
			</div>
			<div class="right-side-bar">
				<div class="top-movies-in-india">
					<h4>Top Visited Places in India</h4>
					<ul class="mov_list">
						<h5 class="pre"><i class="fa fa-heart"></i>
						<a href="movie-single.html">Goa</a></h5>
					</ul>
					<ul class="mov_list">
						<h5 class="pre"><i class="fa fa-heart"></i>
						<a href="movie-single.html">Goa</a></h5>
					</ul>
					<ul class="mov_list">
						<h5 class="pre"><i class="fa fa-heart"></i>
						<a href="movie-single.html">Goa</a></h5>
					</ul>
					<ul class="mov_list">
						<h5 class="pre"><i class="fa fa-heart"></i>
						<a href="movie-single.html">Goa</a></h5>
					</ul>
					<ul class="mov_list">
						<h5 class="pre"><i class="fa fa-heart"></i>
						<a href="movie-single.html">Goa</a></h5>
					</ul>
					<ul class="mov_list">
						<h5 class="pre"><i class="fa fa-heart"></i>
						<a href="movie-single.html">Goa</a></h5>
					</ul>
					<ul class="mov_list">
						<h5 class="pre"><i class="fa fa-heart"></i>
						<a href="movie-single.html">Goa</a></h5>
					</ul>
					<ul class="mov_list">
						<h5 class="pre"><i class="fa fa-heart"></i>
						<a href="movie-single.html">Goa</a></h5>
					</ul>
					<ul class="mov_list">
						<h5 class="pre"><i class="fa fa-heart"></i>
						<a href="movie-single.html">Goa</a></h5>
					</ul>
					<ul class="mov_list">
						<h5 class="pre"><i class="fa fa-heart"></i>
						<a href="movie-single.html">Goa</a></h5>
					</ul>
					<ul class="mov_list">
						<h5 class="pre"><i class="fa fa-heart"></i>
						<a href="movie-single.html">Goa</a></h5>
					</ul>
				</div>
			</div>
			<div class="clearfix"></div>			
			</div>
		</div>
		<div class="footer">
			<div class="col-md-3 footer-left">
				<div class="f-mov-list">
					<h4>Places</h4>
					<ul>
						<li><a href="now-showing.html">a</a></li>
						<li><a href="comming-soon.html">b</a></li>
						<li><a href="celebrities.html">c</a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="f-mov-list">
					<h4>Reviews</h4>
					<ul>
						<li><a href="404.html" target="target_blank">a</a></li>
						<li><a href="blog.html" target="target_blank">b</a></li>
						<li><a href="blog.html" target="target_blank">c</a></li>
						<li><a href="write-us.html" target="target_blank">d</a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				</div>
			<div class="col-md-3 footer-left">
				<div class="f-mov-list">
					<h4>Places</h4>
					<ul>
						<li><a href="regions.html">Goa</a></li>
						<li><a href="cinema-chain.html">Goa</a></li>
						<li><a href="cinemas.html">Goa</a></li>						
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="f-mov-list">
					<h4>new</h4>
					<ul>
						<li><a href="movies.html">Hindi</a></li>
						<li><a href="movies.html">English</a></li>					
					</ul>
					<div class="clearfix"></div>
				</div>
				</div>
			<div class="col-md-3 footer-left">
				<div class="f-mov-list">
					<h4>Help</h4>
					<ul>
						<li><a href="site-map.html">Sitemap</a></li>
						<li><a href="feed-back.html">Feedback</a></li>
						<li><a href="faq.html">FAQs</a></li>
						<li><a href="terms-and-conditions.html">Terms and Conditions</a></li>
						<li><a href="privacy-policy.html">Privacy Policy</a></li>
					</ul>
					<div class="clearfix"></div>
				</div>			
			</div>
			<div class="col-md-3 footer-left">
				<div class="f-mov-list">
					<h4>Places</h4>
					<ul>
						<li><a href="movies.html">Placesn</a></li>
						<li><a href="movies.html">Placesce</a></li>
						<li><a href="movies.html">Placesy</a></li>
						<li><a href="movies.html">Places</a></li>
						<li><a href="movies.html">Placesture</a></li>
						<li><a href="movies.html">Placesic</a></li>
						<li><a href="movies.html">Places</a></li>
						<li><a href="movies.html">Places</a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="col-md-12">
			<div class="footer-right">
				<div class="follow-us">
					<h5 class="f-head">Follow us</h5>
					<ul class="social-icons">
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-youtube"></i></a></li>
						<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="recent_24by7">
					<a href="support.html"><i class="fa fa-question"></i>24/7 Customer Care</a>
				</div>
					<div class="clearfix"></div>
			</div>
			</div>
			<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
			<div class="copy-rights text-center">
				<p>© 2016 Travel Best. All Rights Reserved</a></p>
			</div>
	</div>
 <script type="text/javascript">
						$(document).ready(function() {
							/*
							var defaults = {
					  			containerID: 'toTop', // fading element id
								containerHoverID: 'toTopHover', // fading element hover id
								scrollSpeed: 1200,
								easingType: 'linear' 
					 		};
							*/
							
							$().UItoTop({ easingType: 'easeOutQuart' });
							
						});
					</script>
				<a href="#home" class="scroll" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
			
</body>
</html>