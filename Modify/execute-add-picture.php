<html>
	<body>
		<?php
			$caption = $_POST["caption"];
			$file_name = $_POST["file-name"];
			$house = $_POST["address"];
			$priority = $_POST["priority"];
			
			$target_dir = "../Pictures/";
			$target_file = $target_dir . $file_name;
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));

			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["image"]["tmp_name"]);
				if($check !== false) {
					
				} else {
					echo "File is not an image.";
					$uploadOk = 0;
				}
			}

			// Check if file already exists
			if (file_exists($target_file)) {
				echo "Sorry, file with given name already exists.";
				$uploadOk = 0;
			}

			// Check file size (in KB)
			if ($_FILES["image"]["size"] > 500000) {
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "<br>Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
					echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			}

			
			if ($uploadOk == 1) {
				include("../login-details.php");
				echo 'insert into `picture`(`name`, `house`, `caption`, `priority`) values ("'.$file_name.'", "'.$house.'", "'.$caption.'", "'.$priority.'")';
				$sql = $conn->prepare('insert into `picture`(`name`, `house`, `caption`, `priority`) values ("'.$file_name.'", "'.$house.'", "'.$caption.'", "'.$priority.'")');
				$sql->execute();
			}
			
		?>
	</body>
</html>