<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>All Stock</title>
		<link href="css/simpleGridTemplate.css" rel="stylesheet" type="text/css">
        <style type="text/css">
        	@font-face{font-family: robotofont; src:url(robotothin.ttf)}
			h1{font-family: robotofont; font-size:4em;}
        </style>
	</head>

<body>
<!-- Main Container -->

<div class="container"> 
  <!-- Header -->
    <h1>VIEW STOCK</h1>
    <!-- Navigation bar code Which changes whether it is user or admin-->
    <h3>
     <?php	
		session_start();
		if($_SESSION['role']=='admin'){ 
			echo "<a href='adminpage.php'>←Go to Dashboard</a>&nbsp;&nbsp;&nbsp;&nbsp";
			echo "<a href=managestock.php>Manage Stock</a>&nbsp;&nbsp;&nbsp;&nbsp";
			echo "<a href='manageuseraccounts.php'>Manage Accounts</a>";
		}
		else{
			echo "<a href='userpage.php'>←Go to Dashboard</a>&nbsp;&nbsp;&nbsp;&nbsp";
			echo "<a href='deletestock.php'>Delete</a>";
		}
	?>&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="openaccountuser.php">Your Account</a>&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="searchstock.php">Search</a>&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="uploadstock.php">Upload</a>&nbsp;&nbsp;&nbsp;&nbsp;  
    </h3> 
 
  <!-- Stats Gallery Section -->
  <div class="gallery">
  <!-- Code to display all available stock from the database -->
  <?php
  		$link = mysqli_connect("localhost","root","");
		mysqli_select_db($link,"hr");
		$rs = mysqli_query($link,"SELECT * FROM walldata");
  		while($row = mysqli_fetch_row($rs)){
			echo "<center><div class='thumbnail'> 
    	<a href='fullimage.php?imagepath=$row[3]'><img src='$row[3]' alt='' width='2000' class='cards'/></a>
      	<h4>$row[1]</h4>
      	<p class='tag'>Details<br/>Resolution : $row[2]<br/>Size : $row[4]<br/>Uploaded By : $row[5]<br/>Views : $row[6]</p>
    </div></center>";
		}
		
  ?></div>
  
  <!--Footer Section -->
    <footer id="contact">
    	<p class="hero_header"></p>
    	<a href="userpage.php?sbmtlogout=1"><div class="button">LOG OUT</div></a>
        <?php if(isset($_GET['sbmtlogout'])){ 
					session_destroy();
					header("location: index.php") ;
				}
		?></footer>
<!-- Main Container Ends -->
</body>
</html>
