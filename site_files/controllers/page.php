<?php if(!defined('BASEPATH')) exit(file_get_contents("404.php"));

class Page extends CI_Controller {

	public function index($slug) {

		$this->output->cache(1);

		$this->load->model("Pages");
		try {
			$page = $this->Pages->get_by_slug($slug);
		} catch(Exception $e) {
			//die($e->getMessage());
			redirect(base_url());
		}

		$data["page_data"] = $page;
		$data["page_title"] = $page->title;

		$this->load->view("header", $data);
		$this->load->view("single-page", $data);
		$this->load->view("footer", $data);

	}

}