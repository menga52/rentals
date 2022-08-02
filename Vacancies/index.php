<html>
	<?php
		include("../rental-navbar.php");
		include("../login-details.php");
	?>
	
	<body>
		<div class="row">
			<div class="col-xs-1"></div>';
				<div class="col-xs-10">
					<div class="panel panel-default" style="background-color: #0066cc33; padding: 20px; border: 1px solid black; box-shadow: 8px 10px #999999">
						<div class="row">
							<?php
								$sql = $conn->prepare('select * from `house` where for_rent="1"');
								$sql->execute();
								$result = $sql->setFetchMode(PDO::FETCH_ASSOC);
								$result = $sql->fetchAll(\PDO::FETCH_ASSOC);
								
								foreach ($result as $house) {
									$address = $house["address"];
									$bedrooms = $house["bedrooms"];
									$bathrooms = $house["bathrooms"];
									$description = $house["description"];
									$sql2 = $conn->prepare('select * from picture where house="'.$address.'" order by priority asc limit 1');
									$sql2->execute();
									$result2 = $sql2->setFetchMode(PDO::FETCH_ASSOC);
									$result2 = $sql2->fetchAll(\PDO::FETCH_ASSOC);
									$picture_url = "../Pictures/".$result2[0]["name"];
									echo '
									<div class="row responsive" style="min-height: 250px">
										<div class="col-xs-3">
											<img class="responsive"
												style="margin: 0;
                        max-height: 210px;
                        position: relative;
                        top: 50%;
                        left: 50%;
                        -ms-transform: translate(-50%, -50%);
                        transform: translate(-50%, 20%);" alt="" 
												src="'.$picture_url.'"
                        alt="" width="200" height="200">
											</img>
										</div>
										<div class="col-xs-9">
											<h3 class="responsive">
												<a style="color: #0066cc" target="_blank" href="house-frame.php?address='.$address.'">'.$address.'</a>
											</h3>
											<hr></hr>
											<p>'.$description.'</p>
										</div>
									</div>
									';
								}
							?>
						</div>
					</div>		
				</div>
			</div>				
		</div>
	</body>
</html>