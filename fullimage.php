<?php
	//Code to increase the no. of views on the stock by 1
	$path = $_GET['imagepath'];
	$link = mysqli_connect("localhost","root","");
	mysqli_select_db($link,"hr");
	$rs = mysqli_query($link,"SELECT * FROM walldata WHERE image='$path'") or die("Couldn't load mage");
	$row = mysqli_fetch_row($rs);
	$i = (int)$row[6];    //Getting the no. of views on the image from database
	$i++ ;					//Increasing it by 1
	mysqli_query($link,"UPDATE walldata SET views=$i WHERE image='$path'"); //Updating views
	
	//Displaying the image fullscreen
	echo "<img src='$path' width=100% height=100% />" ;
?>