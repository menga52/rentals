<!DOCTYPE html>
<html>
	<body>
		<h4>Select the house to which the picture you want to modify currently belongs</h4>
		<?php
			include("../login-details.php");
			$sql = $conn->prepare("Select * from house");
			$sql->execute();
			$result = $sql->setFetchMode(PDO::FETCH_ASSOC);
			$result = $sql->fetchAll(\PDO::FETCH_ASSOC);
			
			foreach($result as $house) {
				$address = $house["address"];
				$sql2 = $conn->prepare('Select * from `picture` where house="'.$address.'" order by priority asc limit 1;');
				$sql2->execute();
				$result2 = $sql2->setFetchMode(PDO::FETCH_ASSOC);
				$result2 = $sql2->fetchAll(\PDO::FETCH_ASSOC);
				$picture_name = $result2[0]["name"];
				echo '<img src="../Pictures/'.$picture_name.'"></img>';
				echo '<a base href="http://localhost/rentals/Modify/modify-house.php?house='.$address.'">'.$address.'</a>';
				echo '<br>';
			}
		?>
	</body>
</html>