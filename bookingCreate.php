<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Create Booking</title>
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

	//Classes
	require("class/customerClass.php");
	require("class/inventoryClass.php");
	require("class/bookingClass.php");
	
	//DAO Class
	require("class/DAObookingClass.php");

	//Session Form variables  	
	$_SESSION["inventoryCount"];
  	$_SESSION["eMailList"];
  	$_SESSION["inventoryList"];

  	//Session Booking variables
  	$_SESSION["bookingEMail"];
  	$_SESSION["barCodeNumber1"];
  	$_SESSION["barCodeNumber2"];
  	$_SESSION["barCodeNumber3"];
  	$_SESSION["barCodeNumber4"];
  	$_SESSION["barCodeNumber5"];
  	$_SESSION["barCodeNumber6"];
  	$_SESSION["barCodeNumber7"];
  	$_SESSION["barCodeNumber8"];
  	$_SESSION["barCodeNumber9"];
  	$_SESSION["barCodeNumber10"];
    $_SESSION["bookingDate"];

  	$_SESSION["bookingEMailAddressErr"];
  	$_SESSION["barCodeNumberDuplicateErr"];
  	$_SESSION["barCodeNumber1Err"];
  	$_SESSION["barCodeNumber2Err"];
  	$_SESSION["barCodeNumber3Err"];
  	$_SESSION["barCodeNumber4Err"];
  	$_SESSION["barCodeNumber5Err"];
  	$_SESSION["barCodeNumber6Err"];
  	$_SESSION["barCodeNumber7Err"];
  	$_SESSION["barCodeNumber8Err"];
  	$_SESSION["barCodeNumber9Err"];
  	$_SESSION["barCodeNumber10Err"];
    $_SESSION["bookingDateErr"];

  	if(empty($_SESSION["inventoryCount"]))
  	{
  		$_SESSION["inventoryCount"]= 1;
  	}

  	//Objects
	$customer= new Customer();
	$inventory= new Inventory();
	$booking= new Booking($_SESSION["bookingEMail"],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"], $_SESSION["bookingDate"], NULL, $_SESSION["bookingEMailAddressErr"],$_SESSION["barCodeNumberDuplicateErr"], $_SESSION["barCodeNumber1Err"], $_SESSION["barCodeNumber2Err"], $_SESSION["barCodeNumber3Err"], $_SESSION["barCodeNumber4Err"], $_SESSION["barCodeNumber5Err"], $_SESSION["barCodeNumber6Err"], $_SESSION["barCodeNumber7Err"], $_SESSION["barCodeNumber8Err"], $_SESSION["barCodeNumber9Err"], $_SESSION["barCodeNumber10Err"], $_SESSION["bookingDateErr"],NULL);

	//DAO Objects
	$dao= new BookingDAO();

  	if ($_SERVER["REQUEST_METHOD"] == "POST")
  	{
  		$customer->setLastNameOptional($_POST["lastName"]);
  		$customer->setDateOfBirth($_POST["dateOfBirth"]);
  		$customer->setAddress1Optional($_POST["address1"]);
  		$customer->setPhoneNumber($_POST["phoneNumber"]);

  		$inventory->setBarCodeNumberOptional($_POST["barCodeNumber"]);
  		$inventory->setSKUNumberOptional($_POST["sKUNumber"]);
  		$inventory->setProductNameOptional($_POST["productName"]);

  		//SUBMIT BOOKING
  		if (isset($_POST["submitBooking"]))
  		{
  			$booking->setEMailAddress($_POST["eMail"]);
  			$booking->setBookingFormBarcodeNumbers($_SESSION["inventoryCount"], $_POST["barCodeNumber1"], $_POST["barCodeNumber2"], $_POST["barCodeNumber3"], $_POST["barCodeNumber4"], $_POST["barCodeNumber5"], $_POST["barCodeNumber6"], $_POST["barCodeNumber7"], $_POST["barCodeNumber8"], $_POST["barCodeNumber9"],$_POST["barCodeNumber10"]);
        $booking->setBookingDate($_POST["bookingDate"]);

  			$_SESSION["bookingEMail"]= $booking->getEMailAddress();
  			$_SESSION["bookingEMailAddressErr"]= $booking->getEmailErr();
  			$_SESSION["barCodeNumber1"]= $booking->getBarCodeNumber(1);
  			$_SESSION["barCodeNumber2"]= $booking->getBarCodeNumber(2);
  			$_SESSION["barCodeNumber3"]= $booking->getBarCodeNumber(3);
  			$_SESSION["barCodeNumber4"]= $booking->getBarCodeNumber(4);
  			$_SESSION["barCodeNumber5"]= $booking->getBarCodeNumber(5);
  			$_SESSION["barCodeNumber6"]= $booking->getBarCodeNumber(6);
  			$_SESSION["barCodeNumber7"]= $booking->getBarCodeNumber(7);
  			$_SESSION["barCodeNumber8"]= $booking->getBarCodeNumber(8);
  			$_SESSION["barCodeNumber9"]= $booking->getBarCodeNumber(9);
  			$_SESSION["barCodeNumber10"]= $booking->getBarCodeNumber(10);

        $_SESSION["bookingDate"]= $booking->getBookingDate();
        $_SESSION["bookingDateErr"]= $booking->getBookingDateErr();

  			$_SESSION["barCodeNumberDuplicateErr"]= $booking->getBarCodeNumberErr("d");
  			echo $_SESSION["barCodeNumberDuplicateErr"];
  			$_SESSION["barCodeNumber1Err"]= $booking->getBarCodeNumberErr(1);
  			$_SESSION["barCodeNumber2Err"]= $booking->getBarCodeNumberErr(2);
  			$_SESSION["barCodeNumber3Err"]= $booking->getBarCodeNumberErr(3);
  			$_SESSION["barCodeNumber4Err"]= $booking->getBarCodeNumberErr(4);
  			$_SESSION["barCodeNumber5Err"]= $booking->getBarCodeNumberErr(5);
  			$_SESSION["barCodeNumber6Err"]= $booking->getBarCodeNumberErr(6);
  			$_SESSION["barCodeNumber7Err"]= $booking->getBarCodeNumberErr(7);
  			$_SESSION["barCodeNumber8Err"]= $booking->getBarCodeNumberErr(8);
  			$_SESSION["barCodeNumber9Err"]= $booking->getBarCodeNumberErr(9);
  			$_SESSION["barCodeNumber10Err"]= $booking->getBarCodeNumberErr(10);

  			if ($booking->formSubmitBookingCheck($_SESSION["bookingEMail"], $_SESSION["bookingEMailAddressErr"], $_SESSION["barCodeNumber1"], $_SESSION["bookingDate"], $_SESSION["bookingDateErr"], $_SESSION["barCodeNumberDuplicateErr"], $_SESSION["barCodeNumber1Err"], $_SESSION["barCodeNumber2Err"], $_SESSION["barCodeNumber3Err"], $_SESSION["barCodeNumber4Err"], $_SESSION["barCodeNumber5Err"], $_SESSION["barCodeNumber6Err"], $_SESSION["barCodeNumber7Err"], $_SESSION["barCodeNumber8Err"], $_SESSION["barCodeNumber9Err"], $_SESSION["barCodeNumber10Err"])=="FORM COMPLETE")
  			{
  				echo $dao->createBookingRecord($_SESSION["bookingEMail"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"], $_SESSION["bookingDate"]);
  			}
  		}

  		//Add and Remove Inventory Items
  		if (isset($_POST["addItem"]))
  		{
  			$_SESSION["inventoryCount"]= $_SESSION["inventoryCount"]+1;
  			$booking->setInventoryCount($_SESSION["inventoryCount"]);
  			$_SESSION["inventoryCount"]= $booking->getInventoryCount();
  		}

  		if (isset($_POST["removeItem"]))
  		{	
  			$_SESSION["inventoryCount"]= $_SESSION["inventoryCount"]-1;
  			$booking->setInventoryCount($_SESSION["inventoryCount"]);
  			$_SESSION["inventoryCount"]= $booking->getInventoryCount();
        
        	//clears variable if inventory item is removed
        	$booking->clearBarCodeNumber($_SESSION["inventoryCount"]);
       		$_SESSION["barCodeNumber1"]= $booking->getBarCodeNumber(1);
        	$_SESSION["barCodeNumber2"]= $booking->getBarCodeNumber(2);
        	$_SESSION["barCodeNumber3"]= $booking->getBarCodeNumber(3);
        	$_SESSION["barCodeNumber4"]= $booking->getBarCodeNumber(4);
        	$_SESSION["barCodeNumber5"]= $booking->getBarCodeNumber(5);
        	$_SESSION["barCodeNumber6"]= $booking->getBarCodeNumber(6);
        	$_SESSION["barCodeNumber7"]= $booking->getBarCodeNumber(7);
        	$_SESSION["barCodeNumber8"]= $booking->getBarCodeNumber(8);
        	$_SESSION["barCodeNumber9"]= $booking->getBarCodeNumber(9);
        	$_SESSION["barCodeNumber10"]= $booking->getBarCodeNumber(10);
        	$_SESSION["barCodeNumber1Err"]= $booking->getBarCodeNumberErr(1);
  			$_SESSION["barCodeNumber2Err"]= $booking->getBarCodeNumberErr(2);
  			$_SESSION["barCodeNumber3Err"]= $booking->getBarCodeNumberErr(3);
  			$_SESSION["barCodeNumber4Err"]= $booking->getBarCodeNumberErr(4);
  			$_SESSION["barCodeNumber5Err"]= $booking->getBarCodeNumberErr(5);
  			$_SESSION["barCodeNumber6Err"]= $booking->getBarCodeNumberErr(6);
  			$_SESSION["barCodeNumber7Err"]= $booking->getBarCodeNumberErr(7);
  			$_SESSION["barCodeNumber8Err"]= $booking->getBarCodeNumberErr(8);
  			$_SESSION["barCodeNumber9Err"]= $booking->getBarCodeNumberErr(9);
  			$_SESSION["barCodeNumber10Err"]= $booking->getBarCodeNumberErr(10);
  		}
  		
  		//Customer Search
  		if (isset($_POST["submitCustomer"]) and $customer->formBookingCustomerSearchCheck($customer->getLastNameErr(), $customer->getAddress1Err(), $customer->getPhoneNumberErr())=="FORM COMPLETE")
  		{
  			$_SESSION["eMailList"]= $dao->bookingCustomerQuery($customer->getLastName(), $customer->getDateOfBirth(), $customer->getAddress1(), $customer->getPhoneNumber());

  			foreach ($_SESSION["eMailList"] as $item)
  			{
  				echo $item;
  			}
  		}

  		//Sets Booking E-Mail from Customer Search
  		if (isset($_POST["eMailSelect0"]))
  		{
  			$booking->setEMailAddress($_SESSION["eMailList"][0]);
  			$_SESSION["bookingEMail"]= $booking->getEMailAddress();
  		}

  		if (isset($_POST["eMailSelect1"]))
  		{
  			$booking->setEMailAddress($_SESSION["eMailList"][1]);
  			$_SESSION["bookingEMail"]= $booking->getEMailAddress();
  		}

  		if (isset($_POST["eMailSelect2"]))
  		{
  			$booking->setEMailAddress($_SESSION["eMailList"][2]);
  			$_SESSION["bookingEMail"]= $booking->getEMailAddress();
  		}

  		if (isset($_POST["eMailSelect3"]))
  		{
  			$booking->setEMailAddress($_SESSION["eMailList"][3]);
  			$_SESSION["bookingEMail"]= $booking->getEMailAddress();
  		}

  		if (isset($_POST["eMailSelect4"]))
  		{
  			$booking->setEMailAddress($_SESSION["eMailList"][4]);
  			$_SESSION["bookingEMail"]= $booking->getEMailAddress();
  		}

  		if (isset($_POST["eMailSelect5"]))
  		{
  			$booking->setEMailAddress($_SESSION["eMailList"][5]);
  			$_SESSION["bookingEMail"]= $booking->getEMailAddress();
  		}

  		if (isset($_POST["eMailSelect6"]))
  		{
  			$booking->setEMailAddress($_SESSION["eMailList"][6]);
  			$_SESSION["bookingEMail"]= $booking->getEMailAddress();
  		}

  		if (isset($_POST["eMailSelect7"]))
  		{
  			$booking->setEMailAddress($_SESSION["eMailList"][7]);
  			$_SESSION["bookingEMail"]= $booking->getEMailAddress();
  		}

  		if (isset($_POST["eMailSelect8"]))
  		{
  			$booking->setEMailAddress($_SESSION["eMailList"][8]);
  			$_SESSION["bookingEMail"]= $booking->getEMailAddress();
  		}

  		if (isset($_POST["eMailSelect9"]))
  		{
  			$booking->setEMailAddress($_SESSION["eMailList"][9]);
  			$_SESSION["bookingEMail"]= $booking->getEMailAddress();
  		}
  		
  		//Inventory Search
  		if (isset($_POST["submitProduct"]) and $inventory->formBookingInventorySearchCheck($inventory->getBarCodeNumberErr(), $inventory->getSKUNumberErr(), $inventory->getProductNameErr())=="FORM COMPLETE")
  		{
  			$_SESSION["inventoryList"]= $dao->bookingInventoryQuery($inventory->getBarCodeNumber(), $inventory->getSKUNumber(), $inventory->getProductName());

  			foreach ($_SESSION["inventoryList"] as $item)
  			{
  				echo $item;
  			}
  		}

  		//Sets Booking BarCode from Inventory Search
  		if (isset($_POST["barCodeSelect0"]))
  		{
  			$booking->setBarCodeNumber($_SESSION["inventoryList"][0],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
  			$_SESSION["barCodeNumber1"]= $booking->getBarCodeNumber(1);
  			$_SESSION["barCodeNumber2"]= $booking->getBarCodeNumber(2);
  			$_SESSION["barCodeNumber3"]= $booking->getBarCodeNumber(3);
  			$_SESSION["barCodeNumber4"]= $booking->getBarCodeNumber(4);
  			$_SESSION["barCodeNumber5"]= $booking->getBarCodeNumber(5);
  			$_SESSION["barCodeNumber6"]= $booking->getBarCodeNumber(6);
  			$_SESSION["barCodeNumber7"]= $booking->getBarCodeNumber(7);
  			$_SESSION["barCodeNumber8"]= $booking->getBarCodeNumber(8);
  			$_SESSION["barCodeNumber9"]= $booking->getBarCodeNumber(9);
  			$_SESSION["barCodeNumber10"]= $booking->getBarCodeNumber(10);
  		}

  		if (isset($_POST["barCodeSelect1"]))
  		{
  			$booking->setBarCodeNumber($_SESSION["inventoryList"][1],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
  			$_SESSION["barCodeNumber1"]= $booking->getBarCodeNumber(1);
  			$_SESSION["barCodeNumber2"]= $booking->getBarCodeNumber(2);
  			$_SESSION["barCodeNumber3"]= $booking->getBarCodeNumber(3);
  			$_SESSION["barCodeNumber4"]= $booking->getBarCodeNumber(4);
  			$_SESSION["barCodeNumber5"]= $booking->getBarCodeNumber(5);
  			$_SESSION["barCodeNumber6"]= $booking->getBarCodeNumber(6);
  			$_SESSION["barCodeNumber7"]= $booking->getBarCodeNumber(7);
  			$_SESSION["barCodeNumber8"]= $booking->getBarCodeNumber(8);
  			$_SESSION["barCodeNumber9"]= $booking->getBarCodeNumber(9);
  			$_SESSION["barCodeNumber10"]= $booking->getBarCodeNumber(10);
  		}

  		if (isset($_POST["barCodeSelect2"]))
  		{
  			$booking->setBarCodeNumber($_SESSION["inventoryList"][2],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
  			$_SESSION["barCodeNumber1"]= $booking->getBarCodeNumber(1);
  			$_SESSION["barCodeNumber2"]= $booking->getBarCodeNumber(2);
  			$_SESSION["barCodeNumber3"]= $booking->getBarCodeNumber(3);
  			$_SESSION["barCodeNumber4"]= $booking->getBarCodeNumber(4);
  			$_SESSION["barCodeNumber5"]= $booking->getBarCodeNumber(5);
  			$_SESSION["barCodeNumber6"]= $booking->getBarCodeNumber(6);
  			$_SESSION["barCodeNumber7"]= $booking->getBarCodeNumber(7);
  			$_SESSION["barCodeNumber8"]= $booking->getBarCodeNumber(8);
  			$_SESSION["barCodeNumber9"]= $booking->getBarCodeNumber(9);
  			$_SESSION["barCodeNumber10"]= $booking->getBarCodeNumber(10);
  		}

  		if (isset($_POST["barCodeSelect3"]))
  		{
  			$booking->setBarCodeNumber($_SESSION["inventoryList"][3],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
  			$_SESSION["barCodeNumber1"]= $booking->getBarCodeNumber(1);
  			$_SESSION["barCodeNumber2"]= $booking->getBarCodeNumber(2);
  			$_SESSION["barCodeNumber3"]= $booking->getBarCodeNumber(3);
  			$_SESSION["barCodeNumber4"]= $booking->getBarCodeNumber(4);
  			$_SESSION["barCodeNumber5"]= $booking->getBarCodeNumber(5);
  			$_SESSION["barCodeNumber6"]= $booking->getBarCodeNumber(6);
  			$_SESSION["barCodeNumber7"]= $booking->getBarCodeNumber(7);
  			$_SESSION["barCodeNumber8"]= $booking->getBarCodeNumber(8);
  			$_SESSION["barCodeNumber9"]= $booking->getBarCodeNumber(9);
  			$_SESSION["barCodeNumber10"]= $booking->getBarCodeNumber(10);
  		}

  		if (isset($_POST["barCodeSelect4"]))
  		{
  			$booking->setBarCodeNumber($_SESSION["inventoryList"][4],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
  			$_SESSION["barCodeNumber1"]= $booking->getBarCodeNumber(1);
  			$_SESSION["barCodeNumber2"]= $booking->getBarCodeNumber(2);
  			$_SESSION["barCodeNumber3"]= $booking->getBarCodeNumber(3);
  			$_SESSION["barCodeNumber4"]= $booking->getBarCodeNumber(4);
  			$_SESSION["barCodeNumber5"]= $booking->getBarCodeNumber(5);
  			$_SESSION["barCodeNumber6"]= $booking->getBarCodeNumber(6);
  			$_SESSION["barCodeNumber7"]= $booking->getBarCodeNumber(7);
  			$_SESSION["barCodeNumber8"]= $booking->getBarCodeNumber(8);
  			$_SESSION["barCodeNumber9"]= $booking->getBarCodeNumber(9);
  			$_SESSION["barCodeNumber10"]= $booking->getBarCodeNumber(10);
  		}

  		if (isset($_POST["barCodeSelect5"]))
  		{
  			$booking->setBarCodeNumber($_SESSION["inventoryList"][5],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
  			$_SESSION["barCodeNumber1"]= $booking->getBarCodeNumber(1);
  			$_SESSION["barCodeNumber2"]= $booking->getBarCodeNumber(2);
  			$_SESSION["barCodeNumber3"]= $booking->getBarCodeNumber(3);
  			$_SESSION["barCodeNumber4"]= $booking->getBarCodeNumber(4);
  			$_SESSION["barCodeNumber5"]= $booking->getBarCodeNumber(5);
  			$_SESSION["barCodeNumber6"]= $booking->getBarCodeNumber(6);
  			$_SESSION["barCodeNumber7"]= $booking->getBarCodeNumber(7);
  			$_SESSION["barCodeNumber8"]= $booking->getBarCodeNumber(8);
  			$_SESSION["barCodeNumber9"]= $booking->getBarCodeNumber(9);
  			$_SESSION["barCodeNumber10"]= $booking->getBarCodeNumber(10);
  		}

  		if (isset($_POST["barCodeSelect6"]))
  		{
  			$booking->setBarCodeNumber($_SESSION["inventoryList"][6],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
  			$_SESSION["barCodeNumber1"]= $booking->getBarCodeNumber(1);
  			$_SESSION["barCodeNumber2"]= $booking->getBarCodeNumber(2);
  			$_SESSION["barCodeNumber3"]= $booking->getBarCodeNumber(3);
  			$_SESSION["barCodeNumber4"]= $booking->getBarCodeNumber(4);
  			$_SESSION["barCodeNumber5"]= $booking->getBarCodeNumber(5);
  			$_SESSION["barCodeNumber6"]= $booking->getBarCodeNumber(6);
  			$_SESSION["barCodeNumber7"]= $booking->getBarCodeNumber(7);
  			$_SESSION["barCodeNumber8"]= $booking->getBarCodeNumber(8);
  			$_SESSION["barCodeNumber9"]= $booking->getBarCodeNumber(9);
  			$_SESSION["barCodeNumber10"]= $booking->getBarCodeNumber(10);
  		}

  		if (isset($_POST["barCodeSelect7"]))
  		{
  			$booking->setBarCodeNumber($_SESSION["inventoryList"][7], $_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
  			$_SESSION["barCodeNumber1"]= $booking->getBarCodeNumber(1);
  			$_SESSION["barCodeNumber2"]= $booking->getBarCodeNumber(2);
  			$_SESSION["barCodeNumber3"]= $booking->getBarCodeNumber(3);
  			$_SESSION["barCodeNumber4"]= $booking->getBarCodeNumber(4);
  			$_SESSION["barCodeNumber5"]= $booking->getBarCodeNumber(5);
  			$_SESSION["barCodeNumber6"]= $booking->getBarCodeNumber(6);
  			$_SESSION["barCodeNumber7"]= $booking->getBarCodeNumber(7);
  			$_SESSION["barCodeNumber8"]= $booking->getBarCodeNumber(8);
  			$_SESSION["barCodeNumber9"]= $booking->getBarCodeNumber(9);
  			$_SESSION["barCodeNumber10"]= $booking->getBarCodeNumber(10);
  		}

  		if (isset($_POST["barCodeSelect8"]))
  		{
  			$booking->setBarCodeNumber($_SESSION["inventoryList"][8],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
  			$_SESSION["barCodeNumber1"]= $booking->getBarCodeNumber(1);
  			$_SESSION["barCodeNumber2"]= $booking->getBarCodeNumber(2);
  			$_SESSION["barCodeNumber3"]= $booking->getBarCodeNumber(3);
  			$_SESSION["barCodeNumber4"]= $booking->getBarCodeNumber(4);
  			$_SESSION["barCodeNumber5"]= $booking->getBarCodeNumber(5);
  			$_SESSION["barCodeNumber6"]= $booking->getBarCodeNumber(6);
  			$_SESSION["barCodeNumber7"]= $booking->getBarCodeNumber(7);
  			$_SESSION["barCodeNumber8"]= $booking->getBarCodeNumber(8);
  			$_SESSION["barCodeNumber9"]= $booking->getBarCodeNumber(9);
  			$_SESSION["barCodeNumber10"]= $booking->getBarCodeNumber(10);
  		}

  		if (isset($_POST["barCodeSelect9"]))
  		{
  			$booking->setBarCodeNumber($_SESSION["inventoryList"][9],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
  			$_SESSION["barCodeNumber1"]= $booking->getBarCodeNumber(1);
  			$_SESSION["barCodeNumber2"]= $booking->getBarCodeNumber(2);
  			$_SESSION["barCodeNumber3"]= $booking->getBarCodeNumber(3);
  			$_SESSION["barCodeNumber4"]= $booking->getBarCodeNumber(4);
  			$_SESSION["barCodeNumber5"]= $booking->getBarCodeNumber(5);
  			$_SESSION["barCodeNumber6"]= $booking->getBarCodeNumber(6);
  			$_SESSION["barCodeNumber7"]= $booking->getBarCodeNumber(7);
  			$_SESSION["barCodeNumber8"]= $booking->getBarCodeNumber(8);
  			$_SESSION["barCodeNumber9"]= $booking->getBarCodeNumber(9);
  			$_SESSION["barCodeNumber10"]= $booking->getBarCodeNumber(10);
  		}
  	}

	?>
	<main>
		<h1>Create Booking</h1>
		<form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="on" method="post">
			<fieldset>
				<legend>Customer Information</legend>
				Customer E-Mail Address: 
				<input type="text" name="eMail" value="<?php echo $_SESSION["bookingEMail"];?>">
				<span class="error">* <?php echo $booking->getEMailErr();?></span>
				<br><br>
			</fieldset>
			<fieldset>
				<legend>Inventory</legend>
				<?php $booking->getBookingInventory($_SESSION["inventoryCount"]);?>
			<input type="submit" name="addItem" value="Add Item">
			<input type="submit" name="removeItem" value="Remove Item">
			</fieldset>
      <fieldset>
        <legend>Booking Date</legend>
        <input type="date" name="bookingDate" value="<?php echo $booking->getBookingDate();?>">
        <span class="error">* <?php echo $booking->getBookingDateErr();?></span>
      </fieldset>
			<input type="submit" name="submitBooking" value="Submit">
			<input type="reset">
		</form>

		<h2>Search for Customer</h2>
		<h2 class="notice">* field is subject to input restrictions.</h2>
		<form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="on" method="post">
			<fieldset>
				<legend>Search by Personal Information</legend>
				Last Name: 
				<input type="text" name="lastName" value="<?php echo $customer->getLastName();?>">	
				<span class="notice">* <?php echo $customer->getLastNameErr();?></span>
				<br><br>
				Date of Birth:
				<input type="date" name="dateOfBirth" value="<?php echo $customer->getDateOfBirth();?>">
				<br><br>
				Address 1: 
				<input type="text" name="address1" value="<?php echo $customer->getAddress1();?>">	
				<span class="notice">* <?php echo $customer->getAddress1Err();?></span>
				<br><br>
				Phone Number:
				<input type="tel" name="phoneNumber" value="<?php echo $customer->getPhoneNumber();?>">
        		<span class="notice">* <?php echo $customer->getPhoneNumberErr();?></span>
				<br><br>
			</fieldset>
			<input type="submit" name="submitCustomer" value="Submit">
			<input type="reset">
		</form>

		<h2>Search for Inventory</h2>
		<h2 class="notice">* field is subject to input restrictions.</h2>
		<form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="on" method="post">
			<fieldset>
				<legend>Search by Inventory or Product Information</legend>
				Barcode Number: 
				<input type="text" name="barCodeNumber" value="<?php echo $inventory->getBarCodeNumber();?>">
				<span class="notice">* <?php echo $inventory->getBarCodeNumberErr();?></span>
				<br><br>
				SKU Number: 
				<input type="text" name="sKUNumber" value="<?php echo $inventory->getSKUNumber();?>">
				<span class="notice">* <?php echo $inventory->getSKUNumberErr();?></span>
				<br><br>
				Product Name: 
				<input type="text" name="productName" value="<?php echo $inventory->getProductName();?>">	
				<span class="notice">* <?php echo $inventory->getProductNameErr();?></span>
				<br><br>
			</fieldset>
			<input type="submit" name="submitProduct" value="Submit">
			<input type="reset">
		</form>

	<?php
	echo "<h1>Your Input:</h1>";
	echo "<br>";
	echo $customer->getLastName();
	echo "<br>";
	echo $customer->getDateOfBirth();
	echo "<br>";
	echo $customer->getAddress1();
	echo "<br>";
	echo $customer->getPhoneNumber();
	echo "<br>";
	echo $inventory->getBarCodeNumber();
	echo "<br>";
	echo $inventory->getSKUNumber();
	echo "<br>";
	echo $inventory->getProductName();
	echo "<br>";

	echo "<h1>Booking Class Input:</h1>";
	echo $booking->getEMailAddress();
	echo "<br>";
	echo $booking->getInventoryCount();	
	echo "<br>";
	echo $booking->getBarCodeNumber(1);
	echo "<br>";
	echo $booking->getBarCodeNumber(2);
	echo "<br>";
	echo $booking->getBarCodeNumber(3);
	echo "<br>";
	echo $booking->getBarCodeNumber(4);
	echo "<br>";
	echo $booking->getBarCodeNumber(5);
	echo "<br>";
	echo $booking->getBarCodeNumber(6);
	echo "<br>";
	echo $booking->getBarCodeNumber(7);
	echo "<br>";
	echo $booking->getBarCodeNumber(8);	
	echo "<br>";
	echo $booking->getBarCodeNumber(9);	
	echo "<br>";
	echo $booking->getBarCodeNumber(10);	
	echo "<br>";
  echo $booking->getBookingDate();
  echo "<br>";
	echo $booking->getEMailErr();
	echo "<br>";
	echo $booking->getBarCodeNumberErr("d");
	echo "<br>";
	echo $booking->getBarCodeNumberErr(1);
	echo "<br>";
	echo $booking->getBarCodeNumberErr(2);
	echo "<br>";
	echo $booking->getBarCodeNumberErr(3);
	echo "<br>";
	echo $booking->getBarCodeNumberErr(4);
	echo "<br>";
	echo $booking->getBarCodeNumberErr(5);
	echo "<br>";
	echo $booking->getBarCodeNumberErr(6);
	echo "<br>";
	echo $booking->getBarCodeNumberErr(7);
	echo "<br>";
	echo $booking->getBarCodeNumberErr(8);
	echo "<br>";
	echo $booking->getBarCodeNumberErr(9);
	echo "<br>";
	echo $booking->getBarCodeNumberErr(10);
  echo "<br>";
  echo $booking->getBookingDateErr();

	echo "<h1>Booking SESSIONS Input:</h1>";
	echo "<br>";
  	echo $_SESSION["bookingEMail"];
  	echo "<br>";
  	echo $_SESSION["inventoryCount"];
  	echo "<br>";
  	echo $_SESSION["barCodeNumber1"];
	echo "<br>";  	
  	echo $_SESSION["barCodeNumber2"];
  	echo "<br>";
  	echo $_SESSION["barCodeNumber3"];
  	echo "<br>";
  	echo $_SESSION["barCodeNumber4"];
  	echo "<br>";
  	echo $_SESSION["barCodeNumber5"];
  	echo "<br>";
  	echo $_SESSION["barCodeNumber6"];
  	echo "<br>";
  	echo $_SESSION["barCodeNumber7"];
  	echo "<br>";
  	echo $_SESSION["barCodeNumber8"];
  	echo "<br>";
  	echo $_SESSION["barCodeNumber9"];
  	echo "<br>";
  	echo $_SESSION["barCodeNumber10"];
	echo "<br>";
    echo $_SESSION["bookingDate"];
    echo "<br>";
  	echo $_SESSION["bookingEMailAddressErr"];
 	echo "<br>";
 	echo $_SESSION["barCodeNumberDuplicateErr"];
  	echo "<br>";
  	echo $_SESSION["barCodeNumber1Err"];
  	echo "<br>";
  	echo $_SESSION["barCodeNumber2Err"];
  	echo "<br>";
  	echo $_SESSION["barCodeNumber3Err"];
  	echo "<br>";
  	echo $_SESSION["barCodeNumber4Err"];
  	echo "<br>";
  	echo $_SESSION["barCodeNumber5Err"];
  	echo "<br>";
  	echo $_SESSION["barCodeNumber6Err"];
 	 echo "<br>";
  	echo $_SESSION["barCodeNumber7Err"];
  	echo "<br>";
  	echo $_SESSION["barCodeNumber8Err"];
  	echo "<br>";
  	echo $_SESSION["barCodeNumber9Err"];
  	echo "<br>";
  	echo $_SESSION["barCodeNumber10Err"];
    echo "<br>";
    echo $_SESSION["bookingDateErr"];

	?>
</main>
</body>
<footer>
	&copy; AB<?php date_default_timezone_set("America/New_York");
	 echo date("Y"); ?> Powered by 	
	<img src="imgs/php.jpg"
	alt="PHP Logo">
</footer>
</html>

<!-- php Desktop/PHP/SantaMonicaMovieRentals/bookingCreate.php -->