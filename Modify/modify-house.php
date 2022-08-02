<!DOCTYPE html>
<html>
	<body>
		<?php
			// if(!isset($_GET("house"))) echo "How did you get here?";
			// else {
				$address = $_GET["house"];
				include("../login-details.php");
				$sql = $conn->prepare('select * from `house` where `address`="'.$address.'"');
				$sql->execute();
				$result = $sql->setFetchMode(PDO::FETCH_ASSOC);
				$result = $sql->fetchAll(\PDO::FETCH_ASSOC);
				$bedrooms = $result[0]["bedrooms"];
				$bathrooms = $result[0]["bathrooms"];
				$description = $result[0]["description"];
				$for_rent = $result[0]["for_rent"];
				$for_sale = $result[0]["for_sale"];
				$sql2 = $conn->prepare('select * from `picture` where house="'.$address.'" order by priority asc');
				$sql2->execute();
				$result2 = $sql2->setFetchMode(PDO::FETCH_ASSOC);
				$result2 = $sql2->fetchAll(\PDO::FETCH_ASSOC);
				if($for_rent) $for_rent = "checked";
				else $for_rent = "";
				if($for_sale) $for_sale= "checked";
				else $for_sale = "";
				echo '
					<h4>If you uploaded the wrong image, delete it and upload it again</h4>
					<form action="execute-modify-house.php" method="post">
						<input id="original-address" name="original-address" value="'.$address.'" hidden></input>
					
						<label for="address-input">Address:</label>
						<input id="address-input" type="text" name="address" value="'.$address.'" required></input><br></br>
						
						<label for="bedrooms-input">Bedrooms:</label>
						<input id="bedrooms-input" type="number" name="bedrooms" value="'.$bedrooms.'" required></input><br></br>
						
						<label for="bathrooms-input">Bathrooms:</label>
						<input id="bathrooms-input" type="text" name="bathrooms" value="'.$bathrooms.'" required></input><br></br>
						
						<label for="description">Description:</label>
						<textarea type="text" id="description" name="description" required>'.$description.'</textarea><br></br>
						
						<label for="for-rent-input">For rent?</label>
						<input id="for-rent-input" type="checkbox" name="for_rent" '.$for_rent.'></input><br></br>
						
						<label for="for-sale-input">For sale?</label>
						<input id="for-sale-input" type="checkbox" name="for_sale" '.$for_sale.'></input><br></br>
						
						<label for="delete">DELETE HOUSE</label>
						<input id="delete" name="delete" type="checkbox"></input><br><br><hr>
				';
				
				$sql3 = $conn->prepare('select address from `house`');
				$sql3->execute();
				$result3 = $sql3->setFetchMode(PDO::FETCH_ASSOC);
				$result3 = $sql3->fetchAll(\PDO::FETCH_ASSOC);
				
				echo '
					<p>If you changed the address of the house, do not change the address of the pictures.<br>
					They will be updated.</p><br>
				';
				
				foreach($result2 as $picture) {
					
					
					$name = $picture["name"];
					$caption = $picture["caption"];
					$priority = $picture["priority"];
					$location = "../Pictures/".$name;
					
					echo '
						<img src="'.$location.'"></img>
						<br>
						<label for="filename '.$name.'">File name: </label>
						<input name="filename '.$name.'" id="filename '.$name.'" type="text" value="'.$name.'"></input>
						<br>
						<label for="caption '.$name.'">Caption: </label>
						<input name="caption '.$name.'" id="caption '.$name.'" type="text" value="'.$caption.'"></input>
						<br>
						<label for="priority '.$name.'">Priority: </label>
						<input name="priority '.$name.'" id="priority '.$name.'" type="number" value="'.$priority.'"></input>
						<br>
						<label for="delete '.$name.'">DELETE (picture above): </label>
						<input name="delete '.$name.'" id="delete '.$name.'" type="checkbox"></input>
						<br>
						<label for="address-input '.$name.'">Associated address: </label>
						<select id="address-input '.$name.'" name="address '.$name.'" required>
					';
					foreach($result3 as $addr) {
						echo '<option value="'.$addr["address"].'">'.$addr["address"].'</option>';
					}
					echo '<br>';
				}
				echo '
						</select><br>
						<input type="submit" value="Finalize"></input>
						</form>
					';
			// }
		?>
	</body>
</html>