<html>
	<body>
		<?php
			$address = $_POST["address"];
			$bedrooms = $_POST["bedrooms"];
			$bathrooms = $_POST["bathrooms"];
			$description = $_POST["description"];
			$for_rent = $_POST["for-rent"];
			if($for_rent == "on") $for_rent = 1;
			else $for_rent = 0;
			
			include("../login-details.php");
			$sql = $conn->prepare('insert into `house`(`address`, `bedrooms`, `bathrooms`, `description`, `for_rent`, `for_sale`) values ("'.$address.'", "'.$bedrooms.'", "'.$bathrooms.'", "'.$description.'", "'.$for_rent.'", "'.$for_sale.'")');
			$sql->execute();
			
		?>
	</body>
</html>