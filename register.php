<?php
	include 'connect.php';
	session_start();
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
	
		$sql2 = "Select * from tbluseraccount where username='" . $uname . "' OR emailadd='".$email."'";
		$result = mysqli_query($connection, $sql2);
		$row = mysqli_num_rows($result);

		if ($row == 0) {
			$sql1 = "INSERT INTO tbluserprofile (firstname, lastname, gender, birthdate) VALUES ('$fname', '$lname', '$gender', '$bdate')";
			mysqli_query($connection, $sql1);

			$userid = mysqli_insert_id($connection);
			$regdate = date("Y-m-d");

			$sql2 = "INSERT INTO tbluseraccount (emailadd, username, password, usertype, userid_fk, registration_date) VALUES ('$email', '$uname', '$pword', 'Customer', '$userid', '$regdate')";
			mysqli_query($connection, $sql2);

			//$_SESSION['user_id'] = mysqli_insert_id($connection);
			//added
			//$_SESSION['id'] = $userid;
			//$_SESSION['user_id'] = mysqli_insert_id($connection);
			//$_SESSION['registration_success']=true;

			$_SESSION['status'] = "Succcessfully Registered!";
			$_SESSION['status_code'] = "success";
			//header("location: login.php?from=register");
			header("location: index.php");
		} else {
			$message = "Username or email already existing. Please try again.";
			//$_SESSION['status'] = "Username or email already existing. Please try again.";
			//$_SESSION['status_code'] = "error";
		}
	}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> LoudWave Music </title>
    <link href="images/lwmlogo.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Ojuju:wght@200..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mohave:ital,wght@0,300..700;1,300..700&family=Passion+One:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>
        <?php include 'css/LoudWave.css'; ?>
    </style>
</head>

<body>
    <header>
        <div> 
            <a href="index.php">
                <img src="images/lwmlogo.png" class="indexlogo">
             </a>
            
            <a href="index.php">
                LoudWave Music
            </a>

        </div>

        <div>
            <a href="index.php" class="currnav"> Home </a>
            <a href="#"> Concerts </a>
            <a href="aboutus.php"> About Us </a>
            <a href="contactus.php"> Contact Us </a>
        </div>
        
        <div>
            <?php if(isset($_SESSION['user_id'])): ?>
                <?php if(isset($_SESSION['isOrganizer']) && $_SESSION['isOrganizer']): ?>
                    <a href="concertdetails.php"> Manage Concerts </a>
                    <a href="dashboard.php"> Dashboard </a>
                    <a href="organizer.php"> Profile </a>
                <?php else: ?>
                    <a href="profile.php" class="rightmargin30"> Profile </a>
                <?php endif; ?>
            <?php else: ?>
                <a href="register.php"> Register </a>
                <a href="login.php" id="loginBtnIndex"><img src="Images/icons8-user-material-rounded/icons8-user-24.png" alt=""> Log in </a>
            <?php endif; ?>
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

				<select name="txtgender" id="gender" required>
					<option value=""> Gender </option>
					<option value="Male"> Male</option>
					<option value="Female"> Female</option>
					<option value="Others"> Others </option>
				</select>

				</br>

				<input type="text" name="txtbdate" placeholder="Birthdate" onfocus="(this.type='date')" required> <br>	

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
