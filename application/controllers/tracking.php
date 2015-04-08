<?php

class Tracking extends MY_Controller {

	function __construct(){
		parent::__construct();
	}

	function index() {
		$this->load->view('tracking/index');
	}

	function search() 
	{
		require_once(PATH_APP . 'libraries/request/Requests.php');
		Requests::register_autoloader();
		$return = false;

		if(isset($_GET['hawb'])) 
		{
			$hawb = $_GET['hawb'];
			$request = Requests::post('http://219.133.34.101:8080/podsearch.asp', array(), array('AWBNo' => $hawb));
		
			$data = $request->body;
			$data = explode('<table', $data);
			$data = explode('</table>', $data[2]);
			$return = '<meta http-equiv="Content-Type" content="text/html; charset=gb2312">';
			$return .= '<table' . $data[0] . '</table>';
		}

		$this->load->view('tracking/result',array('result' => $return));

	}

	function translate() {
		$string = $_GET['string'];
		$lang = $_GET['to'];

		require_once(PATH_APP . 'libraries/translate/config.inc.php');
		require_once(PATH_APP . 'libraries/translate/class/ServicesJSON.class.php');
		require_once(PATH_APP . 'libraries/translate/class/MicrosoftTranslator.class.php');

		$translator = new MicrosoftTranslator(ACCOUNT_KEY);
		$translator->translate('', $lang, $string);
		$data = json_decode($translator->response->jsonResponse,true);
		$return = isset($data['translation']) ? $data['translation'] : $string;
		echo json_encode(array('translation' => $return,'index'=>isset($_GET['index']) ? $_GET['index'] : time()));
	}

}

?>