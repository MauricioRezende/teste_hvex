<?php
	class Activity
	{
		public function listById($data){
			if(empty($data)){
				throw new Exception("Enter the key!");
				return false;
			}
			include_once "./conf/connection.php";

			$sql = "SELECT key_activity,date FROM favorite_activity WHERE key_activity = '" . $data . "'";

			$result = mysqli_query($conn, $sql);

		    while($row = mysqli_fetch_assoc($result)) {
		    	$results[] = $row;
		    }
			 
			mysqli_close($conn);

			if (!isset($results)) {
				throw new Exception("No activity found!");
			}
			
			return $results;
		}

		public function listAll(){
			include_once "./conf/connection.php";

			$sql = "SELECT key_activity,date FROM favorite_activity";

			$result = mysqli_query($conn, $sql);

		    while($row = mysqli_fetch_assoc($result)) {
		    	$results[] = $row;
		    }
			 
			mysqli_close($conn);

			if (!isset($results)) {
				throw new Exception("No activity found!");
			}
			
			return $results;
		}

		public function create($data){
			if(empty($data)){
				throw new Exception("Enter the key!");
				return false;
			}

			include_once "./conf/connection.php";

			$sql = "INSERT INTO favorite_activity (key_activity,date) VALUES(" . $data . ", NOW())";

			$result = mysqli_query($conn, $sql);
			 
			mysqli_close($conn);

			if ($result == 0) {
				throw new Exception("No activity found!");
				return false;
			}
			
			return true;
		}

		public function delete($data){
			if(empty($data)){
				throw new Exception("Enter the key!");
				return false;
			}

			include_once "./conf/connection.php";

			$sql = "DELETE FROM favorite_activity  WHERE key_activity = " . $data . "";

			$result = mysqli_query($conn, $sql);
			 
			mysqli_close($conn);

			if ($result == 0) {
				throw new Exception("No activity found!");
				return false;
			}
			
			return true;
		}
	}
?>