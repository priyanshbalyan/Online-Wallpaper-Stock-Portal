<!doctype html>
<html>
<head>
<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Manage User Accounts</title>
		<link href="css/simpleGridTemplateAdmin.css" rel="stylesheet" type="text/css">
        <style type="text/css">
        	@font-face{font-family: robotofont; src:url(robotothin.ttf)}
			h1{font-family: robotofont; font-size:3em; color:#FFFFFF;}
			input[type="submit"],
			input[type="reset"]
			{
				width:45%;
				background-color: #009688;
			    border: none;
			    color: white;
			    padding: 16px 8px;
			    margin: 4px 2px;
			    cursor: pointer;
			}
			input[type="submit"]: hover{
			background-color: #000000 ;
			}
        </style>
        <script type="text/javascript">
			function editdetails(pos){
				var name = prompt("Enter new name : "+pos,"Name");
			}
			function deleteuser(pos){
				alert("Delete"+pos);
			}
		</script>
</head>

<body>
	<div class="container"> 
  <!-- Header -->
    	<h1>MANAGE USER ACCOUNTS</h1>
        <!-- Navigation bar code Which changes whether it is user or admin-->
    	<h3>
        	<?php	
			session_start();
			if($_SESSION['role']=='admin'){ 
				echo "<a href='adminpage.php'>←Go to Dashboard</a>&nbsp;&nbsp;&nbsp;&nbsp";
				echo "<a href=managestock.php>Manage Stock</a>&nbsp;&nbsp;&nbsp;&nbsp";
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
    
    <div class='gallery'>
 		<?php
			$link = mysqli_connect("localhost","root","");
			mysqli_select_db($link,"hr");
			
			//if user clicked the edit button after setting role and status radio buttons
			if(isset($_GET['editaccount']) && isset($_GET['role']) && isset($_GET['status'])){
				$arr = explode(" ",$_GET['editaccount']);//Getting which button clicked in $arr[1]
				$role = $_GET['role'];
				$status = $_GET['status'];
				
				mysqli_query($link,"UPDATE loginmaster SET Role='$role', Status='$status' WHERE LoginID='$arr[1]'") or die("Couldn't update login data"); //Updating user data in database
			}
			
			//if user clicked the delete button
			if(isset($_GET['delaccount'])){
				$arr = explode(" ",$_GET['delaccount']) ; //same as before
				echo "<script>alert('This account will be deleted.')</script>" ;
				mysqli_query($link,"DELETE FROM loginmaster WHERE LoginID='$arr[1]'") or die("Couldn't delete.");
			}
			
			
			//Code to display all user accounts with edit and delete buttons below them
			$rs = mysqli_query($link,"SELECT * FROM loginmaster");
			while($row = mysqli_fetch_row($rs)){
				//Echoing user details
				echo "<center><div class='thumbnail'> 
    				  <a href='manageuseraccounts.php?imagepath=0'>
					  <img src='images/profile.png' alt='' width='2000' class='cards'/></a>
					  <h4>Username : $row[0]</h4>
					  <p class='tag'>Password : $row[1]<br/>Role : $row[2]<br/>Status : $row[3]";
				//Echoing form data 
				echo "<br/><br/><form>
					  Admin<input type='radio' value='admin' name='role'>
					  User<input type='radio' value='user' name='role'><br/>
					  Activated<input type='radio' value='activated' name='status'>
				Deactivated<input type='radio' value='deactivated' name='status'><br/>
					  <input type='submit' name='editaccount' value='Edit $row[0]'/>
					  <input type='submit' name='delaccount' value='Delete $row[0]'/>
					  </form></p></div></center>";
			}			
		?>
	</div>
	</div>
</body>
</html>