<!doctype html>
<html>
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Delete Stock</title>
		<link href="css/simpleGridTemplate.css" rel="stylesheet" type="text/css">
        <style type="text/css">
        	.thumbnail:hover{
				background-color:#FF3639;
			}
			a{color:#FFFFFF;}
        </style>
        <script type="text/javascript">
			function confirmdelete(n){
				if(confirm("Are you sure you want to delete this item ?")) //Confirming if user really wants to delete item
					window.location.href = "deletestock.php?dstock="+n;  //Sending the data of the stock to be delted to php part of code.
			}
		</script>
</head>

<body>

	<div class="container"> 
  <!-- Header -->
    	<h1>DELETE YOUR UPLOADED STOCK</h1>
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
		}
		?>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="openaccountuser.php">Your Account</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="viewstock.php">View Stock</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="searchstock.php">Search</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="uploadstock.php">Upload</a>&nbsp;&nbsp;&nbsp;&nbsp;  
		</h3>
        
        <div class="gallery">
        	<?php
				
				if(isset($_SESSION['username'])){    //if user has signed in to the site
					$username = $_SESSION['username'] ;
            		$link = mysqli_connect("localhost","root","");
					mysqli_select_db($link,"hr");
					
					//if user clicked on the thumbnail of image
					if(isset($_GET['dstock'])){
						$wallid = $_GET['dstock'] ;
						mysqli_query($link,"DELETE FROM walldata WHERE wallid=$wallid");
						echo "<script>alert('Wallpaper deleted.')</script>";
					}
					
					//Displaying the images uploaded by the current signed in user
					$rs = mysqli_query($link,"SELECT * FROM walldata WHERE UploadedBy='$username'");
					if(mysqli_num_rows($rs)>0){  //if user uploaded any image
		  				while($row = mysqli_fetch_row($rs)){
						echo "<center><div class='thumbnail'> 
						  <img src='$row[3]' alt='' width='2000' class='cards' onClick='confirmdelete($row[0])'/>
						  <h4>$row[1]</h4>
      					  <p class='tag'>Details<br/>Resolution : $row[2]<br/>Size : $row[4]<br/>Uploaded By : $row[5]</p>
						  </div></center>";
						}
					}else		//if user didn't upload any image. 
						echo "Sorry, you have not uploaded any wallpapers yet." ;	
				}else   //if user has not signed in to the site
					echo "<h2>Sorry, you must login to delete stock.<br/><br/><a href=index.php>Go to login page</a></h2>" ;
							
			?>
        </div> 
    </div>
</body>
</html>