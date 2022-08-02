<!DOCTYPE html>
<html>
	<?php
		$original_address = $_POST["original-address"];
		$address = $_POST["address"];
		$bedrooms = $_POST["bedrooms"];
		$bathrooms = $_POST["bathrooms"];
		$description = $_POST["description"];
		$for_rent = 0; 
		if(isset($_POST["for_rent"])) $for_rent = 1;
		$for_sale = 0;
		if(isset($_POST["for_sale"])) $for_sale = 1;
		include("../login-details.php");
		if(isset($_POST["delete"])) {
			$sql = $conn->prepare('delete from table `house` where `address`="'.$original_address.'";');
			$sql->execute();
		}
		$sql = $conn->prepare('update `house` set `address`="'.$address.'", `bedrooms`="'.$bedrooms.'", `bathrooms`="'.$bathrooms.'", `description`="'.$description.'", `for_rent`="'.$for_rent.'", `for_sale`="'.$for_sale.'" where `address`="'.$original_address.'";');
		$sql->execute();
		
		$sql = $conn->prepare('select * from `picture` where `house`="'.$original_address.'"');
		$sql->execute();
		$result = $sql->setFetchMode(PDO::FETCH_ASSOC);
		$result = $sql->fetchAll(\PDO::FETCH_ASSOC);
		$num_pics = count($result);
		foreach($result as $original_picture) {
			$name = $original_picture["name"];
			$filename = $_POST["filename ".$name];
			$caption = $_POST["caption ".$name];
			$priority = $_POST["priority ".$name];
			$delete = 0;
			if(isset($_POST["delete ".$name])) $delete = 1;
			$new_address = $_POST["address ".$name];
			if($delete) {
				$sql = $conn->prepare('delete from table `picture` where `name`="'.$name.'";');
				$sql->execute();
			}
			if($original_address != $address and $new_address == $original_address) $new_address = $address;
			if($name != $filename) {
				rename("../Pictures/".$name, "../Pictures/".$filename);
			}
			$sql = $conn->prepare('update `picture` set `name`="'.$filename.'", `caption`="'.$caption.'", `priority`="'.$priority.'", `address`="'.$new_address.'" where `name`="'.$name.'";');
			$sql->execute();
		}
		
	?>
</html>