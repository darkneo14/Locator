<?php 
session_start();

require_once 'vendor/autoload.php';
use Neoxygen\NeoClient\ClientBuilder;

//$connUrl = parse_url('http://master.sb02.stations.graphenedb.com:24789/db/data/');
$user = 'ne04j';
$pwd = 'preet'; 
$client = ClientBuilder::create()
  ->addConnection('default', 'http', 'localhost', 7474)
  ->setAutoFormatResponse(true)
  ->build();
  
	$chk=0;
	if(isset($_GET['src']) && isset($_GET['dest'])){
		$city1=$_GET['src'];
		$city2=$_GET['dest'];
		$city1 = str_replace(' ', '', $city1);
		$city2 = str_replace(' ', '', $city2);
		$chk=2;
	}
	if(isset($_GET['src'])){
		$city1=$_GET['src'];
		$city1 = str_replace(' ', '', $city1);
		$chk=1;
	}
	
	
	//echo("<h5>Shortest Route</h5>");
	$query21='MATCH (from:'.$city1.'), (to: '.$city2.') , path = shortestPath((from)-[:TravelsTo*]->(to)) RETURN path';
	$result21 = $client->sendCypherQuery($query21)->getResult()->getTableFormat();
	//$name=$result->getNodes();
	
	//echo("<h5>Most Travelled Route</h5>");
	
	$query22='match (city:'.$city1.') with city as a match (city:'.$city2.') with city as b,a as a match p=(a)-[*]->(b) with reduce(c=0,n in nodes(p)|c+n.count) as d , p as p1 return d,nodes(p1) order by d desc';
	$result22 = $client->sendCypherQuery($query22)->getResult()->getTableFormat();
	
	//echo("<h5>Longest Route</h5>");
	$query23='match (city:'.$city1.') with city as a match (city:'.$city2	.') with city as b,a as a match p=(a)-[*]->(b) with reduce(c=0,n in nodes(p)|c+1) as d , p as p1 return d,nodes(p1) order by d desc ';
	$result23 = $client->sendCypherQuery($query23)->getResult()->getTableFormat();
	
	
		

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
			<div class="container"><!--
				<div class="header-top-left">
					<p><a href="support.html">24/7 Customer Care</a> | <a class="play-icon popup-with-zoom-anim" href="#small-dialog" href="#"> Resend Booking Confirmation</a> </p>
				<div id="small-dialog" class="mfp-hide">
						<div class="select-city">
							<h3>Resend Confirmation</h3>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
							<div class="confirmation">
							<form>
								<input type="text" class="email" placeholder="Email" required="required" pattern="([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?" title="Enter a valid email"/>
								<input type="text" class="email" placeholder="Mobile Number" maxlength="10" pattern="[1-9]{1}\d{9}" title="Enter a valid mobile number" />
								<input type="submit" value="SEND">
							</form>
							</div>
							<div class="clearfix"></div>
						</div>
				</div>	
				</div>-->
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
							<select class="list_of_cities"><option value="">Select Your City</option></select>
							<div class="clearfix"></div>
						</div>
					</div>	

                     <script>
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
</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="container">
		  <div class="main-content">
			<div class="header">
				<div class="logo">
					<a href="index.html"><h1>Travel This Way</h1></a>
				</div>
				<div class="clearfix"></div>
			</div>
	<div class="bootstrap_container">
            <nav class="navbar navbar-default w3_megamenu" role="navigation">
                <div class="navbar-header">
          			<button type="button" data-toggle="collapse" data-target="#defaultmenu" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a href="index.php" class="navbar-brand"><i class="fa fa-home"></i></a>
				</div><!-- end navbar-header -->
        
            <div id="defaultmenu" class="navbar-collapse collapse">
                <ul class="nav navbar-nav"><!--
                    <li class="active"><a href="index.html">Places</a></li>	
                     Mega Menu -->
					<li class="active dropdown w3_megamenu-fw"><a href="index.html" data-toggle="dropdown" class="dropdown-toggle">Places<b class="caret"></b></a>
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
	<ol class="breadcrumb">
			  <li><a href="index.html">Home</a></li>
			  <li class="active">Places</li>
			  <li class="active">Path</li><br><br>
			<p class="article-left"><a class="m-green" href="#">one</a><a class="m-green" href="#">Two</a><a class="m-green" href="#">Three</a><a class="m-orange" href="#">Four</a></p>
			</ol><br><br>
	<div class="now-showing-list">
		<div class="col-md-2 movies-by-category">
			<h5>Information About Restaurants</h5>
			<input type="text" class="text" value="Enter the city name" onfocus="this.value = '';" onblur="if (this.value == 'Enter email...') {this.value = 'Enter the city name';}">
			<div class="search-by-lang">
				<div class="c-lang">
					<input type="checkbox" id="c1" name="cc" />
					<label class="lang">Shotest Path</label>
				</div>
				<div class="c-lang">
					<input type="checkbox" id="c2" name="cc" />
					<label class="lang">Most Travelled Path</label>
				</div>
				<div class="c-lang">
					<input type="checkbox" id="c3" name="cc" />
					<label class="lang">Longest Path</label>
				</div>
			</div>
			

		</div>
		</div>
