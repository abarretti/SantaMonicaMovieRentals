<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Search Inventory</title>
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
  
	if ($_SERVER["REQUEST_METHOD"] == "GET")  
	{
  		$inventory->setSKUNumberOptional($_GET["sKUNumber"]);
  		$inventory->setProductNameOptional($_GET["productName"]);
  		$inventory->setProductionCompanyName($_GET["productionCompanyName"]);
  		$inventory->setAction($_GET["action"]);
  		$inventory->setChildren($_GET["children"]);
  		$inventory->setComedy($_GET["comedy"]);
  		$inventory->setDocumentary($_GET["documentary"]);
  		$inventory->setDrama($_GET["drama"]);
  		$inventory->setHorror($_GET["horror"]);
  		$inventory->setMusicals($_GET["musicals"]);
  		$inventory->setRomance($_GET["romance"]);
  		$inventory->setScienceFiction($_GET["scienceFiction"]);
  		$inventory->setThriller($_GET["thriller"]);

  		if (isset($_GET["submitSKUProduct"]) and $inventory->formInventorySearchCheck($inventory->getSKUNumberErr(), $inventory->getProductNameErr())=="FORM COMPLETE")
  		{
  			$dao->productInventoryQuery($inventory->getSKUNumber(), $inventory->getProductName());
  		}
  	
  		if (isset($_GET["submitProductionGenre"]))
  		{
  			$dao->companyGenreQuery($inventory->getProductionCompanyName(), $inventory->getAction(), $inventory->getChildren(), $inventory->getComedy(), $inventory->getDocumentary(), $inventory->getDrama(), $inventory->getHorror(), $inventory->getMusicals(), $inventory->getRomance(), $inventory->getScienceFiction(), $inventory->getThriller());
  		}
  	}

	?>
	<main>
		<h1>Search Inventory</h1>
		<h2 class="notice">* field is subject to input restrictions.</h2>
		<form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="on" method="get">
			<fieldset>
				<legend>Search by Inventory or Product Information</legend>
				SKU Number: 
				<input type="text" name="sKUNumber" value="<?php echo $inventory->getSKUNumber();?>">
				<span class="notice">* <?php echo $inventory->getSKUNumberErr();?></span>
				<br><br>
				Product Name: 
				<input type="text" name="productName" value="<?php echo $inventory->getProductName();?>">	
				<span class="notice">* <?php echo $inventory->getProductNameErr();?></span>
				<br><br>
			</fieldset>
			<input type="submit" name="submitSKUProduct" value="Submit">
			<input type="reset">
		</form>
		<form>
			<fieldset>
			<legend>Search by Production Company Name or Genre</legend>
				Production Company Name:
				<select name="productionCompanyName">
				<option value="" <?php if($inventory->getProductionCompanyName()=="") {echo 'selected';}?>></option>
				<?php $dao->getCompanyNames($inventory->getProductionCompanyName());?>
				</select>
				<br><br>
				Genre:<br>
				<?php $dao->getGenres($inventory->getAction(), $inventory->getChildren(), $inventory->getComedy(), $inventory->getDocumentary(), $inventory->getDrama(), $inventory->getHorror(), $inventory->getMusicals(), $inventory->getRomance(), $inventory->getScienceFiction(), $inventory->getThriller());?>
				<br><br>
			</fieldset>
				<input type="submit" name="submitProductionGenre" value="Submit">
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
	?>
</main>
</body>
<footer>
	&copy; AB2017 Powered by 	
	<img src="imgs/php.jpg"
	alt="PHP Logo">
</footer>
</html>

<!-- php Desktop/PHP/SantaMonicaMovieRentals/inventorySearch.php -->