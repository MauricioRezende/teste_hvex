<?php
	include_once "header.php";
	include_once "conf/server.php";
	$type = array();
	array_push($type, "education");
	array_push($type, "recreational");
	array_push($type, "social");
	array_push($type, "diy");
	array_push($type, "charity");
	array_push($type, "cooking");
	array_push($type, "relaxation");
	array_push($type, "music");
	array_push($type, "busywork");
?>
	<nav>
		<div class="nav-wrapper">
			<div class="col l12 m12 s12">
				<a href="index.php" class="breadcrumb">Home</a>
				<span class="breadcrumb">Random activity</span>
			</div>
		</div>
	</nav>
	<div class="row"></div>
	<form action="" method="POST">
		<div class="card" style="border: solid 2px gray;">
				<br />
				<div class="center-align">
					<button class="btn waves-effect waves-light shake" style="background-color: #04516b;" type="submit" name="raffle" >
						raffle activity
			    		<i class="material-icons right">shuffle</i>
			  		</button>
			  	</div>
			  	<br />
			  	<div class="container">
					<div class="input-field col s12 m12 s12">
						<select name="type">
							<option value="" selected>Choose an option</option>
							<?php
								for ($i=0; $i < sizeof($type); $i++) {
									if(isset($_POST["type"])){
										if($_POST["type"] == $type[$i]){
											echo '<option value="' . $type[$i] . '" selected>' . $type[$i] . '</option>';
										}else{
											echo '<option value="' . $type[$i] . '">' . $type[$i] . '</option>';
										}
									}else{
										echo '<option value="' . $type[$i] . '">' . $type[$i] . '</option>';
									}
								}
							?>
						</select>
						<label><b>Filter by type</b></label>
					</div>
					OBS.: <i>It is not mandatory to use the filter.</i>
				</div>
	  		<br />
	  		<?php 
	  		if(isset($_POST["raffle"])){
	  			if(isset($_POST["type"])){
	  				$url = "http://www.boredapi.com/api/activity?type=" . $_POST["type"];
	  			}else{
	  				$url = "http://www.boredapi.com/api/activity/";	
	  			}
				$retorno = file_get_contents($url);
				$retorno = json_decode($retorno);

				$activity = $retorno->activity;
				$type = $retorno->type;
				$participants = $retorno->participants;
				$key = $retorno->key;


				$json_file = file_get_contents($server . "api/activity/list?key_activity=" . $key);   
				$json_str = json_decode($json_file, true);
				$itens = $json_str['data'];
				
				$activityAdd = 0;

				if ($itens != "No activity found!" && $itens != NULL) {
			    	$activityAdd = 1;
				}
				?>
				<table class="responsive-table">
					<thead>
						<tr>
							<th>Activity</th>
							<th>Type</th>
			            	<th>Participants</th>
			            	<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $activity; ?></td>
							<td><?php echo $type; ?></td>
							<td><?php echo $participants; ?></td>
							<?php
							if($activityAdd == 0){
							?>
								<td><a href="add_favorite.php?key_activity=<?php echo $key; ?>" style="color:gray;"><i class="material-icons right tooltipped shake" data-position="top" data-tooltip="Add as favorite">favorite_border</i></a></td>
							<?php
							}else{
							?>
								<td><a href="remove_favorite.php?key_activity=<?php echo $key; ?>" style="color:gray;"><i class="material-icons right tooltipped shake" data-position="top" data-tooltip="Remove as favorite">favorite</i></a></td>
							<?php
							}
							?>
						</tr>
					</tbody>
				</table>
				<?php
	  		} ?>
	  		</div>
		</div>
	</form>
	
<?php include_once "footer.php" ?>