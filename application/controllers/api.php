<?php

class api extends MY_Controller {
	

	function get_currency_value(){
		$currency_name = (isset($_POST['currency_name'])) ? $_POST['currency_name'] : $_GET['currency_name'];
		$currency_type = (isset($_POST['currency_type'])) ? $_POST['currency_type'] : $_GET['currency_type'];
		echo $this->master->get_currency_value($currency_name,$currency_type);
	}
}

?>