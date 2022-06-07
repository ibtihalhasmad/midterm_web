<?php

if (isset($_POST['signup'])) {
    include_once("connect.php");
    $email = $_POST['email'];
    $name = addslashes($_POST['name']);
    $phone = $_POST['phone'];
    $homeaddress = $_POST['homeaddress'];
    $password = sha1($_POST['password']);
    $sqlinsertuser = "INSERT INTO `user_table`(`user_email`, `user_name`, `user_phone`, `user_homeaddress`, `user_password`) 
    VALUES ('$email ','$name','$phone','$homeaddress','$password')";

    try {
        $conn->exec($sqlinsertuser);
        if (file_exists($_FILES["image"]["tmp_name"]) || is_uploaded_file($_FILES["image"]["tmp_name"])) {
            $last_id = $conn->lastInsertId();
            uploadImage($last_id);
            echo "<script>alert('Success')</script>";
            echo "<script>window.location.replace('bacis.php')</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Failed')</script>";
        echo "<script>window.location.replace('login.phh')</script>";
    }
    
}else if (isset($_POST['signin'])){
    include 'connect.php';
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $sqllogin = "SELECT * FROM user_table WHERE user_email = '$email' AND user_password = '$password'";
    $stmt = $conn->prepare($sqllogin);
    $stmt->execute();
    $number_of_rows = $stmt->fetchColumn();
    if($number_of_rows >0){
        echo "<script>alert('Sign in  Success');</script>";
        echo "<script> window.location.replace('bacis.php')</script>"; 
    }else{
        echo "<script>alert('Sign in Failed');</script>";
        echo "<script> window.location.replace('login.php')</script>"; 
    }
}

    function uploadImage($filename)
    {
        $target_dir = "../image/photos/";
        $target_file = $target_dir . $filename . ".png";
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    }

?>

<!DOCTYPE html>

<html>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/login.css">
    <script src="../js/image.js"></script>
   

<body body onload="loadCookies()">

  <h2> MY TUTOR WEBSITE </h2>
</div>
	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form action="login.php" method="post" enctype="multipart/form-data" >
				<h1>Create Account</h1>
                <input type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;">
                <img src="../image/images.png" id="image" width="100">
                <p><label for="file" style="cursor: pointer;">Upload Image</label></p>
                <input type="email" name="email" id="idemail" placeholder="Eenter your email" required />
				<input type="text" name="name" id="idname" placeholder="Eenter your name" required />
                <input type="phone" name="phone" id="iphone" placeholder="Eenter your phone" required />
                <input type="homeaddress" name="homeaddress" id="idhomeaddress" placeholder="Eenter your home address" required />
				<input type="password" name="password" id="idpassword" placeholder="your password" required />
                <button type="signup" name="signup" id="idsignup" >Sign Up </button>

				
			</form>
		</div>
		<div class="form-container sign-in-container" style="text-align:left;">
			<form name="loginform" action="login.php" name="rememberMe" method="post">
				<h1>Sign in</h1>
				<input type="email" name="email" id="idemail" placeholder="Eenter your email" required />
				<input type="password" name="password" id="idpassword" placeholder="Eenter your password" required />
               
                <p>
                    <input class="w3-check" name="rememberme" type="checkbox" id="idremember" onclick="rememberMe()">
                    <label>Remember Me</label>
                </p>

                    <button type="signin" name="signin" id="idsignin">Sign In</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Welcome Back!</h1>
					<p>To keep connected with us please login with your personal info</p>
					<button class="ghost" id="signIn">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Hello, Friend!</h1>
					<p>Enter your personal details and start journey with us</p>
					<button class="ghost" id="signUp">Sign Up</button>
				</div>
			</div>
		</div>
	</div>

	<footer>
		<p>
        <p> copyright halHasmad©</p>
		</p>
	</footer>
	<script type="text/javascript" src="../js/login.js"></script>
</body>

</html>