<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Dashboard (Admin)</title>
		<link href="css/simpleGridTemplateAdmin.css" rel="stylesheet" type="text/css">
	</head>

<body>
<!-- Main Container -->
<div class="container"> 
  <!-- Header -->
  <header class="header">
    <h4 class="logo">Online Entertainment World</h4>
  </header>
  <!-- Hero Section -->
  <section class="intro">
    <div class="column">
      <h3>Welcome ADMINISTRATOR</h3>
      <img src="images/profile.png" alt="" class="profile"> </div>
    <div class="column"> 
    	<p>Welcome to Online Entertainment World. Here you can manage your account, manage wallpapers and also browse our large collection of latest HD images. You can also check your account, status and search in our vast database and edit or delete stock.</p>
    </div>
  </section>
  
  <!-- Stats Gallery Section. Displaying the data in a grid-->
  <div class="gallery">
  
  	<div class="thumbnail"> 
    	<a href="openaccountuser.php"><img src="images/openaccount.jpg" alt="" width="2000" class="cards"/></a>
      	<h4>YOUR ACCOUNT</h4>
      	<p class="tag">View Account Details.</p>
    </div>
    
    <div class="thumbnail"> 
    	<a href="viewstock.php"><img src="images/view.jpg" alt="" width="2000" class="cards"/></a>
      	<h4>VIEW STOCK</h4>
      	<p class="tag">View all stock.</p>
    </div>
      
  	<div class="thumbnail"> 
    	<a href="searchstock.php"><img src="images/search.jpg" alt="" width="2000" class="cards"/></a>
      	<h4>SEARCH STOCK</h4>
      	<p class="tag">Search by Wallpaper Name.</p>
    </div>
    
    <div class="thumbnail"> 
    	<a href="uploadstock.php"><img src="images/upload.jpg" alt="" width="2000" class="cards"/></a>
      	<h4>UPLOAD STOCK</h4>
      	<p class="tag">Upload you own wallpaper</p>
  	</div>
    
     <div class="thumbnail"> 
    	<a href="managestock.php"><img src="images/managestock.jpg" alt="" width="2000" class="cards"/></a>
      	<h4>MANAGE STOCK</h4>
      	<p class="tag">Add, remove or change details of the stock.</p>
    </div>
    
    <div class="thumbnail"> 
    	<a href="manageuseraccounts.php"><img src="images/manageuseraccounts.jpg" alt="" width="2000" class="cards"/></a>
      	<h4>MANAGE USER ACCOUNTS</h4>
      	<p class="tag">Activate, Deactivate or Delete user accounts.</p>
    </div>
    
  </div>
  
  <!--Footer Section -->
    <footer id="contact">
    	<p class="hero_header"></p>
    	<a href="adminpage.php?logout=1"><div class="button">LOG OUT</div></a>
  	</footer>
<!-- Main Container Ends -->
</body>
</html>
<?php
	if(isset($_GET['logout'])){ 
		session_destroy();
		header("location: index.php") ;
	}
?>