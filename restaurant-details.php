<?php session_start();
?>
<?php

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
							<select class="list_of_cities" id="city1"><option value="">Select Another City</option>
							<?php 
							while($val=mysql_fetch_assoc($ck)){
							?>
							<option style="padding-left: 10px;" value="<?php echo $val['city'] ; ?>"><?php echo $val['city'] ;?></option>
							<?php } ?>
							</select>
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
					<a href="home.html"><h1>Restaurants</h1></a>
				</div>
				<div class="search">
					<div class="search2">
					  <form>
						<i class="fa fa-search"></i>
						 <input type="text" value="Search for a restaurant" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for a restaurant';}"/>
					  </form>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
	<div class="bootstrap_container">
            <nav class="navbar navbar-default w3_megamenu" role="navigation">
                <div class="navbar-header">
          			<button type="button" data-toggle="collapse" data-target="#defaultmenu" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a href="home.html" class="navbar-brand"><i class="fa fa-home"></i></a>
				</div><!-- end navbar-header -->
        
            <div id="defaultmenu" class="navbar-collapse collapse">
                <ul class="nav navbar-nav"><!--
                    <li class="active"><a href="home.html">Places</a></li>	
                     Mega Menu -->
					<li class="dropdown w3_megamenu-fw"><a href="home.html" data-toggle="dropdown" class="dropdown-toggle">Places<b class="caret"></b></a>
                        <ul class="dropdown-menu fullwidth">
                            <li class="w3_megamenu-content">
                                <div class="row">
					<h5 class="movies-page">for places page - <a href="regions.html">Click here</a> </h5>
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
					<li class="active dropdown w3_megamenu-fw"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Restaurants<b class="caret"></b></a>
                        <ul class="dropdown-menu half">
                            <li class="w3_megamenu-content withdesc">
                                <div class="row">
					<h5 class="movies-page">for restaurants page - <a href="restaurant.php">Click here</a> </h5>
								<h3 class="title">Featured Restaurants</h3>
                                    <div class="col-sm-3">
                                    	<div class="e-movie">
								<div class="e-movie-img">
									<a href="events.html"><img src="images/restaurants/bangala.jpg" alt="" /></a>
								</div>
								<div class="e-buy-tickets">
									<a href="#">Learn More</a>
								</div>
							</div>
                                    </div>
                                    <div class="col-sm-3">
                                    	<div class="e-movie">
								<div class="e-movie-img">
									<a href="events.html"><img src="images/restaurants/bukhara.jpg" alt=""></a>
								</div>
								<div class="e-buy-tickets">
									<a href="#">Learn More</a>
								</div>
							</div>
                                    </div>
                                    <div class="col-sm-3">
                                    	<div class="e-movie">
								<div class="e-movie-img">
									<a href="events.html"><img src="images/restaurants/indianaccent.jpg" alt="" /></a>
								</div>
								<div class="e-buy-tickets">
									<a href="#">Learn More</a>
								</div>
							</div>
                                    </div>
                                    <div class="col-sm-3">
                                    	<div class="e-movie">
								<div class="e-movie-img">
									<a href="events.html"><img src="images/restaurants/table.jpg" alt="" /></a>
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

<?php
$rid  = $_GET['rid'];
print $rid;


mysql_select_db("locator");


$sql =  "SELECT * FROM res WHERE rid='$rid' ";

//echo "dfhgjkl";
//$result1 = mysql_query($sql,$conn);
$result = mysql_query($sql,$conn);

if ((!$result)) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}
$row = mysql_fetch_assoc($result);


