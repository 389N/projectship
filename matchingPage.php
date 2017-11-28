<?php
	require_once("support.php");

	$body = <<<BODY
		<form action="{$_SERVER["PHP_SELF"]}" method="post">
			<center><h1> Here are the "Matched" friends! </h1></center><br>

			<center> <input type="submit" name="backToHome" value="Back to Homepage" /> </center>
		</form>
BODY;
	
	if (isset($_POST["backToHome"])) {
		header("Location: homePage.php");
	}

	$page = generatePage($body, "Matching");
	echo $page;
?>