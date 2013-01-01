<?php if(!defined('BASEPATH')) exit(file_get_contents("404.php"));

class Home extends CI_Controller {

	public function __construct() {

		parent::__construct();

	}

	public function index() {

		$this->output->cache(1);

		$this->load->model("Sessions");
		$live = $this->Sessions->get_live_session();

		$data["live"] = (isset($live)) ? $live : false;
		$data["page_title"] = "Passion 2013 :: Live Stream";

		$this->load->view("header", $data);
		$this->load->view("index_page", $data);
		$this->load->view("footer", $data);

	}

	public function all_sessions() {

		$this->output->cache(1);
		$this->load->model("Sessions");
		$sessions = $this->Sessions->get_all();

		$data["sessions"] = $sessions;
		$data["page_title"] = "All Sessions";

		$this->load->view("header", $data);
		$this->load->view("all-sessions", $data);
		$this->load->view("footer", $data);

	}

}