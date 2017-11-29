/<?php
	require_once("support.php");

	if (session_id() == NULL) {
		session_start();
	}

	$host = "localhost";
	$user = "dbuser";
	$dbpassword = "goodbyeWorld";
	$database = "projectship";
	$table = "userprofiles";

	$currUser = $_SESSION['currUser'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$gender = $_POST['gender'];
	$major = $_POST['major'];
	$grade = $_POST['grade'];
	$numPartners = $_POST['numPartners'];
	$comments = $_POST['comments'];

	$db_connection = new mysqli($host, $user, $dbpassword, $database);
	if ($db_connection->connect_error) {
		die($db_connection->connect_error);
	}

	//UPDATE DATABASE
	$query = "update $table set firstname = \"$firstName\", lastname = \"$lastName\", gender = \"$gender\", major = \"$major\", grade = \"$grade\", numpartners = $numPartners, comments = \"$comments\" where email = \"$currUser\"";

	/* Executing query */
	$result = $db_connection->query($query);
	if (!$result) {
		die("Insertion failed: " . $db_connection->error);
	}


	$body = <<<BODY
		<h1> Following has been added to the Database. </h1>

		First Name: $firstName <br>
		Last Name: $lastName <br>
		Gender: $gender <br>
		Major: $major <br>
		Grade: $grade <br>
		Number of Partners: $numPartners <br>
		Comments: $comments <br>



		<h2> We will match you with people who share same interests. </h2>

		<input type="button" onclick="location.href='profilePage.php';" value="Edit Profile" />
		<input type="button" onclick="location.href='homePage.php';" value="Home Page" />
BODY;

	$page = generatePage($body, "Profile");
	echo $page;
?>