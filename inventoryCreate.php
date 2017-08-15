<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Create Inventory &amp; Products</title>
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

	require("class/inventoryClass.php");
	require("class/DAOinventoryClass.php");

  	$inventory= new Inventory();
  	$dao= new InventoryDAO();
  
  	if ($_SERVER["REQUEST_METHOD"] == "POST")
  	{
  		$inventory->setSKUNumber($_POST["sKUNumber"]);
  		$inventory->setProductName($_POST["productName"]);
  		$inventory->setProductionCompanyName($_POST["productionCompanyName"]);
  		$inventory->setAction($_POST["action"]);
  		$inventory->setChildren($_POST["children"]);
  		$inventory->setComedy($_POST["comedy"]);
  		$inventory->setDocumentary($_POST["documentary"]);
  		$inventory->setDrama($_POST["drama"]);
  		$inventory->setHorror($_POST["horror"]);
  		$inventory->setMusicals($_POST["musicals"]);
  		$inventory->setRomance($_POST["romance"]);
  		$inventory->setScienceFiction($_POST["scienceFiction"]);
  		$inventory->setThriller($_POST["thriller"]);
  		$inventory->setBarCodeNumber($_POST["barCodeNumber"]);
  		$inventory->setDateAcquired($_POST["dateAcquired"]);
  		$inventory->setCondition($_POST["condition"]);
  		$inventory->setGenreErr($inventory->getAction(), $inventory->getChildren(), $inventory->getComedy(), $inventory->getDocumentary(), $inventory->getDrama(), $inventory->getHorror(), $inventory->getMusicals(), $inventory->getRomance(), $inventory->getScienceFiction(), $inventory->getThriller());
  	
  	if($inventory->formInventoryCreateCheck($inventory->getSKUNumber(), $inventory->getProductName(), $inventory->getProductionCompanyName(), $inventory->getBarCodeNumber(), $inventory->getDateAcquired(), $inventory->getCondition(), $inventory->getSKUNumberErr(), $inventory->getProductNameErr(), $inventory->getProductionCompanyNameErr(), $inventory->getGenreErr(), $inventory->getBarCodeNumberErr(), $inventory->getDateAcquiredErr(), $inventory->getConditionErr())=="FORM COMPLETE")
  		{
  			echo $dao->createInventoryRecord($inventory->getSKUNumber(), $inventory->getProductName(), $inventory->getProductionCompanyName(), $inventory->getAction(), $inventory->getChildren(), $inventory->getComedy(), $inventory->getDocumentary(), $inventory->getDrama(), $inventory->getHorror(), $inventory->getMusicals(), $inventory->getRomance(), $inventory->getScienceFiction(), $inventory->getThriller(), $inventory->getBarCodeNumber(), $inventory->getDateAcquired(), $inventory->getCondition());
  		}

  	}
	?>
	<main>
		<h1>Create Inventory/Product</h1>
		<h2 class="error">* required field.</h2>
		<form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="on" method="post">
			<fieldset>
				<legend>Product Information</legend>
				SKU Number:
				<input type="text" name="sKUNumber" value="<?php echo $inventory->getSKUNumber();?>">	
				<span class="error">* <?php echo $inventory->getSKUNumberErr();?></span>
				<br><br>
				Product Name: 
				<input type="text" name="productName" value="<?php echo $inventory->getProductName();?>">	
				<span class="error">* <?php echo $inventory->getProductNameErr();?></span>
				<br><br>
				Production Company Name: 
				<select name="productionCompanyName">
				<?php $dao->getCompanyNames($inventory->getProductionCompanyName());?>
				</select>
				<span class="error">* <?php echo $inventory->getProductionCompanyNameErr();?></span>
				<br><br>
				Product Genres:<br>
				<?php $dao->getGenres($inventory->getAction(), $inventory->getChildren(), $inventory->getComedy(), $inventory->getDocumentary(), $inventory->getDrama(), $inventory->getHorror(), $inventory->getMusicals(), $inventory->getRomance(), $inventory->getScienceFiction(), $inventory->getThriller());?>
				<span class="error">* <?php echo $inventory->getGenreErr();?></span>
				<br>
			</fieldset>
			<fieldset>
				<legend>Inventory Information</legend>
				Barcode Number:
				<input type="text" name="barCodeNumber" value="<?php echo $inventory->getBarCodeNumber();?>">	
				<span class="error">* <?php echo $inventory->getBarCodeNumberErr();?></span>
				<br><br>
				Date Acquired:
				<input type="date" name="dateAcquired" value="<?php echo $inventory->getDateAcquired();?>">
				<span class="error">* <?php echo $inventory->getDateAcquiredErr();?></span>
				<br><br>
				Condition:
				<select name="condition">
					<option value="Excellent" <?php if($inventory->getCondition()=="Excellent") {echo 'selected';}?>>Excellent</option>
					<option value="Very Good" <?php if($inventory->getCondition()=="Very Good") {echo 'selected';}?>>Very Good</option>
					<option value="Good" <?php if($inventory->getCondition()=="Good") {echo 'selected';}?>>Good</option>
					<option value="Fair" <?php if($inventory->getCondition()=="Fair") {echo 'selected';}?>>Fair</option>
					<option value="Poor" <?php if($inventory->getCondition()=="Poor") {echo 'selected';}?>>Poor</option>
					<option value="Very Poor" <?php if($inventory->getCondition()=="Very Poor") {echo 'selected';}?>>Very Poor</option>
				</select>
				<span class="error">* <?php echo $inventory->getConditionErr();?></span>
			</fieldset>
			<input type="submit" value="Submit">
			<input type="reset">
		</form>	
	<?php
	//Check
	echo "<h1>Your Input:</h1>";
	echo "<br>";
	echo $inventory->getSKUNumber();
	echo "<br>";
	echo $inventory->getProductName();
	echo "<br>";
	echo $inventory->getProductionCompanyName();
	echo "<br>";
	echo $inventory->getAction();
	echo "<br>";
	echo $inventory->getChildren();
	echo "<br>";
	echo $inventory->getComedy();
	echo "<br>";
	echo $inventory->getDocumentary();
	echo "<br>";
	echo $inventory->getDrama();
	echo "<br>";
	echo $inventory->getHorror();
	echo "<br>";
	echo $inventory->getMusicals();
	echo "<br>";
	echo $inventory->getRomance();
	echo "<br>";
	echo $inventory->getScienceFiction();
	echo "<br>";
	echo $inventory->getThriller();
	echo "<br>";
	echo $inventory->getBarCodeNumber();
	echo "<br>";
	echo $inventory->getDateAcquired();
	echo "<br>";
	echo $inventory->getCondition();
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

<!-- php Desktop/PHP/SantaMonicaMovieRentals/inventoryCreate.php -->