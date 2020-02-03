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
            'method' => 'DELETE',
            'content' => $content
        )
    ));

    $contents = file_get_contents($server . "api/activity/delete?key_activity=" . $key_activity, null, $context);            
    $return = json_decode($contents);

	if ($return) {
	    ?>
		<script type="text/javascript">
	    	swal("Successfully removed!").then((value) => {
				  window.location = "my_favorites.php";
			});
	    </script>
	    <?php
	}else{
        ?>
        <script type="text/javascript">
            swal("Failed to removed!").then((value) => {
                  window.location = "index.php";
            });
        </script>
        <?php
    }

	include_once "footer.php";
?>