<?php if(!defined('BASEPATH')) exit(file_get_contents("404.php"));

class Session extends CI_Controller {

	public function index($slug) {

		$this->output->cache(1);

		$this->load->model("Sessions");
		try {
			$session = $this->Sessions->get_by_slug($slug);
		} catch(Exception $e) {
			//die($e->getMessage());
			redirect(base_url());
		}

		if($session->visible == 0 || $session->visible == 1)
			redirect(base_url());

		$sessions = $this->Sessions->get_all();

		$data["all_sessions"] = $sessions;
		$data["session_data"] = $session;
		$data["page_title"] = $session->title;

		$this->load->view("header", $data);
		$this->load->view("single-session", $data);
		$this->load->view("footer", $data);

	}

}