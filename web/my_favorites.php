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
	  		include_once "functions/functions.php";

	  		$json_file = file_get_contents("http://localhost/hvex/api/activity/list");   
			$json_str = json_decode($json_file, true);
			$itens = $json_str['data'];

			$cont = 1;

			if ($itens) {
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
			    foreach ( $itens as $e ) {
			    	$url = "http://www.boredapi.com/api/activity?key=" . $e["key_activity"];
					$return = file_get_contents($url);
					$return = json_decode($return);
					$activity = $return->activity;
					$type = $return->type;
					$participants = $return->participants;
					$key = $return->key;
					$accessibility = $return->accessibility;
					$price = $return->price;
					$datetime = $e["date"];
					$text = "<b>Accessibility:</b> $accessibility <br /><br /> <b>Participants:</b> $participants <br /><br /> <b>Type:</b> $type <br /><br /> <b>Price:</b> $price";
			        ?>
						<tr>
							<td style=""><?php echo $activity; ?></td>
							<td style=""><?php echo $type; ?></td>
							<td><?php echo dateTimeToBr($datetime); ?></td>
							<td><a class="modal-trigger" href="#modal<?php echo $cont; ?>" style="color:gray;"><i class="material-icons right tooltipped" data-position="top" data-tooltip="See details">search</i></a></td>
							<td><a href="remove_favorite.php?key_activity=<?php echo $key; ?>" style="color:gray;"><i class="material-icons right tooltipped" data-position="top" data-tooltip="Remove as favorite">favorite</i></a></td>
						</tr>
					<?php
					modal($cont, $text, $activity);
					$cont++;
			    }
			 	echo '	</tbody>
							</table>';  
			} else {
			    echo "<div style='padding-left:20px;'>No activity found.</div>";
			}

	  		?>
		</div>
	
<?php include_once "footer.php" ?>