<!--  FIRST  QUERY  -->	
	
		<div class="col-md-8 movies-now-playing" id="firstss">
			
<?php
		 //print_r($result22);
		 $ix=0;
		 $iy=1;
		foreach ($result21 as $value) 
		{
			$ix++;
			if($ix>3)
			{
				
				$iy++;
				$ix=1;
			}
			
		
		?>		
		<div class="col-md-6 movie-preview<?php echo $iy; ?>" id="shortest<?php echo $iy; ?>"    >
		
			<h3 class="m-head"  >Path <?php echo $ix; ?></h3>
			<div class="site-map-links">
			<?php		
			foreach ($value['path'] as $value2) 
			{
				if(isset($value2['name']))
				{
			
			?>
				<a href="restaurant-details"><?php echo $value2['name']; } ?></a>
			<?php } ?>
				
			</div>
		</div>
		
		<?php }  ?>
		
		<div class="clearfix"></div>
		</div>
		
			<!--  SECOND  QUERY  	 -->
		<div class="col-md-8 movies-now-playing" id="secondss"> 
			
<?php
		 //print_r($result22);
		 $ix=0;
		 $iy=1;
		foreach ($result22 as $value) 
		{
			$ix++;
			if($ix>3)
			{
				
				$iy++;
				$ix=1;
			}
			
		
		?>		
		<div class="col-md-6 movie-preview<?php echo $iy; ?>" id="shortest<?php echo $iy; ?>"    >
		
			<h3 class="m-head"  >Path <?php echo $ix; ?></h3>
			<div class="site-map-links">
			<?php		
			foreach ($value['nodes(p1)'] as $value2) 
			{
				if(isset($value2['name']))
				{
			
			?>
				<a href="restaurant-details"><?php echo $value2['name']; } ?></a>
			<?php } ?>
				
			</div>
		</div>
		
		<?php }  ?>
		
		
		
		
		<div class="clearfix"></div>
		</div>
		
		
		<!--  Third  QUERY -->
		
		<div class="col-md-8 movies-now-playing" id="thirdss"> 
			
