<?php
	include_once "header.php";
    include_once "conf/server.php";

	$key_activity = $_GET["key_activity"];

    $content = http_build_query(array(
        'key_activity' => $key_activity,
    ));

    $context = stream_context_create(array(
        'http' => array(
        	'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                    "Content-Length: ".strlen($content)."\r\n".
                    "User-Agent:MyAgent/1.0\r\n",
            'method' => 'POST',
            'content' => $content
        )
    ));

    $contents = file_get_contents($server . "api/activity/create", null, $context);            
    $return = json_decode($contents);

	if ($return) {
	    ?>
		<script type="text/javascript">
	    	swal("Successfully added!").then((value) => {
				  window.location = "random_activity.php";
			});
	    </script>
	    <?php
	}else{
        ?>
        <script type="text/javascript">
            swal("Failed to add!").then((value) => {
                  window.location = "index.php";
            });
        </script>
        <?php
    }

	include_once "footer.php";
?>