?>

	<div class="m-single-article">
		<div class="article-left">
			<p><a class="m-green" href="#">Filter</a><a class="m-green" href="#">Filter</a><a class="m-green" href="#">Filter</a></p>
			<div class="clearfix"></div>
			<div class="article-time-strip">
				<div class="article-time-strip-left">
					<p>Timings <span><i class="fa fa-clock-o"></i>10am to 8pm</span>  &nbsp;&nbsp; Established <span><i class="fa fa-calendar"></i>Jun 10, 2015</span></p>
				</div>
				<div class="clearfix"></div>

				<div class="review-info">
								<h6 class="span88"><?php echo $row["rname"]; ?></h6>
								<p class="dirctr"><a href="">Reagan Gavin Rasquinha, </a>TNN, Mar 12, 2015, 12.47PM IST</p>				
								<div class="clearfix"></div>
								<p class="ratingview c-rating">OVERALL:</p>
								<div class="rating c-rating">
									<?php
									$aa=(float)$row["urat"];
									$aaa=(int)$aa;
									if($aa==0){ echo "NOT RATED";}
                                          if(($aa-$aaa)>=0.2&&($aa-$aaa)<=0.7){?>
										<i class="fa fa-star-half" aria-hidden="true"></i>
										  <?php }for($i=0;$i<$aaa;$i++){
										?><i class="fa fa-star" aria-hidden="true"></i>
									<?php }
									if(($aa-$aaa)>=0.7){ ?><i class="fa fa-star" aria-hidden="true"></i> <?php }
									?>
									
									
									
								</div> 	
								<p class="ratingview c-rating">								
								&nbsp; <?php echo $aa;?>/5</p>
								<div class="clearfix"></div>
								<p class="ratingview c-rating">FOOD:</p>
								<div class="rating c-rating">
									<?php
									$aa=(float)$row["frat"];
									$aaa=(int)$aa;
										if($aa==0){ echo "NOT RATED";}

                                          if(($aa-$aaa)==0.5){?>
										<i class="fa fa-star-half" aria-hidden="true"></i>
										  <?php } for($i=0;$i<$aaa;$i++){
										?><i class="fa fa-star" aria-hidden="true"></i>
									<?php }?>
									
									
									
								</div> 	
								<p class="ratingview c-rating">								
								&nbsp; <?php echo $aa;?>/5</p>
								<div class="clearfix"></div>
								<p class="ratingview c-rating">AMBIANCE:</p>
								<div class="rating c-rating">
									<?php
									$aa=(float)$row["arat"];
									$aaa=(int)$aa;
										if($aa==0){ echo "NOT RATED";}

                                          if(($aa-$aaa)==0.5) { ?>
										<i class="fa fa-star-half" aria-hidden="true"></i>
										  <?php } for($i=0;$i<$aaa;$i++){
										?><i class="fa fa-star" aria-hidden="true"></i>
									<?php }?>
									
									
									
								</div> 	
								<p class="ratingview c-rating">								
								&nbsp; <?php echo $aa;?>/5</p>
								<div class="clearfix"></div>
								<p class="ratingview c-rating">SERVICE:</p>
								<div class="rating c-rating">
									<?php
									$aa=(float)$row["srat"];
									$aaa=(int)$aa;
											if($aa==0){ echo "NOT RATED";}

                                          if(($aa-$aaa)==0.5) { ?>
										<i class="fa fa-star-half" aria-hidden="true"></i>
										  <?php } for($i=0;$i<$aaa;$i++){
										?><i class="fa fa-star" aria-hidden="true"></i>
									<?php }?>
									
									
									
								</div> 	
								<p class="ratingview c-rating">								
								&nbsp; <?php echo $aa;?>/5</p>
								
								<div class="clearfix"></div>
								
								<p class="info"><strong>ADDRESS</strong>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row["loc"]; ?></p>
								<p class="info"><strong>CUISINES</strong>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row["cus"]; ?></p>
								<p class="info"><strong>COST FOR 2</strong>:&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row["cost"];  ?></p>
							</div>
			</div>
		</div>
		<div class="article-right">
			<div class="grid_3 grid_5">
				   <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
			<ul id="myTab" class="nav nav-tabs" role="tablist">
			  <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">One</a></li>
			  <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Two</a></li>
			</ul>
			<div id="myTabContent" class="tab-content">
			  <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                  <?php  $photo=$row["photo"];  echo "<img src=\"$photo\" height=300 width=400 />"; ?>
				 <div class="clearfix"></div>
				  <a class="more-show-time" href="movie-select-show.html">GO Back</a>
			  </div>
			 
			</div>
			 
							
		   </div>
		  </div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="reviews-tabs">
      <!-- Main component for a primary marketing message or call to action -->
	  
	  <?php  $sql1 =  "SELECT * FROM review WHERE rid='$rid' ";


$result1 = mysql_query($sql1,$conn);

if ((!$result1)) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}
$sql11 =  "SELECT count(*) FROM review WHERE rid='$rid' ";

$result11 = mysql_query($sql11,$conn);

if ((!$result11)) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}
$row11 = mysql_fetch_assoc($result11);  ?>
	  
      <ul class="nav nav-tabs responsive hidden-xs hidden-sm" id="myTab">
        <li class="test-class active"><a class="deco-none misc-class" href="#how-to"> ALL REVIEWS (<?php echo $row11["count(*)"]; ?>)</a></li>
      </ul>
	   
        <div class="tab-pane" id="how-to">
		  <div class="response">
		 <?php while ( $row1 = mysql_fetch_assoc($result1)){  ?>
						<div class="media response-info">
							<div class="media-left response-text-left">
								<a href="#">
									<img class="media-object" src="images/icon1.png" alt="">
								</a>
								<h5><a href="#">Username</a></h5>
							</div>
							<div class="media-body response-text-right">
								<p><?php echo $row1["rev"]; ?></p>
								<ul>
								<li>FOOD:<?php echo $row1["frat"];?></li>
								<li>AMBIANCE:<?php echo $row1["arat"];?></li>
								<li>SERVICE:<?php echo $row1["srat"];?></li>
									
								</ul>
							</div>
							<div class="clearfix"> </div>
						</div>
<?php }?>
			</div>
        </div>
      </div>		
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