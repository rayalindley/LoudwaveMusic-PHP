<?php
	session_start();
	include 'connect.php';

	$message="";

	if (isset ($_POST['btnRegister'])) {
		//for tbluserprofile                                                                                                                                                                                            
		$fname = $_POST['txtfirstname'];
		$lname = $_POST['txtlastname'];
		$gender = $_POST['txtgender'];
		$bdate = $_POST['txtbdate'];
	
		//for tbluseraccount
		$email = $_POST['txtemail'];
		$uname = $_POST['txtusername'];
		$pass = $_POST['txtpassword'];
		$pword = password_hash($pass, PASSWORD_DEFAULT);
	
		$sql2 = "Select * from tbluseraccount where username='" . $uname . "'";
		$result = mysqli_query($connection, $sql2);
		$row = mysqli_num_rows($result);
		if ($row == 0) {
			$sql1 = "INSERT INTO tbluserprofile (firstname, lastname, gender, birthdate) VALUES ('$fname', '$lname', '$gender', '$bdate')";
			mysqli_query($connection, $sql1);

			$userid = mysqli_insert_id($connection);

			$sql2 = "INSERT INTO tbluseraccount (emailadd, username, password, usertype, userid_fk) VALUES ('$email', '$uname', '$pword', 'Customer', '$userid')";
			mysqli_query($connection, $sql2);

			//$_SESSION['user_id'] = mysqli_insert_id($connection);
			//added
			//$_SESSION['id'] = $userid;
			//$_SESSION['user_id'] = mysqli_insert_id($connection);
			$_SESSION['registration_success']=true;
			header("location: login.php?from=register");
			//header("location: index.php");
			exit();
		} else {
			$message = "Username or email already existing. Please try again.";
		}
	}
?>

<style>
	<?php
		include 'css/raya.css';
	?>
</style>

<head>
    <title> LoudWave Music - Register </title>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Ojuju:wght@200..800&display=swap" rel="stylesheet">
</head>

<body>
	<header>
		<div>
			<a href="index.php"> LoudWave Music </a>
		</div>
	</header>

	
	<div class="container">
		<div class="login-container">
			<div id="bsr">
				<div> ~ </div>
				<p> Set up alerts for your favourite artists, so that you never miss a show </p>
				<p> Receive our newsletter and emails about latest shows, news, presales and ticket offers. </p>
				<p> ~ </p>
			</div>

			<div>
				<p name="messagebox" class="messagebox"><?php echo $message; ?></p>
			</div>

			<form method="post" id="registerInputs">
				<input type="text" name="txtfirstname" placeholder="First Name" required> </br>
				<input type="text" name="txtlastname" placeholder="Last Name" required> <br />

				<select name="txtgender" id="gender" required> <br />
					<option value=""> Gender </option>
					<option value="Male"> Male</option>
					<option value="Female"> Female</option>
				</select>

				</br>

				<input type="text" name="txtbdate" placeholder="Birthdate" onfocus="(this.type='date')" required>

				<input type="email" name="txtemail" placeholder="Email address" required> <br />
				<input type="text" name="txtusername" placeholder="Username" required> <br />
				<input type="password" id="pw" name="txtpassword" placeholder="Password" required> <br/>
            	<input type="checkbox" class="cbshowpass" onclick="showPass()"> Show Password <br>

				<br>

				<div id="terms">
					<p>
						We use your information to tell you about tours and artists that we think will interest you based on
						your past ticket purchases, your location, artists you favourite and what genres you would like you
						hear about. Please see our Privacy Notice. For more detail and for your rights around
						personalisation. To unsubscribe, simply click on the link at the bottom of any email we send you.
						Our Terms of Use also apply. Terms of Use.
					</p>
				</div>

				<input type="submit" name="btnRegister" value="Register" id="loginBtn">

			</form>
		</div>
	</div>
</body>

<script language="javascript">
    function showPass() {
        var pass = document.getElementById("pw");
        if (pass.type === "password") {
            pass.type = "text";
        } else {
            pass.type = "password";
        }
    }
</script>   