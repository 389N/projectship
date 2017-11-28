/<?php
	require_once("support.php");

	$body = <<<BODY
		<form action="confirmationPage.php" method="post">
			<center> <h2> Please fill the blanks. We will match you with people</h2></center>
			<fieldset>
			<legend><em>General Information</em></legend>
			First Name: <input type = "text" name = "firstName"> <br>
			Last Name: <input type = "text" name = "lastName"> <br><br>
			Email: <input type = "email" name ="email"><br>
			</fieldset>
			<br>

			<fieldset>
			<legend><em>Additional Information</em></legend>
			Gender:
				<br>
				<input type="radio" name="gender" value="Male"> Male <br>
				<input type="radio" name="gender" value="Female"> Female <br><br>
			Major:
				<br>
  				<input type="radio" name="major" value="Computer Science"> Computer Science<br>
  				<input type="radio" name="major" value="Business"> Business<br>
  				<input type="radio" name="major" value="Engineering"> Engineering <br><br>
  			Grade:
  				<br>
  				<input type="radio" name = "grade" value="Senior"> Senior <br>
  				<input type="radio" name = "grade" value="Junior"> Junior <br>
  				<input type="radio" name = "grade" value="Sophomore"> Sophomore <br>
  				<input type="radio" name = "grade" value="Freshman"> Freshmen <br>
  				<br>
  			Number of Partners you are looking for:
  				<br>
  				<input type = "number" name ="partners" size ="2" min="1" max="10">
  			</fieldset>
  			<br>

  			<fieldset>
  				<legend><em>Comments</em></legend>
			Briefly Introduce about yourself:
				<br>
				<textarea id="textfield" name ="comments" rows="7" cols="150"></textarea>
			</fieldset>
			<br>
			<fieldset>
				<input type="reset" value ="Clear Form" />
				<input type="submit" name="submitForm" value="Submit Information" />
				<input type="submit" name="backToHome" value="Back to Homepage" />
			</fieldset>
		</form>
BODY;
	if (isset($_POST["submitForm"])) {
		header("Location: confirmationPage.php");
	}

	if (isset($_POST["backToHome"])) {
		header("Location: homePage.php");
	}
	$page = generatePage($body, "Profile");
	echo $page;
?>