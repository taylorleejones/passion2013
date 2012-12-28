<?php

class Test extends CI_Controller {

	public function page() {

		$this->output->cache(1);

		$data = array();

		$this->load->view("header", $data);
		$this->load->view("hello_world", $data);
		$this->load->view("footer", $data);

	}

	public function json() {

		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode(array("unixtime"=>date("U"))));

	}

}