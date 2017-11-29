<?php
	require_once("support.php");

	if (session_id() == NULL) {
		session_start();
	}

	$host = "localhost";
	$user = "dbuser";
	$dbpassword = "goodbyeWorld";
	$database = "projectship";
	$table = "userprofiles";

	/* Connecting to the database */		
	$db_connection = new mysqli($host, $user, $dbpassword, $database);
	if ($db_connection->connect_error) {
		die($db_connection->connect_error);
	}
	
	$topPart = <<<BODY
		<form action="{$_SERVER["PHP_SELF"]}" method="post">

			<h1><center>Welcome to <br>  Projectship </center></h1>
			<h4> <strong> <center> Please login </center> </strong>  </h4>

			<b> <center> Email: </center></b>
				<center> <input type="email" name="email" required="required"/> </center> <br><br>
			<b> <center> Password: </center></b>
				<center> <input type="password" name="password" required="required"/> </center> <br><br>
			
			<center> <input type="submit" name="loginButton" value = "Login" />
			<input type="button" onclick="location.href='signupPage.php';" value="Sign Up" /> </center> <br>
		</form>	
BODY;
	
	if (isset($_SESSION["currUser"])) {
		//session_unset();
		header("Location: homePage.php");
	}

	$bottomPart = "";

	if (isset($_POST["loginButton"])) {
		$email = trim($_POST["email"]);
		$password = trim($_POST["password"]);

		//CHECK DB FOR LOGIN

		/* VERIFY EMAIL AND PASSWORD */
		$verified = false;
		$query = "select email, password from $table";
		$result = $db_connection->query($query);
		if ($result) {
			$num_rows = $result->num_rows;
			if ($num_rows === 0) {
				echo "Empty Table<br>";
			} else {
				for ($row_index = 0; $row_index < $num_rows; $row_index++) {
					$result->data_seek($row_index);
					$row = $result->fetch_array(MYSQLI_ASSOC);

					$dbEmail = $row['email'];
					$dbPass = $row['password'];
					$passMatch = password_verify($password, $dbPass);
					
		     		if ($email == $dbEmail && $passMatch){
			     		$verified = true;
		     		}
				}
			}
			$result->close();
		}  else {
			die("Retrieval failed: ". $db_connection->error);
		}
		
		if ($email == "" || $password == "") {
			$bottomPart = "<center><h1>Invalid login information provided</h1><br /></center>";
		} else if (!$verified) {
			$bottomPart = "<center><h1>Email and password did not match</h1><br /></center>";
		} else {
			$_SESSION['currUser'] = $email;
			header("Location: homePage.php");
		}
	}

	$db_connection->close();

	$page = generatePage($topPart.$bottomPart, "Login");
	echo $page;
?>