<!doctype html>
<html>
<head>
<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Sign Up</title>
		<link href="css/simpleGridTemplate.css" rel="stylesheet" type="text/css">
        <style type="text/css">
			h1{font-family: robotofont; font-size:4em;}
			body{margin-left: 80px;}
			input[type="submit"]{width:44.5%; }
			
        </style>
</head>

<body>
	<h1>SIGN UP</h1>
    <form>
    Username : <br/><input type="text" placeholder="Username" name="txtusername"/><br/>
    Password : <br/><input type="text" placeholder="Password" name="txtpassword"/><br/>
    Confirm Password : <br/><input type="text" placeholder="Confirm Password" name="txtconfirmpass"/><br/><br/>
    <input type="submit" name="sbmt" value="Sign Up"/>
    </form>
</body>
</html>
<?php
	// if user clicked the sign up button
	if(isset($_GET['sbmt'])){
		if(!empty($_GET['txtusername']) && !empty($_GET['txtpassword']) && !empty($_GET['txtconfirmpass'])){		//if all fields are not empty
			if($_GET['txtpassword'] == $_GET['txtconfirmpass']){	//if user entered same password both in Password and Confirm Password textboxes.
				$username = $_GET['txtusername'] ;
				$password = $_GET['txtpassword'] ;
				$link = mysqli_connect("localhost","root","");
				mysqli_select_db($link,"hr");
				mysqli_query($link,"INSERT INTO loginmaster VALUES('$username', '$password', 'user', 'activated')") or die("Couldn't sign up!"); //Updating the loginmaster table in database to add another user.
				echo "<script>alert('Account Created.'); window.location.href = \"index.php\"</script>" ; //Alert to user that the account has been created.
			
			}else	//if user doesn't enter the same password in both fields
				echo "<script>alert('Sorry, the password doesn\'t match.')</script>";
		}else		//if user doesn't entered in all fields.
			echo "<script>alert('Sorry, you must enter in all fields.')</script>" ;
	}
?>