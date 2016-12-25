<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Dashboard</title>
		<link href="css/simpleGridTemplate.css" rel="stylesheet" type="text/css">
	</head>

<body>
<!-- Main Container -->
<div class="container"> 
  <!-- Header -->
  <header class="header">
    <h4 class="logo">ONLINE ENTERTAINMENT WORLD</h4>
  </header>
  <!-- Hero Section -->
  <section class="intro">
    <div class="column">
      <h3>Welcome <?php 
	  				session_start(); 
					if(isset($_SESSION['username']))
						echo $username = $_SESSION['username'] ;
					else
						header("location:index.php");
	  			  ?></h3>
      <img src="images/profile.png" alt="" class="profile"> </div>
    <div class="column"> 
    	<p>Welcome to Wallpaper Stock Portal. Here you can manage your account, view wallpapers and also browse our large collection of latest HD images. You can also check your account, status and search in our vast database and can manage your uploaded images.</p>
    </div>
  </section>
  <!-- Stats Gallery Section -->
  <div class="gallery">
    <div class="thumbnail"> 
    	<a href="openaccountuser.php"><img src="images/openaccount.jpg" alt="" width="2000" class="cards"/></a>
      	<h4>YOUR ACCOUNT</h4>
      	<p class="tag">View account details</p>
        
    </div>
    
    <div class="thumbnail"> 
    	<a href="viewstock.php"><img src="images/view.jpg" alt="" width="2000" class="cards"/></a>
      	<h4>VIEW STOCK</h4>
      	<p class="tag">Look for Wallpaper details</p>
               
    </div>
    
    <div class="thumbnail"> 
    	<a href="searchstock.php"><img src="images/search.jpg" alt="" width="2000" class="cards"/></a>
      	<h4>SEARCH STOCK</h4>
      	<p class="tag">Search the stock by name</p>
    </div>
    
    <div class="thumbnail"> 
    	<a href="uploadstock.php"><img src="images/upload.jpg" alt="" width="2000" class="cards"/></a>
      	<h4>UPLOAD STOCK</h4>
      	<p class="tag">Upload you own wallpaper</p>
    	</div>
  	</div>
    
  <div class="gallery">
    <div class="thumbnail"> 
    	<a href="deletestock.php"><img src="images/deletestock.jpg" alt="" width="2000" class="cards"/></a>
      	<h4>DELETE STOCK</h4>
      	<p class="tag">Delete your own uploaded wallpapers</p>
    </div>
  
  <!--Footer Section -->
    <footer id="contact">
    	<p class="hero_header"></p>
    	<a href="userpage.php?sbmtlogout=1"><div class="button">LOG OUT</div></a>
  	</footer>
<!-- Main Container Ends -->
</body>
</html>
<?php
	
	if(isset($_GET['sbmtlogout'])){ 
		session_destroy();
		header("location: index.php") ;
	}
?>