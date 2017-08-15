<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Search Accounts</title>
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
  
  	$customer->setFirstNameOptional($_POST["firstName"]);
  	$customer->setLastNameOptional($_POST["lastName"]);
  	$customer->setDateOfBirth($_POST["dateOfBirth"]);
  	$customer->setGenderOptional($_POST["gender"]);
	$customer->setAddress1Optional($_POST["address1"]);
  	$customer->setCityOptional($_POST["city"]);
  	$customer->setStateOptional($_POST["state"]);
  	$customer->setPhoneNumber($_POST["phoneNumber"]);
  	$customer->setEmailAddressOptional($_POST["eMail"]);
  	
  	if (isset($_POST["submitPersonal"]) and $customer->formCustomerPersonalSearchCheck($customer->getFirstNameErr(), $customer->getLastNameErr())=="FORM COMPLETE")
  	{	
  		//Personal Info Database Query
  		$dao->personalInformationQuery($customer->getFirstName(), $customer->getLastName(), $customer->getDateOfBirth(), $customer->getGender());
  	}

  	if (isset($_POST["submitAddress"]) and $customer->formCustomerAddressSearchCheck($customer->getAddress1Err(), $customer->getCityErr(), $customer->getPhoneNumberErr())=="FORM COMPLETE")
  	{
  		//Address Info Database Query
  		$dao->addressInformationQuery($customer->getAddress1(), $customer->getCity(), $customer->getState(), $customer->getPhoneNumber());
  	}

  	if (isset($_POST["submitEMail"]) and $customer->formCustomerEMailSearchCheck($customer->getEMailErr())=="FORM COMPLETE")
  	{
  		//Email Database Query
  		$dao->eMailInformationQuery($customer->getEMailAddress()); 
  	}

	?>
	<main>
		<h1>Search Customer Accounts</h1>
		<h2 class="notice">* field is subject to input restrictions.</h2>
		<form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="on" method="post">
			<fieldset>
				<legend>Search by Personal Information</legend>
				First Name: 
				<input type="text" name="firstName" value="<?php echo $customer->getFirstName();?>">
				<span class="notice">* <?php echo $customer->getFirstNameErr();?></span>
				<br><br>
				Last Name: 
				<input type="text" name="lastName" value="<?php echo $customer->getLastName();?>">	
				<span class="notice">* <?php echo $customer->getLastNameErr();?></span>
				<br><br>
				Date of Birth:
				<input type="date" name="dateOfBirth" value="<?php echo $customer->getDateOfBirth();?>">
				<br><br>
				Gender:
				<input type="radio" name="gender" value="M">Male
				<input type="radio" name="gender" value="F">Female
				<br><br>
			</fieldset>
				<input type="submit" name="submitPersonal" value="Submit">
				<input type="reset">
		</form>
		<form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="on" method="post">
			<fieldset>
				<legend>Search by Address Information</legend>
				Address 1: 
				<input type="text" name="address1" value="<?php echo $customer->getAddress1();?>">	
				<span class="notice">* <?php echo $customer->getAddress1Err();?></span>
				<br><br>
				City: 
				<input type="text" name="city" value="<?php echo $customer->getCity();?>">	
				<span class="notice">* <?php echo $customer->getCityErr();?></span>
				<br><br>
				State:
				<select name="state">
				<option value="" <?php if($customer->getState()=="") {echo 'selected';}?>></option>
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
				<br><br>
				Phone Number:
				<input type="tel" name="phoneNumber" value="<?php echo $customer->getPhoneNumber();?>">
        		<span class="notice">* <?php echo $customer->getPhoneNumberErr();?></span>
				<br><br>
			</fieldset>
				<input type="submit" name="submitAddress" value="Submit">
				<input type="reset">
		</form>
		<form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="on" method="post">
			<fieldset>
				<legend>Search by E-Mail Address</legend>
				E-Mail Address:
				<input type="text" name="eMail" value="<?php echo $customer->getEMailAddress();?>">
				<span class="notice">* <?php echo $customer->getEMailErr();?></span>
				<br><br>
			</fieldset>
				<input type="submit" name="submitEMail" value="Submit">
				<input type="reset">
		</form>	
	<?php
	//Check
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
	echo $customer->getCity();
	echo "<br>";
	echo $customer->getState();
	echo "<br>";
	echo $customer->getPhoneNumber();
	echo "<br>";
	echo $customer->getEmailAddress();
	echo "<br>";
	?>
</main>
</body>
<footer>
	&copy; AB2017 Powered by 	
	<img src="imgs/php.jpg"
	alt="PHP Logo">
</footer>
</html>