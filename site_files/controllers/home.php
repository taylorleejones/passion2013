<?php

class Home extends CI_Controller {

	public function __construct() {

		parent::__construct();
/*
		$redirect = false;
		$get = $this->input->get();
		if(!$get) $get = array();
		if(array_key_exists("i", $get)) {
			if($get["i"] != md5($_SERVER["HTTP_USER_AGENT"]))
				$redirect = true;
		} else {
			$redirect = true;
		}

		if($redirect)
			redirect(current_url()."?i=".md5($_SERVER["HTTP_USER_AGENT"]));
*/
	}

	public function index() {

		$this->output->cache(1);

		$this->load->model("Sessions");
		$live = $this->Sessions->get_live_session();

		if(isset($live))
			$data["current"] = $live;
		else
			$data["current"] = false;
		$data["page_title"] = "Passion '13";

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