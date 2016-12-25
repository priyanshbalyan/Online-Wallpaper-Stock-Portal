<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>My Account</title>
	<link href="css/simpleGridTemplate.css" rel="stylesheet" type="text/css">
    <style type="text/css">
		body{background:url(images/openaccountuserbg.jpg);margin-left:10%; }
		h1{font-size:2em;}
		input[type="text"], 
		input[type="password"] {
			width: 33%;
    		padding: 12px 20px;
		    margin: 8px 0;
			transition: all 0.3s linear;
		}
		input[type="submit"]{width:18%;}
	</style>
</head>

<body>
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
			echo "<h3><a href='userpage.php'>←Go to Dashboard</a>&nbsp;&nbsp;&nbsp;&nbsp";
			echo "<a href='deletestock.php'>Delete</a>";
	}
	?>&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="viewstock.php">View Stock</a>&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="searchstock.php">Search</a>&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="uploadstock.php">Upload</a>&nbsp;&nbsp;&nbsp;&nbsp;  
    </h3>
</body>
</html>
<?php
	$link = mysqli_connect("localhost","root","");
	mysqli_select_db($link,"hr");
	
	if(isset($_SESSION['username'])){		//if user has signed in to the site
		$username = $_SESSION['username'] ; 
		
		//Getting current signed in user's data from the database.
		$rs = mysqli_query($link, "SELECT * FROM loginmaster WHERE LoginID='$username'") ;
		$row = mysqli_fetch_row($rs);
		echo "<h1>LoginID : $row[0] <br/>Password : $row[1]<br/>Account : $row[2]<br/><br/>Status : $row[3]</h1>" ;
		
		//Displaying text boxes if user wants to edit current data.
		echo "<form><input type='text' placeholder='Enter New username' name='txtnu'/><br/><input type='text' placeholder='Enter password' name='txtnp'/><br/><input type='submit' name='sbmtnedit' value='Edit Account Details'/></span><input type='submit' name='sbmtlogout' value='Sign Out'/></form>";
		
		//if user entered new values and clicked edit button
		if(isset($_GET['txtnu']) && ($_GET['txtnp']) && isset($_GET['sbmtnedit'])){
			$newuser = $_GET['txtnu'];
			$newpass = $_GET['txtnp'];
			mysqli_query($link,"UPDATE loginmaster SET LoginID='$newuser', Password='$newpass' WHERE LoginID='$row[0]'");
			echo "<script>alert('Login Details changed.')</script>";	
			$_SESSION['username'] = $newuser;  //Changing current session cookie
		}
		
		if(isset($_GET['sbmtlogout'])){  // if user clicked log out button
			session_destroy() ;
			header("location:index.php");  //Go back to login page
		}
		
	}else   //if user has not signed in to the site
		echo "<h1>Sorry, you must login to see your account details.<br/><br/><a href=index.php>Go to login page</a></h1>" ;
		
			
?>