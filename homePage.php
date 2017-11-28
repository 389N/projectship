<?php
	require_once("support.php");
	
	$body = <<<BODY
		<form action="{$_SERVER["PHP_SELF"]}" method="post">
			<h1> <center> Who Are We? </center> </h1> <br>
			<h3> <center> The PROJECTSHIP </center> </h1> <br>
			<center> <p style="font-size:20px"> "This website is built in order to provide a <br>
				convenient way for 'Computer Science', 'Business', 'Enginnering' <br>
				students at University of Maryland to <br> 
				seek for new partners for their projects." </p> </center> <br>
			<center> <input type="submit" name="profilePageButton" value = "Profile Page">
			<input type="submit" name="matchingPageButton" value = "Matching Page"> </center><br>
			<center> <input type="submit" name="backToMain" value = "Back to Login Page"> </center>
		</form>
BODY;

	if (isset($_POST["profilePageButton"])) {
		header("Location: profilePage.php");
	}

	if (isset($_POST["matchingPageButton"])) {
		header("Location: matchingPage.php");
	}

	if (isset($_POST["backToMain"])) {
		header("Location: loginPage.php");
	}
	
	$page = generatePage($body, "Projectship");
	echo $page;
?>