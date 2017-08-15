<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Create Account</title>
		<link rel="icon" type="image/png" href="imgs/phpLogo.png"/>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
	<header>
		<h1>Santa Monica Movie Rentals</h1>
		<h2>Movies - TV Shows - Video Games</h2>
		<nav>
			<a href="index.php">Home</a>
			<a href="inventory.php">Inventory</a>
			<a href="booking.php">Booking</a> 
			<a href="customers.php">Customers</a>
		</nav>
	</header>
	<?php 
	require("class/customerClass.php");
	require("class/DAOcustomerClass.php");

  	$customer= new Customer();
  	$dao= new CustomerDAO();
  
  	if ($_SERVER["REQUEST_METHOD"] == "POST")
  	{
  		$customer->setFirstName($_POST["firstName"]);
  		$customer->setLastName($_POST["lastName"]);
  		$customer->setDateOfBirth($_POST["dateOfBirth"]);
  		$customer->setGender($_POST["gender"]);
  		$customer->setAddress1($_POST["address1"]);
  		$customer->setAddress2($_POST["address2"]);
  		$customer->setCity($_POST["city"]);
  		$customer->setState($_POST["state"]);
  		$customer->setPhoneNumber($_POST["phoneNumber"]);
  		$customer->setEmailAddress($_POST["eMail"]);  
  		$customer->setPassword($_POST["password"],$_POST["passwordRepeat"]);
  		$customer->setAction($_POST["action"]);
  		$customer->setChildren($_POST["children"]);
  		$customer->setComedy($_POST["comedy"]);
  		$customer->setDocumentary($_POST["documentary"]);
  		$customer->setDrama($_POST["drama"]);
  		$customer->setHorror($_POST["horror"]);
  		$customer->setMusicals($_POST["musicals"]);
  		$customer->setRomance($_POST["romance"]);
  		$customer->setScienceFiction($_POST["scienceFiction"]);
  		$customer->setThriller($_POST["thriller"]);
  		$customer->setNotes($_POST["notes"]);
  	
  	//Database Insert
	if ($customer->formCustomerCreateCheck($customer->getFirstNameErr(), $customer->getLastNameErr(), $customer->getGenderErr(), $customer->getAddress1Err(), $customer->getCityErr(), $customer->getStateErr(), $customer->getPhoneNumberErr(), $customer->getEMailErr(), $customer->getPasswordErr(), $customer->getPasswordRepeatErr(), $customer->getFirstName(), $customer->getLastName(), $customer->getGender(), $customer->getAddress1(), $customer->getCity(), $customer->getState(), $customer->getEMailAddress(), $customer->getPassword(), $customer->getPasswordRepeat())=="FORM COMPLETE")
		{
		echo $dao->createCustomerRecord($customer->getFirstName(), $customer->getLastName(),$customer->getDateOfBirth(), $customer->getGender(), $customer->getAddress1(), $customer->getAddress2(), $customer->getCity(), $customer->getState(), $customer->getPhoneNumber(), $customer->getEmailAddress(), $customer->getPassword(), $customer->getAction(), $customer->getChildren(), $customer->getComedy(), $customer->getDocumentary(), $customer->getDrama(), $customer->getHorror(), $customer->getMusicals(), $customer->getRomance(), $customer->getScienceFiction(), $customer->getThriller(), $customer->getNotes());
		}
  	}

	?>
	<main>
		<h1>Create Account</h1>
		<h2 class="error">* required field.</h2>
		<form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="on" method="post">
			<fieldset>
				<legend>Personal Information</legend>
				First Name: 
				<input type="text" name="firstName" value="<?php echo $customer->getFirstName();?>">	
				<span class="error">* <?php echo $customer->getFirstNameErr();?></span>
				<br><br>
				Last Name: 
				<input type="text" name="lastName" value="<?php echo $customer->getLastName();?>">	
				<span class="error">* <?php echo $customer->getLastNameErr();?></span>
				<br><br>
				Date of Birth:
				<input type="date" name="dateOfBirth" value="<?php echo $customer->getDateOfBirth();?>">
				<br><br>
				Gender:
				<input type="radio" name="gender" <?php if($customer->getGender()!== NULL and $customer->getGender()=="M"){echo "checked";}?> value="M">Male
				<input type="radio" name="gender" <?php if($customer->getGender()!== NULL and $customer->getGender()=="F"){echo "checked";}?> value="F">Female
				<span class="error">* <?php echo $customer->getGenderErr();?></span>
				<br><br>
			</fieldset>
			<fieldset>
				<legend>Address Information</legend>
				Address 1: 
				<input type="text" name="address1" value="<?php echo $customer->getAddress1();?>">	
				<span class="error">* <?php echo $customer->getAddress1Err();?></span>
				<br><br>
				Address 2: 
				<input type="text" name="address2" value="<?php echo $customer->getAddress2();?>">	
				<br><br>
				City: 
				<input type="text" name="city" value="<?php echo $customer->getCity();?>">	
				<span class="error">* <?php echo $customer->getCityErr();?></span>
				<br><br>
				State:
				<select name="state">
				<option value="AL" <?php if($customer->getState()=="AL") {echo 'selected';}?>>Alabama</option>
				<option value="AK" <?php if($customer->getState()=="AK") {echo 'selected';}?>>Alaska</option>
				<option value="AZ" <?php if($customer->getState()=="AZ") {echo 'selected';}?>>Arizona</option>
				<option value="AR" <?php if($customer->getState()=="AR") {echo 'selected';}?>>Arkansas</option>
				<option value="CA" <?php if($customer->getState()=="CA") {echo 'selected';}?>>California</option>
				<option value="CO" <?php if($customer->getState()=="CO") {echo 'selected';}?>>Colorado</option>
				<option value="CT" <?php if($customer->getState()=="CT") {echo 'selected';}?>>Connecticut</option>
				<option value="DE" <?php if($customer->getState()=="DE") {echo 'selected';}?>>Delaware</option>
				<option value="DC" <?php if($customer->getState()=="DC") {echo 'selected';}?>>District Of Columbia</option>
				<option value="FL" <?php if($customer->getState()=="FL") {echo 'selected';}?>>Florida</option>
				<option value="GA" <?php if($customer->getState()=="GA") {echo 'selected';}?>>Georgia</option>
				<option value="HI" <?php if($customer->getState()=="HI") {echo 'selected';}?>>Hawaii</option>
				<option value="ID" <?php if($customer->getState()=="ID") {echo 'selected';}?>>Idaho</option>
				<option value="IL" <?php if($customer->getState()=="IL") {echo 'selected';}?>>Illinois</option>
				<option value="IN" <?php if($customer->getState()=="IN") {echo 'selected';}?>>Indiana</option>
				<option value="IA" <?php if($customer->getState()=="IA") {echo 'selected';}?>>Iowa</option>
				<option value="KS" <?php if($customer->getState()=="KS") {echo 'selected';}?>>Kansas</option>
				<option value="KY" <?php if($customer->getState()=="KY") {echo 'selected';}?>>Kentucky</option>
				<option value="LA" <?php if($customer->getState()=="LA") {echo 'selected';}?>>Louisiana</option>
				<option value="ME" <?php if($customer->getState()=="ME") {echo 'selected';}?>>Maine</option>
				<option value="MD" <?php if($customer->getState()=="MD") {echo 'selected';}?>>Maryland</option>
				<option value="MA" <?php if($customer->getState()=="MA") {echo 'selected';}?>>Massachusetts</option>
				<option value="MI" <?php if($customer->getState()=="MI") {echo 'selected';}?>>Michigan</option>
				<option value="MN" <?php if($customer->getState()=="MN") {echo 'selected';}?>>Minnesota</option>
				<option value="MS" <?php if($customer->getState()=="MS") {echo 'selected';}?>>Mississippi</option>
				<option value="MO" <?php if($customer->getState()=="MO") {echo 'selected';}?>>Missouri</option>
				<option value="MT" <?php if($customer->getState()=="MT") {echo 'selected';}?>>Montana</option>
				<option value="NE" <?php if($customer->getState()=="NE") {echo 'selected';}?>>Nebraska</option>
				<option value="NV" <?php if($customer->getState()=="NV") {echo 'selected';}?>>Nevada</option>
				<option value="NH" <?php if($customer->getState()=="NH") {echo 'selected';}?>>New Hampshire</option>
				<option value="NJ" <?php if($customer->getState()=="NJ") {echo 'selected';}?>>New Jersey</option>
				<option value="NM" <?php if($customer->getState()=="NM") {echo 'selected';}?>>New Mexico</option>
				<option value="NY" <?php if($customer->getState()=="NY") {echo 'selected';}?>>New York</option>
				<option value="NC" <?php if($customer->getState()=="NC") {echo 'selected';}?>>North Carolina</option>
				<option value="ND" <?php if($customer->getState()=="ND") {echo 'selected';}?>>North Dakota</option>
				<option value="OH" <?php if($customer->getState()=="OH") {echo 'selected';}?>>Ohio</option>
				<option value="OK" <?php if($customer->getState()=="OK") {echo 'selected';}?>>Oklahoma</option>
				<option value="OR" <?php if($customer->getState()=="OR") {echo 'selected';}?>>Oregon</option>
				<option value="PA" <?php if($customer->getState()=="PA") {echo 'selected';}?>>Pennsylvania</option>
				<option value="RI" <?php if($customer->getState()=="RI") {echo 'selected';}?>>Rhode Island</option>
				<option value="SC" <?php if($customer->getState()=="SC") {echo 'selected';}?>>South Carolina</option>
				<option value="SD" <?php if($customer->getState()=="SD") {echo 'selected';}?>>South Dakota</option>
				<option value="TN" <?php if($customer->getState()=="TN") {echo 'selected';}?>>Tennessee</option>
				<option value="TX" <?php if($customer->getState()=="TX") {echo 'selected';}?>>Texas</option>
				<option value="UT" <?php if($customer->getState()=="UT") {echo 'selected';}?>>Utah</option>
				<option value="VT" <?php if($customer->getState()=="VT") {echo 'selected';}?>>Vermont</option>
				<option value="VA" <?php if($customer->getState()=="VA") {echo 'selected';}?>>Virginia</option>
				<option value="WA" <?php if($customer->getState()=="WA") {echo 'selected';}?>>Washington</option>
				<option value="WV" <?php if($customer->getState()=="WV") {echo 'selected';}?>>West Virginia</option>
				<option value="WI" <?php if($customer->getState()=="WI") {echo 'selected';}?>>Wisconsin</option>
				<option value="WY" <?php if($customer->getState()=="WY") {echo 'selected';}?>>Wyoming</option>
				</select>
				<span class="error">* <?php echo $customer->getStateErr();?></span>
				<br><br>
				Phone Number:
				<input type="tel" name="phoneNumber" placeholder="123-456-7890" value="<?php echo $customer->getPhoneNumber();?>">
        		<span class="error">* <?php echo $customer->getPhoneNumberErr();?></span>
				<br><br>
			</fieldset>
			<fieldset>
				<legend>Account Information</legend>
				E-Mail Address:
				<input type="text" name="eMail" value="<?php echo $customer->getEMailAddress();?>">
				<span class="error">* <?php echo $customer->getEMailErr();?></span>
				<br><br>
				Password:
				<input type="password" name="password" value="<?php echo $customer->getPassword();?>">
				<span class="error">* <?php echo $customer->getPasswordErr();?></span>
				<br><br>
				Repeat Password:
				<input type="password" name="passwordRepeat" value="<?php echo $customer->getPasswordRepeat();?>">
				<span class="error">* <?php echo $customer->getPasswordRepeatErr();?></span>
				<br><br>
			</fieldset>
			<fieldset>
				<legend>Additional Information</legend>
				Interests:<br>
				<input type="checkbox" name="action" value="action" <?php if($customer->getAction() =="UNHEX('1')") {echo "checked";} ?>>Action<br>
				<input type="checkbox" name="children" value="children"<?php if($customer->getChildren() =="UNHEX('1')") {echo "checked";} ?>>Children<br>
				<input type="checkbox" name="comedy" value="comedy"<?php if($customer->getComedy() =="UNHEX('1')") {echo "checked";} ?>>Comedy<br>
				<input type="checkbox" name="documentary" value="documentary"<?php if($customer->getDocumentary() =="UNHEX('1')") {echo "checked";} ?>>Documentary<br>
				<input type="checkbox" name="drama" value="drama"<?php if($customer->getDrama() =="UNHEX('1')") {echo "checked";} ?>>Drama<br>
				<input type="checkbox" name="horror" value="horror"<?php if($customer->getHorror() =="UNHEX('1')") {echo "checked";} ?>>Horror<br>
				<input type="checkbox" name="musicals" value="musicals"<?php if($customer->getMusicals() =="UNHEX('1')") {echo "checked";} ?>>Musicals<br>
				<input type="checkbox" name="romance" value="romance"<?php if($customer->getRomance() =="UNHEX('1')") {echo "checked";} ?>>Romance<br>
				<input type="checkbox" name="scienceFiction" value="scienceFiction"<?php if($customer->getScienceFiction() =="UNHEX('1')") {echo "checked";} ?>>Science Fiction<br>
				<input type="checkbox" name="thriller" value="thriller"<?php if($customer->getThriller() =="UNHEX('1')") {echo "checked";} ?>>Thriller<br>
				Notes:
				<textarea name="notes" rows="10" cols="50" value="<?php echo $customer->getNotes();?>"></textarea>
				<br><br>
			</fieldset>
			<input type="submit" value="Submit">
			<input type="reset">
		</form>	
	<?php
	/* Check
	echo "<h1>Your Input:</h1>";
	echo "<br>";
	echo $customer->getFirstName();
	echo "<br>";
	echo $customer->getLastName();
	echo "<br>";
	echo $customer->getDateOfBirth();
	echo "<br>";
	echo $customer->getGender();
	echo "<br>";
	echo $customer->getAddress1();
	echo "<br>";
	echo $customer->getAddress2();
	echo "<br>";
	echo $customer->getCity();
	echo "<br>";
	echo $customer->getState();
	echo "<br>";
	echo $customer->getPhoneNumber();
	echo "<br>";
	echo $customer->getEmailAddress();
	echo "<br>";
	echo $customer->getPassword();
	echo "<br>";
	echo $customer->getAction();
	echo "<br>";
	echo $customer->getChildren();
	echo "<br>";
	echo $customer->getComedy();
	echo "<br>";
	echo $customer->getDocumentary();
	echo "<br>";
	echo $customer->getDrama();
	echo "<br>";
	echo $customer->getHorror();
	echo "<br>";
	echo $customer->getMusicals();
	echo "<br>";
	echo $customer->getRomance();
	echo "<br>";
	echo $customer->getScienceFiction();
	echo "<br>";
	echo $customer->getThriller();
	echo "<br>";
	echo $customer->getNotes();
	echo "<br>"; */
	?>
</main>
</body>
<footer>
	&copy; AB2017 Powered by 	
	<img src="imgs/php.jpg"
	alt="PHP Logo">
</footer>
</html>

<!-- php Desktop/PHP/SantaMonicaMovieRentals/accountCreate.php -->