<!doctype html>
<html>
<head>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Upload</title>
		<link href="css/simpleGridTemplate.css" rel="stylesheet" type="text/css">
        <style type="text/css">
			input[type="file"],input[type="submit"]
			{	
				width:20%;
				background-color: #4CAF50;
			    border: none;
			    color: white;
			    padding: 16px 32px;
			    text-decoration: none;
			    margin: 4px 2px;
			    cursor: pointer;
			}
			h2{margin-left:5%;}
		</style>
	</head>
</head>

<body>
	<div class="container"> 
  <!-- Header -->
    	<h1>UPLOAD WALLPAPER STOCK</h1>
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
		<a href="searchstock.php">Search</a>&nbsp;&nbsp;&nbsp;&nbsp;
        </h3>
    
        <!-- Stats Gallery Section -->
  		<form method="post" enctype="multipart/form-data">
	  	<input type="text" placeholder="Enter Wallpaper Name." name="txtwallname"/><br/><br/>
        <input type="text" placeholder="Enter Resolution." name="txtres"/><br/><br/> 
        <input type="file" value="Choose Image" name="uploadfile"/>
        <input type="submit" placeholder="Enter Wallpaper Name." name="sbmtupload"/>
        </form>
       
    </div>
</body>
</html>
<?php		
	if(isset($_SESSION['username'])){   //If user has signed in to the site
		$username = $_SESSION['username'] ;
		if($_SESSION['role'] == 'admin') //if the signed in user is admin
			$username = "admin" ;
	
	if(isset($_POST['sbmtupload'])){   //if user clicked the upload button.
		$name = $_POST['txtwallname'] ;  //Getting the name of stock to be uploaded.
		$res = $_POST['txtres'] ;		//Getting additional detail of the stock.
	
		$tempname = $_FILES['uploadfile']['tmp_name'] ;  //Getting the temp. name of uploaded file
		$size=  $_FILES['uploadfile']['size'] ; //Getting the size of the uploaded file
		
		//$tempimage = fopen($tempname,"r");
		//$bimage = fread($tempimage,$size);
		//$image = addslashes($bimage);
		
		$link = mysqli_connect("localhost","root","");
		mysqli_select_db($link,"hr");
		$rs = mysqli_query($link,"SELECT * FROM walldata");
		while($row = mysqli_fetch_row($rs)){$i = $row[0] ;}		//Generating a unique
		$i++ ; 													//path for image
		$imagepath = "./images/Wallpaper$i.jpg" ;				//to be uploaded 
		move_uploaded_file($tempname,$imagepath) or die("Error in uploading file to server or image size is too large.");  //Moving the file to the generated path
		
		$size = ((int)($size/1024))."KB";  //Converting image size from bytes to kilobytes.
		$flag = mysqli_query($link,"INSERT INTO walldata VALUES($i,'$name','$res','$imagepath','$size','$username',0)") or die("Couldn't upload or size is too large.");
		if($flag)  //if stock is successsfully uploaded to server
			echo "<script>alert('Wallpaper uploaded.')</script>" ;
	}
	}else		//if user has not signed in to the site
		echo "<h2>Sorry, you must login to upload stock.<br/><br/><a href=index.php>Go to login page</a></h2>" ;
?>