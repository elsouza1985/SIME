<?php
    session_start();
    include('connection.php');

    if(isset($_POST['addsite'])){
    	$fullname = strip_tags($_POST['txtfullname']);
    	$email = strip_tags($_POST['txtemail']);
    	$gender = strip_tags($_POST['cboGender']);
    	$bdate = strip_tags($_POST['txtbdate']);
    	$address = strip_tags($_POST['txtaddress']);

    	$fullname = mysqli_real_escape_string($db, $fullname);
    	$email = mysqli_real_escape_string($db, $email);
      	$gender = mysqli_real_escape_string($db, $gender);
      	$bdate = mysqli_real_escape_string($db, $bdate);
      	$address = mysqli_real_escape_string($db, $address);
		
		$arquivo  = isset($_FILES["image"])  ? $_FILES["image"] : FALSE;  
		$name = $arquivo["name"];
		$type = $arquivo["type"];
		$size = $arquivo["size"];
		$temp = $arquivo["tmp_name"];
		$error = $arquivo["error"];

    	$sql = "INSERT INTO tblpersonalinfo VALUES(NULL,'$fullname' ,'$email', '$gender', '$bdate', '$address' ,'uploads/$name')";

		if ($error > 0) {
    		die("Upload an image please!");
    	} else {
			if($size > 100000000000){
				die("Format is not allowed or file size is too big!");
			}
			else{
	     		if (mysqli_query($db, $sql)){
					move_uploaded_file($temp,"uploads/".$name);
					header('location:data.php');
				}
				else{
				 	die('Unable to insert data:' .mysqli_error());
				}
			}
    	}
    }
?>