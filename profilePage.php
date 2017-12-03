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

	$db_connection = new mysqli($host, $user, $dbpassword, $database);
	if ($db_connection->connect_error) {
		die($db_connection->connect_error);
	}

	$currUser = $_SESSION["currUser"];
	$firstName = "";
	$lastName = "";
	$genderM = "";
	$genderF = "";
	$majorCS = "";
	$majorBS = "";
	$majorEN = "";
	$gradeSr = "";
	$gradeJr = "";
	$gradeSp = "";
	$gradeFr = "";
	$numPartners = 1;
	$comments = "";

	$query = "select * from $table";
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

				//Filling in form with current user profile
				
				if ($currUser == $dbEmail) {

						$firstName = $row['firstname'];
						$lastName = $row['lastname'];
						if ($row['gender'] == "Male") {
							$genderM = "checked = checked";
						}
						if ($row['gender'] == "Female") {
							$genderF = "checked = checked";
						}

						if ($row['major'] == "Computer Science") {
							$majorCS = "checked = checked";
						}
						if ($row['major'] == "Business") {
							$majorBS = "checked = checked";
						}
						if ($row['major'] == "Engineering") {
							$majorEN = "checked = checked";
						}

						if ($row['grade'] == "Senior") {
							$gradeSr = "checked = checked";
						}
						if ($row['grade'] == "Junior") {
							$gradeJr = "checked = checked";
						}
						if ($row['grade'] == "Sophomore") {
							$gradeSp = "checked = checked";
						}
						if ($row['grade'] == "Freshman") {
							$gradeFr = "checked = checked";
						}

						$numPartners = $row['numpartners'];
						$comments = $row['comments'];
						$profPic = $row['image'];
				}


			}
		}
		$result->close();
	}  else {
		die("Retrieval failed: ". $db_connection->error);
	}


	$body = <<<BODY
		<form action="confirmationPage.php" method="post" enctype="multipart/form-data">
			<center> <h2> Please fill the blanks. We will match you with people</h2></center>
			<fieldset>
			<legend><em>General Information</em></legend>
			First Name: <input type = "text" name = "firstName" value="$firstName" required="required"> <br>
			Last Name: <input type = "text" name = "lastName" value="$lastName" required="required"> <br> <br>
			Current profile picture: <br> <img src="$profPic" alt="None" width=200px height=200px> <br>
			Change profile picture:
			<input type="file" name="fileToUpload" id="fileToUpload"><br>
			</fieldset>
			<br>

			<fieldset>
			<legend><em>Additional Information</em></legend>
			Gender:
				<br>
				<input type="radio" name="gender" value="Male" $genderM> Male <br>
				<input type="radio" name="gender" value="Female" $genderF> Female <br><br>
			Major:
				<br>
  				<input type="radio" name="major" value="Computer Science" $majorCS> Computer Science<br>
  				<input type="radio" name="major" value="Business" $majorBS> Business<br>
  				<input type="radio" name="major" value="Engineering" $majorEN> Engineering <br><br>
  			Grade:
  				<br>
  				<input type="radio" name = "grade" value="Senior" $gradeSr> Senior <br>
  				<input type="radio" name = "grade" value="Junior" $gradeJr> Junior <br>
  				<input type="radio" name = "grade" value="Sophomore" $gradeSp> Sophomore <br>
  				<input type="radio" name = "grade" value="Freshman" $gradeFr> Freshmen <br>
  				<br>
  			Number of Partners you are looking for:
  				<br>
  				<input type = "number" name ="numPartners" size ="2" min="1" max="10" value="$numPartners">
  			</fieldset>
  			<br>

  			<fieldset>
  				<legend><em>Comments</em></legend>
			Briefly Introduce about yourself:
				<br>
				<textarea id="textfield" name ="comments" rows="7" cols="150">$comments</textarea>
			</fieldset>
			<br>
			<fieldset>
				<input type="reset" value ="Clear Form" />
				<input type="submit" name="submit" value="Submit Information" />
				<input type="button" onclick="location.href='homePage.php';" value="Home Page" />
			</fieldset>
		</form>
BODY;

	$db_connection->close();

	$page = generatePage($body, "Profile");
	echo $page;
?>