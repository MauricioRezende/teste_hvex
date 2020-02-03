<?php
header('Content-Type: application/json; charset=utf-8');

require_once './class/Activity.php';

class Rest
{
	public static function open($request)
	{
		$url = explode('/', $request['url']);
		
		$calss = ucfirst($url[0]);
		array_shift($url);

		$function = $url[0];
		array_shift($url);

		$parameters = array();
		$parameters = $url;

		try {
			if (class_exists($calss)) {
				if (method_exists($calss, $function)) {
					$method = $_SERVER["REQUEST_METHOD"];
					if($method === "GET" && $function == "list" && isset($_GET["key_activity"])){
						$activity = new Activity();
						$return = $activity->listById($_GET["key_activity"]);
					}
					if($method === "GET" && $function == "list" && !isset($_GET["key_activity"])){
						$activity = new Activity();
						$return = $activity->list();
					}
					if($method === "POST" && $function == "create"){
						$activity = new Activity();
						$return = $activity->create($_POST["key_activity"]);
					}
					if($method === "DELETE" && $function == "delete" && isset($_GET["key_activity"])){
						$activity = new Activity();
						$return = $activity->delete($_GET["key_activity"]);
					}
					return json_encode(array('status' => 'sucess', 'data' => $return));
				} else {
					return json_encode(array('status' => 'erro', 'data' => 'Function does not exist!'));
				}
			} else {
				return json_encode(array('status' => 'erro', 'data' => 'Class does not exist!'));
			}	
		} catch (Exception $e) {
			return json_encode(array('status' => 'erro', 'data' => $e->getMessage()));
		}
	}
}

if (isset($_REQUEST)) {
	echo Rest::open($_REQUEST);
}