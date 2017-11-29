<?php
	require_once("support.php");

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
			<h4> <strong> <center> Create an account </center> </strong>  </h4>

			<b> <center> Email: </center></b>
				<center> <input type="email" name="email" required="required"/> </center> <br><br>
			<b> <center> Password: </center></b>
				<center> <input type="password" name="password" required="required"/> </center> <br><br>
			<b> <center> Re-enter Password: </center></b>
				<center> <input type="password" name="repassword" required="required"/> </center> <br><br>
			
			<center> <input type="submit" name="createAccount" value = "Create Account" /> </center> <br>
		</form>	
BODY;
	
	$bottomPart = "";

	if (isset($_POST["createAccount"])) {
		$email = trim($_POST["email"]);
		$password = trim($_POST["password"]);
		$repassword = trim($_POST["repassword"]);

		/* CHECK IF EMAIL ALREADY EXISTS */
		$emailTaken = false;
		$query = "select email from $table";
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
		     		if ($email == $dbEmail){
			     		$emailTaken = true;
		     		}
				}
			}
			$result->close();
		}  else {
			die("Retrieval failed: ". $db_connection->error);
		}


		//Login Validation
		if ($email == "" || $password == "" || $repassword == "" || $password != $repassword) {
			$bottomPart = "<center><h1>Invalid login information provided</h1><br /></center>";
		} else if ($emailTaken) {
			$bottomPart = "<center><h1>An account with that email already exists</h1><br /></center>";
		} else {			
			$hashpass = password_hash($password, PASSWORD_DEFAULT);

			/* Query */
			$query = "insert into $table (email, password) values(\"$email\", \"$hashpass\")";

			/* Executing query */
			$result = $db_connection->query($query);
			if (!$result) {
				die("Insertion failed: " . $db_connection->error);
			}

			header("Location: accountCreated.html");
		}
	}
	
	$db_connection->close();

	$page = generatePage($topPart.$bottomPart, "Create Account");
	echo $page;
?>