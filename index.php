<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Online E. World</title>
<link href="mycss.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="fl_left">
    	<center><h1>Welcome to Online Entertainment World.</h1>
      </center>
    </div>
    <div class="fl_right">
    	<center><h3>Login as user or admin.</h3><br/>
          <form>
          	<input type="text" placeholder="Username" name="txtusername"/><br/>
          	<input type="password" placeholder="Password" name="txtpassword"/><br/>
          	<input type="submit" name="sbmt" value="Log In"/>
            <input type="submit" name="sbmtsignup" value="Sign Up"/><br/>
          </form>
          <?php
	if(isset($_GET['sbmtsignup'])) 		//if user clicked the sign-up button
		header("location: signup.php"); //they will be taken to the sign-up page to create a new account
		
	//if the user inputted values in both username and password text fields	
	if(isset($_GET['txtusername']) && isset($_GET['txtpassword'])){
		$username = $_GET['txtusername'] ; 
		$password = $_GET['txtpassword'] ;
	
		$link = mysqli_connect("localhost","root","") ;
		mysqli_select_db($link,"hr");
		$resultset = mysqli_query($link,"SELECT * FROM LoginMaster") ;
		
		//Searching the database for the entered username and password data
		while($row = mysqli_fetch_row($resultset)){
			if($username==$row[0] && $password==$row[1]){ //if account exists
				if($row[3]== 'activated'){  //if account is activated
					echo "<h3>Welcome $row[2] $username.</h3>" ;
					session_start() ;		
					$_SESSION['username'] = $username ;
					$_SESSION['role'] = $row[2] ;		//Session cookie is generated
					if($row[2]=='admin')	//if account is of admin
						header("location: adminpage.php");
					else					// if account is of user
						header("location: userpage.php") ;
				}
				else		//if account is deactivated
					echo "<h3>Sorry $username, you account has been deactivated by the admin.</h3>	";
				break;
			}
				
		}
		echo "<h3>Sorry, wrong username or password."; //if no matching account is found or wrong values are inputted.
	}else		//if values are not inputted in username and password fields.
		echo "<div><h3>Enter username and password in the field.</h3></div>" ;
		  ?>
       	</center>
    </div>
</body>
</html>
