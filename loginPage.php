<?php
	require_once("support.php");
	
	$topPart = <<<BODY
		<form action="{$_SERVER["PHP_SELF"]}" method="post">

			<h1><center>Welcome to <br>  Projectship </center></h1>
			<h4> <strong> <center> Please login with your UMD credentials </center> </strong>  </h4>

			<b> <center> Directory ID: </center></b>
				<center> <input type="text" name="login" /> </center> <br><br>
			<b> <center> Password: </center></b>
				<center> <input type="password" name="password"/> </center> <br><br>
			
			<center> <input type="submit" name="loginButton" value = "Login" /> </center> <br>
		</form>	
BODY;
	
	if (isset($_SESSION["currUser"])) {
		//session_unset();
		header("Location: homePage.php");
	}

	$bottomPart = "";
	if (isset($_POST["loginButton"])) {
		$loginValue = trim($_POST["login"]);
		$passwordValue = trim($_POST["password"]);
		
		if (($loginValue === "") || ($loginValue !== "cmsc298s") || ($passwordValue === "") || ($passwordValue !== "terps")) {
			$bottomPart = "<center><h1>Invalid login information provided</h1><br /></center>";
		} else {
			header("Location: homePage.php");
		}
	}

	$page = generatePage($topPart.$bottomPart, "Login");
	echo $page;
?>