<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Light Theme</title>
		<link href="css/simpleGridTemplate.css" rel="stylesheet" type="text/css">
	</head>

    <script type="text/javascript">
		//Javascript function which gets called whenever user inputs in the textbox
        function displayinput(){
        	var ajreq = new XMLHttpRequest();
	        var textbox = document.getElementById("txtsearch").value ;
	        ajreq.onreadystatechange=function(){
    		    if(ajreq.readyState == 4 && ajreq.status == 200){
        		     document.getElementById("display").innerHTML=ajreq.responseText;
        		}
    	   	}
	        ajreq.open("GET","ajaxsearchout.php?searchtext="+textbox,true);
	        ajreq.send(null) ;
		}
    </script>
<body>
<!-- Main Container -->
<div class="container"> 
  <!-- Header -->
    <h1>SEARCH STOCK</h1>
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
	<a href="viewstock.php">View Stock</a>&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="uploadstock.php">Upload</a>&nbsp;&nbsp;&nbsp;&nbsp;  
    </h3>
 
  <!-- Stats Gallery Section -->
  <input type="text" placeholder="Search" id="txtsearch" oninput="displayinput()"/>
  <div class="gallery" id="display">  <!-- div to display ajaxsearchout.php search data -->
  </div>
  
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
