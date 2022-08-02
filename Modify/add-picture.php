<!DOCTYPE html>
<html>
	<body>
		<form action="execute-add-picture.php" method="post" enctype="multipart/form-data">
			<label for="caption-input">Caption (optional):</label>
			<input id="caption-input" type="text" name="caption"></input><br><br>
			
			<label for="image-input">Image file:</label>
			<input id="image-input" type="file" name="image" required></input><br><br>
			
			<label for="file-name-input">Enter the file's name: </label>
			<input id="file-name-input" type="text" name="file-name"></input><br><br>
			
			<label for="priority-input">Priority: </label>
			<input id="priority-input" name="priority" type="number"></input><br><br>
			
			<label for="address-input">Address:</label>
			<select id="address-input" name="address" required>
				<?php
					include("../login-details.php");
					$sql = $conn->prepare('select * from `house`');
					$sql->execute();
					$result = $sql->setFetchMode(PDO::FETCH_ASSOC);
					$result = $sql->fetchAll(\PDO::FETCH_ASSOC);
					foreach($result as $house) {
						$address = $house["address"];
						echo '<option value="'.$address.'">'.$address.'</option>';
					}
				?>
			</select><br><br>
			<input type="submit"></input>
		</form>
	</body>
</html>