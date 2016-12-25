<!doctype html>
<html>
<head>
<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Manage Stock</title>
		<link href="css/simpleGridTemplateAdmin.css" rel="stylesheet" type="text/css">
        <style type="text/css">
        	@font-face{font-family: robotofont; src:url(robotothin.ttf)}
			h1{font-family: robotofont; font-size:4em;}
			input[type="submit"]{width:46%;}
        </style>
        <script type="text/javascript">
			function editdetails(oldname){
        		var newname = prompt("Enter new name : ",oldname) ;//A prompt will appear with a textbox allowing to enter a new name
				var newres = prompt("Enter new resolution : "); //A prompt will apppear with a textbox allowing to enter a new resolution
				window.location.href = "managestock.php?editname="+oldname+" "+newname+" "+newres ; //Sending the data to php part of the code
			}
			function deletestock(n){
				if(confirm("Are You sure you want to delete item "+n)) //A Confirmation box will apppear for the admin if they really want to delete stock
	        		window.location.href = "managestock.php?deletestock="+n ; //Sending the data to php part of code
			}
        </script>
</head>

<body>
	<div class="container"> 
  <!-- Header -->
    <h1>MANAGE STOCK</h1>
    <!-- Navigation bar code Which changes whether it is user or admin-->
    <h3>
    	<?php	
			session_start();
			if($_SESSION['role']=='admin'){ 
				echo "<a href='adminpage.php'>←Go to Dashboard</a>&nbsp;&nbsp;&nbsp;&nbsp";
				echo "<a href='manageuseraccounts.php'>Manage Accounts</a>";
			}
			else{
				echo "<a href='userpage.php'>←Go to Dashboard</a>&nbsp;&nbsp;&nbsp;&nbsp";
				echo "<a href='deletestock.php'>Delete</a>";
			}
		?>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="openaccountuser.php">Your Account</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="viewstock.php">View Stock</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="searchstock.php">Search</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="uploadstock.php">Upload</a>&nbsp;&nbsp;&nbsp;&nbsp;  
    </h3>
 
  <!-- Stats Gallery Section -->
  	<div class="gallery">
    <?php
	$link = mysqli_connect("localhost","root","");
	mysqli_select_db($link,"hr");
	
	//if admin clicked the delete button
	if(isset($_GET['deletestock'])){
		$imgname = $_GET['deletestock'] ;
		mysqli_query($link,"DELETE FROM walldata WHERE Name='$imgname'") or die("Couldn't delete");
		echo "<script>alert('Stock $imgname Deleted.')</script>" ; //Alerting the admin that image has been deleted.
	}
	
	//if admin clicked the edit button
	if(isset($_GET['editname'])){
		$data = $_GET['editname'];
		$arr = explode(" ",$data);  //Getting multiple data in an array
		mysqli_query($link,"UPDATE TABLE walldata SET Name='$arr[1]', Resolution='$arr[2]' WHERE Name='$arr[0]'");
		echo "<script>alert('Stock Edited.')</script>" ;//Alert to user that the database has been modified.
	}
	
	//Code to display the available stock from database.
	$rs = mysqli_query($link,"SELECT * FROM walldata");
	while($row = mysqli_fetch_row($rs)){
			echo "<center><div class='thumbnail'> 
    			  <a href='fullimage.php?imagepath=$row[3]'>
				  <img src='$row[3]' alt='' width='2000' class='cards'/></a>
				  <h4>$row[1]</h4>
      			  <p class='tag'>Details<br/>Resolution : $row[2]<br/>Size : $row[4]<br/>
				  Uploaded By : $row[5]<br/>
				  <input type='submit' name='sbmtedit' value='Edit' onclick='editdetails(\"$row[1]\")'/>
				  <input type='submit' name='sbmtdelete' value='Delete' onclick='deletestock(\"$row[1]\")'/>
				  </p></div></center>";
	}
	?></div>

	</div>

</body>
</html>
