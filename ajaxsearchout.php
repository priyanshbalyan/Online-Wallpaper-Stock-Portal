<?php
	//Getting the string to be searched in the database.
	$searchtext = $_GET['searchtext'] ;
	echo $searchtext ;
	$link = mysqli_connect("localhost","root","");
	mysqli_select_db($link,"hr");
	
	//Checking if the database contains matching letters to the string in stock names.
	$rs = mysqli_query($link,"SELECT * FROM walldata WHERE name LIKE '$searchtext%'");
	if(mysqli_num_rows($rs) > 0){   //if atleast one matching stock name is found in the database.
		while($row = mysqli_fetch_row($rs)){
			echo "<center><div class='thumbnail'> 
    	<a href='fullimage.php?imagepath=$row[3]'><img src='$row[3]' alt='' width='2000' class='cards'/></a>
      	<h4>$row[1]</h4>
      	<p class='tag'>Details<br/>Resolution : $row[2]<br/>Size : $row[4]<br/>Uploaded By : $row[5]</p>
    </div></center>"; 
		}
	}else 		//if no matching stock names are found in the database.
		echo "<br/>Sorry, No results found." ;
?>