<?php
		 //print_r($result22);
		 $ix=0;
		 $iy=1;
		foreach ($result23 as $value) 
		{
			$ix++;
			if($ix>3)
			{
				
				$iy++;
				$ix=1;
			}
			
		
		?>		
		<div class="col-md-6 movie-preview<?php echo $iy; ?>" id="shortest<?php echo $iy; ?>"    >
		
			<h3 class="m-head"  >Path <?php echo $ix; ?></h3>
			<div class="site-map-links">
			<?php		
			foreach ($value['nodes(p1)'] as $value2) 
			{
				if(isset($value2['name']))
				{
			
			?>
				<a href="restaurant-details"><?php echo $value2['name']; } ?></a>
			<?php } ?>
				
			</div>
		</div>
		
		<?php }  ?>
		<div class="clearfix"></div>
		</div>
		<div class="blog-pagimation">
	<ul class="pagination sint">
			<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
			<li class="active"  onclick="One()"><a href="#">1 <span class="sr-only">(current)</span></a></li>
			<li onclick="Two()"><a href="#" >2 <span class="sr-only">(current)</span></a></li>
			<li onclick="Three()"><a href="#">3 <span class="sr-only">(current)</span></a></li>
			<li onclick="Four()"><a href="#">4 <span class="sr-only">(current)</span></a></li>
			<li onclick="Five()"><a href="#">5 <span class="sr-only">(current)</span></a></li>
			<li class="abled" ><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
		  </ul>
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
 <script src="js/responsive-tabs.js"></script>
    <script type="text/javascript">
      $( '#myTab a' ).click( function ( e ) {
        e.preventDefault();
        $( this ).tab( 'show' );
      } );

      $( '#moreTabs a' ).click( function ( e ) {
        e.preventDefault();
        $( this ).tab( 'show' );
      } );

      ( function( $ ) {
          // Test for making sure event are maintained
          $( '.js-alert-test' ).click( function () {
            alert( 'Button Clicked: Event was maintained' );
          } );
          fakewaffle.responsiveTabs( [ 'xs', 'sm' ] );
      } )( jQuery );

    </script>
 <script type="text/javascript">
						$(document).ready(function() {
							/*
							var defaults = {
					  			containerID: 'toTop', // fading element id
								containerHoverID: 'toTopHover', // fading element hover id NEO
								scrollSpeed: 1200,
								easingType: 'linear' 
					 		};
							*/
							
							$().UItoTop({ easingType: 'easeOutQuart' });
							
						});
					</script>
					
					
					
			<script>
		//******************************************************************************
		// 				MY SCRIPT
		//******************************************************************************
		
			
			//alert("shortestNEO"+a);
			
			//alert("shortest");
			var a=<?php echo $iy; ?>	
			
				
			function HideMajor(){
					document.getElementById("firstss").style="display:none";
					document.getElementById("secondss").style="display:none";
					document.getElementById("thirdss").style="display:none";
			}
			
			function DisplayMajorOne(a){
				document.getElementById(a).style="display:block";
			}
			
			function HideAll(){
				//alert("Hide");
			for(var zz=a;zz>=1;zz--)
			{
				
				
				var ax=document.getElementsByClassName("col-md-6 movie-preview"+zz);
				//alert(ax.length);
				for(var j=0;j<ax.length;j++)
					ax[j].style="display:none";
							
				
			}
			}
			
			function DisplayOne(zz){
				//alert("Display"+zz);
				var ax=document.getElementsByClassName("col-md-6 movie-preview"+zz);
				//alert(ax.length);
				for(var j=0;j<ax.length;j++)
					ax[j].style="display:block";
			}
				
			//HideAll();
			//DisplayOne(1);
			
			function One(){
				HideAll();
				DisplayOne(1);
			}
			
			One();
			
			function Two(){
				HideAll();
				DisplayOne(2);
			}
			function Three(){
				HideAll();
				DisplayOne(3);
			}
			function Four(){
				HideAll();
				DisplayOne(4);
			}
			function Five(){
				HideAll();
				DisplayOne(5);
			}
			
			HideMajor();
			DisplayMajorOne("firstss");
			
			$(document).ready(function () {
    $('.pagination li a').click(function(e) {

        $('.pagination li').removeClass('active');

        var $parent = $(this).parent();
        if (!$parent.hasClass('active')) {
            $parent.addClass('active');
        }
        e.preventDefault();
    });
});

$(document).ready(function () {
    $('.c-lang #c1').click(function(e) {
		$('.c-lang #c1').prop('checked', true);
        HideMajor();
		DisplayMajorOne("firstss");
        e.preventDefault();
    });
});
$(document).ready(function () {
    $('.c-lang #c2').click(function(e) {
	$('.c-lang #c2').prop('checked', true);
        HideMajor();
		DisplayMajorOne("secondss");
        e.preventDefault();
    });
});
$(document).ready(function () {
    $('.c-lang #c3').click(function(e) {

        $('.c-lang #c3').prop('checked', true);
		HideMajor();
        DisplayMajorOne("thirdss");
        e.preventDefault();
    });
});
			
			//DisplayOne(1);
			
					
		</script>		
			
				<a href="#home" class="scroll" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
</body>
</html>