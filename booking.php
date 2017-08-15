<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Booking</title>
		<link rel="icon" type="image/png" href="imgs/phpLogo.png"/>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
	<header>
		<h1>Santa Monica Movie Rentals</h1>
		<h2>Movies - TV Shows - Video Games</h2>
		<nav id="1">
			<a href="index.php">Home</a>
			<a href="inventory.php">Inventory</a>
			<a href="booking.php" class="active">Booking</a> 
			<a href="customers.php">Customers</a>
		</nav>
	</header>
	<main>
		<h1>Booking</h1>
	<div class="existing">
		<h2>Update or Search Bookings &amp; Loans</h2>
		<p>Click <a href="bookingSearch.php">here</a> to update an active booking or search for a prior booking.</p>
	</div>
	<div class="create">
		<h2>Book a Product for a Customer</h2>
		<p>Click <a href="bookingCreate.php">here</a> to create a new customer booking.</p>
	</div>
	</main>
	</body>
	<footer>
		&copy; AB<?php echo date("Y");?> Powered by 	
		<img src="imgs/php.jpg"
		alt="PHP Logo">
	</footer>
</html>

<!-- php Desktop/PHP/search.php -->