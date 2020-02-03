<?php
	function dateTimeToBr($datasql) {
		if (!empty($datasql)){
		return date('d/m/Y - H:i:s', strtotime($datasql));;
		}
	}

	function modal($id, $text, $title){
		echo '<div id="modal' . $id . '" class="modal" style="">
				<div class="modal-content">
					<h5>' . $title . '</h5>
					<div class="divider"></div>
					<p>' . nl2br($text) . '</p>
				</div>
				<div class="modal-footer">
					<a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
				</div>
			</div>';
	}
?>