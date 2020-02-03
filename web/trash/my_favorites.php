<?php include_once "header.php" ?>
	
	<nav>
		<div class="nav-wrapper">
			<div class="col s12">
				<a href="index.php" class="breadcrumb">Home</a> <!-- <i class="material-icons">reply</i>&nbsp; -->
				<span class="breadcrumb">My favorites</span>
			</div>
		</div>
	</nav>
	<div class="row"></div>
		<div class="card" style="border: solid 2px gray;">
	  		<?php
	  		include_once "conf/connection.php";
	  		include_once "functions/functions.php";

	  		// if(isset($_GET["type_order"])){
			// 	$type_order = $_GET["type_order"];
			// 	if($type_order == "asc"){
			// 		$type_order = "desc";
			// 	}elseif($type_order == "desc"){
			// 		$type_order = "asc";
			// 	}
			// }else{
			// 	$type_order = "asc";
			// }

			$sql = "SELECT key_activity,date FROM favorite_activity ";

			$result = mysqli_query($conn, $sql);
			$cont = 1;

			if (mysqli_num_rows($result) > 0) {
				echo '	<table class="highlight">
						<thead>
					        <tr>
					            <th>Activity</th>
					            <th>Type</th>
					            <th>Date/Time add</th>
					            <th></th>
					            <th></th>
					        </tr>
				        </thead>
						<tbody>';
			    while($row = mysqli_fetch_assoc($result)) {
			    	$url = "http://www.boredapi.com/api/activity?key=" . $row["key_activity"];
					$return = file_get_contents($url);
					$return = json_decode($return);
					$activity = $return->activity;
					$type = $return->type;
					$participants = $return->participants;
					$key = $return->key;
					$accessibility = $return->accessibility;
					$price = $return->price;
					$datetime = $row["date"];
					$text = "<b>Accessibility:</b> $accessibility <br /><br /> <b>Participants:</b> $participants <br /><br /> <b>Type:</b> $type <br /><br /> <b>Price:</b> $price";
			        ?>
						<tr>
							<td style=""><?php echo $activity; ?></td>
							<td style=""><?php echo $type; ?></td>
							<td><?php echo dateTimeToBr($datetime); ?></td>
							<td><a class="modal-trigger" href="#modal<?php echo $cont; ?>" style="color:gray;"><i class="material-icons right tooltipped" data-position="top" data-tooltip="See details">search</i></a></td>
							<td><a href="remove_favorite.php?key=<?php echo $key; ?>" style="color:gray;"><i class="material-icons right tooltipped" data-position="top" data-tooltip="Remove as favorite">favorite</i></a></td>
						</tr>
					<?php
					modal($cont, $text, $activity);
			    }
			 	echo '	</tbody>
							</table>';  
			} else {
			    echo "<div style='padding-left:20px;'>No activity found.</div>";
			}
			mysqli_close($conn);

	  		?>
		</div>
	
<?php include_once "footer.php" ?>