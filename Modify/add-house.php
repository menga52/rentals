<html>
	<body>
		<form action="execute-add-house.php" method="post">
		
			<label for="address-input">Address:</label>
			<input id="address-input" type="text" name="address" required></input><br></br>
			
			<label for="bedrooms-input">Bedrooms:</label>
			<input id="bedrooms-input" type="number" name="bedrooms" required></input><br></br>
			
			<label for="bathrooms-input">Bathrooms:</label>
			<input id="bathrooms-input" type="text" name="bathrooms" required></input><br></br>
			
			<label for="description">Description:</label>
			<textarea type="text" id="description" name="description" required></textarea><br></br>
			
			<label for="for-rent-input">For rent?</label>
			<input id="for-rent-input" type="checkbox" name="for-rent"></input><br></br>
			
			<label for="for-sale-input">For sale?</label>
			<input id="for-sale-input" type="checkbox" name="for-sale"></input><br></br>
			
			<input type="submit"></input>
		</form>
	</body>
</html>