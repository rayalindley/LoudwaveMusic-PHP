<?php    
    session_start();
    include 'connect.php';

    $message="";

    if(isset($_GET['from']) && $_GET['from'] === 'register' && isset($_SESSION['registration_success']) && $_SESSION['registration_success'] === true) {
        $message = "You're almost done! Check your email.";
        unset($_SESSION['registration_success']);
    }

    if (isset($_POST['btnLogin'])) {
        unset($message);
        $emailuname = $_POST['txtemailusername'];
        $password = $_POST['txtpassword'];
    
        $sql1 = "SELECT * FROM tbluseraccount WHERE username = '$emailuname' OR emailadd = '$emailuname'";
        $result = mysqli_query($connection, $sql1);
        echo $sql1;
    
        if($result && mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $hashed_password = $user['password'];
            
            if(password_verify($password, $hashed_password)) {
                $userid = $user['userid_fk'];
                $_SESSION['user_id'] = $userid;
                //$userid =;
                //$_SESSION['user_id'] = mysqli_insert_id($connection);
                //$_SESSION['id'] = $userid;
                //$_SESSION['user_id'] = mysqli_insert_id($connection);
                echo $userid;
                header("location: index.php");
                exit();
            } else {
                $message = "Looks like your email address or password is incorrect. Please try again";
            }
        } else {
            $message = "Looks like your email address or password is incorrect. Please try again";
        }
    }
?>


<style>
    <?php    
        include 'css/LoudWave.css';
    ?>
</style>

<head>
    <title> LoudWave Music - Log In </title>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Ojuju:wght@200..800&display=swap" rel="stylesheet">
</head>

<body>
    <header> 
        <a href="index.php">LoudWave Music</a>
        <a href="loginPage.html"><img src="Images/icons8-person-64.png" alt=""></a>
    </header>

    <div id="menu">
        <a href="aboutUsPage.html"> About Us </a>
        <a href="contactPage.html"> Contact Us </a>
    </div>

    <div>
        <p name="messagebox" class="messagebox"><?php echo $message; ?></p>
    </div>


    <div id="login-container">
        <form method="post" id="registerinputs">
            <input type="text" placeholder="Email Address / Username" name="txtemailusername" required><br><br>
            <input type="password" id="pw" placeholder="Password" name="txtpassword" required><br>
            <input type="checkbox" class="cbshowpass" onclick="showPass()"> Show Password <br><br>
            <input type="submit" value="Log-in" name="btnLogin" id="loginBtn">
        </form>
        <p><a href="!change">Forgot your password?</a></p>
        <p> Don't have an account? <a href="register.php">Register</a></p>
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