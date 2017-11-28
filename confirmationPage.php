/<?php
	require_once("support.php");

	// firstName = $_POST['firstName'];
	// lastName = $_POST['lastName'];
	$body = <<<BODY
		<form action="{$_SERVER["PHP_SELF"]}" method="post">
			<h1> Following has been added to the Database. <h1>
			<h2> We will match you with people who share same interests. <h2>

			<input type="submit" name="editProfile" value ="Edit Profile" />
			<input type="submit" name="backToHome" value="Back to Homepage" />
		</form>
BODY;
	if (isset($_POST["backToHome"])) {
		header("Location: homePage.php");
	}
	if (isset($_POST["editProfile"])) {
		header("Location: profilePage.php");
	}
	$page = generatePage($body, "Profile");
	echo $page;
?>