<?php if(!defined('BASEPATH')) exit(file_get_contents("404.php"));

class Admin extends CI_Controller {

	public $date_format = "Y-m-d H:i:s";
	public $start_end_date = "l, M d, Y";
	public $start_end_time = "g:ia";

	public function __construct() {
		parent::__construct();

		$this->load->helper('form');
		$this->load->library('session');

		// check for session existence
		$uri = $this->uri->uri_string();
		if(str_replace("/", "", $uri) != "admin") { // if not on index
			$creds = $this->session->userdata("admin_user");
			if(!$creds || $creds != "access")
				redirect(base_url("admin"));
		}
	}
	
	public function index() {

		$post_data = $this->input->post();
		if(!empty($post_data)) {
			if($post_data["uname"] == "p13_Admin_u") {
				if($post_data["passw"] == "hjGic4m/74naqK33N9") {
					$passed = true;
				} else {
					$passed = false;
				}
			} else {
				$passed = false;
			}

			if($passed) {
				$this->session->set_userdata("admin_user","access");
				redirect(base_url("admin/manage-sessions"));
			} else {
				$err = "Info is incorrect";
			}
		}

		if(isset($err)) $data["err"] = $err;
		$data["page_title"] = "Protected";

		$this->load->view("admin/admin_index", $data);

	}

	/* 
		PAGE MODEL CONTROLLER FUNCTIONS
	*/

	public function add_page() {

		$post_data = $this->input->post();

		if(!empty($post_data)) {
			$this->load->library("form_validation");

			$this->form_validation->set_rules("author", "Author", "required");
			$this->form_validation->set_rules("title", "Title", "required");
			$this->form_validation->set_rules("slug", "Slug", "required");
			$this->form_validation->set_rules("content", "Content", "required");

			if($this->form_validation->run() != FALSE) {
				$in_menu = (array_key_exists("in_menu", $post_data)) ? 1 : 0;
				$as_post = (array_key_exists("as_post", $post_data)) ? 1 : 0;

				$insert_data = array(
					"author" => $post_data["author"],
					"title" => $post_data["title"],
					"slug" => $post_data["slug"],
					"content" => $post_data["content"],
					"publish_date" => date($this->date_format, time()),
					"in_menu" => $in_menu,
					"as_post" => $as_post,
					"image" => ""
				);

				$this->load->model("Pages");
				try {
					$this->Pages->create($insert_data);
				} catch(Exception $e) {
					$ex = $e->getMessage();
				}

				if(isset($ex)) {
					die($ex);
				} else {
					$this->load->library("session");
					$this->session->set_flashdata("admin_msg", "Page has been successfully created!");
					redirect(base_url("admin/manage-pages"));
				}
			}
		}

		$data["page_title"] = "Admin - Add Page";

		$this->load->view("admin/header", $data);
		$this->load->view("admin/add_page", $data);
		$this->load->view("admin/footer", $data);

	}

	public function edit_page($id = false) {

		if($id) {

			$this->load->model("Pages");

			$post_data = $this->input->post();
			if(!empty($post_data)) {
				$this->load->library("form_validation");

				$this->form_validation->set_rules("author", "Author", "required");
				$this->form_validation->set_rules("title", "Title", "required");
				$this->form_validation->set_rules("slug", "Slug", "required");
				$this->form_validation->set_rules("content", "Content", "required");

				if($this->form_validation->run() != FALSE) {
					$in_menu = (array_key_exists("in_menu", $post_data)) ? 1 : 0;
					$as_post = (array_key_exists("as_post", $post_data)) ? 1 : 0;

					$update_data = array(
						"author" => $post_data["author"],
						"title" => $post_data["title"],
						"slug" => $post_data["slug"],
						"content" => $post_data["content"],
						"in_menu" => $in_menu,
						"as_post" => $as_post,
					);

					try {
						$this->Pages->update($id, $update_data);
					} catch(Exception $e) {
						$ex = $e->getMessage();
					}

					if(isset($ex)) {
						$message = $ex;
					} else {
						$message = "Page has been updated!";
					}

				}
			}

			try {
				$page = $this->Pages->get($id);
			} catch(Exception $e) {
				$err = $e->getMessage();
			}

			if(isset($page)) {
				$data["message"] = (isset($message)) ? $message : false;
				$data["page"] = $page;
				$data["page_title"] = "Edit Page";

				$this->load->view("admin/header", $data);
				$this->load->view("admin/edit_page", $data);
				$this->load->view("admin/footer", $data);
			} elseif(isset($err)) {
				echo $err;
			}
		} else {
			echo "Bad id";
		}

	}

	public function manage_pages() {

		$this->load->model("Pages");
		$pages = $this->Pages->get_all();
		$data["pages"] = $pages;

		$this->load->library("session");
		$message = $this->session->flashdata("admin_msg");
		$data["message"] = ($message) ? $message : false;

		$data["page_title"] = "Admin - Manage Pages";

		$this->load->view("admin/header", $data);
		$this->load->view("admin/manage_pages", $data);
		$this->load->view("admin/footer", $data);

	}

	/*
		SESSIONS MODEL CONTROLLER FUNCTIONS
	*/

	public function add_session() {

		$post_data = $this->input->post();

		if(!empty($post_data)) {
			$this->load->library("form_validation");

			$this->form_validation->set_rules("title", "Title", "required");
			$this->form_validation->set_rules("slug", "Slug", "required");
			$this->form_validation->set_rules("live_smil", "Live SMIL", "required");
			$this->form_validation->set_rules("archive_smil", "Archive SMIL", "required");
			$this->form_validation->set_rules("live_smil_mobile", "Live SMIL (Mobile)", "required");
			$this->form_validation->set_rules("archive_smil_mobile", "Archive SMIL (Mobile)", "required");
			$this->form_validation->set_rules("description", "Description", "required");
			$this->form_validation->set_rules("start_date", "Start Date", "required");
			$this->form_validation->set_rules("end_date", "End Date", "required");
			$this->form_validation->set_rules("start_time", "Start Time", "required");
			$this->form_validation->set_rules("end_time", "End Time", "required");
			$this->form_validation->set_rules("available_until", "Available Until", "required");

			if($this->form_validation->run() != FALSE) {
				$start_time = strtotime($post_data["start_date"].", ".$post_data["start_time"]);
				$end_time = strtotime($post_data["end_date"].", ".$post_data["end_time"]);
				$until = strtotime($post_data["available_until"]);

				$insert_data = array(
					"start_time" => $start_time,
					"end_time" => $end_time,
					"available_until" => $until,
					"live_smil" => $post_data["live_smil"],
					"archive_smil" => $post_data["archive_smil"],
					"live_smil_mobile" => $post_data["live_smil_mobile"],
					"archive_smil_mobile" => $post_data["archive_smil_mobile"],
					"description" => $post_data["description"],
					"title" => $post_data["title"],
					"slug" => $post_data["slug"],
					"create_time" => date($this->date_format, time()),
					"visible" => 0,
					"image" => ""
				);

				$this->load->model("Sessions");
				try {
					$this->Sessions->create($insert_data);
				} catch(Exception $e) {
					$ex = $e->getMessage();
				}

				if(isset($ex)) {
					die($ex);
				} else {
					$this->load->library("session");
					$this->session->set_flashdata("admin_msg", "Session has been successfully added!");
					redirect(base_url("admin/manage-sessions"));
				}
			}
		}

		$data["page_title"] = "Admin - Add Session";

		$this->load->view("admin/header", $data);
		$this->load->view("admin/add_session", $data);
		$this->load->view("admin/footer", $data);

	}

	public function edit_session($id = false) {

		if($id) {

			$this->load->model("Sessions");

			$post_data = $this->input->post();
			if(!empty($post_data)) {
				$this->load->library("form_validation");

				$this->form_validation->set_rules("title", "Title", "required");
				$this->form_validation->set_rules("slug", "Slug", "required");
				$this->form_validation->set_rules("live_smil", "Live SMIL", "required");
				$this->form_validation->set_rules("archive_smil", "Archive SMIL", "required");
				$this->form_validation->set_rules("live_smil_mobile", "Live SMIL (Mobile)", "required");
				$this->form_validation->set_rules("archive_smil_mobile", "Archive SMIL (Mobile)", "required");
				$this->form_validation->set_rules("description", "Description", "required");
				$this->form_validation->set_rules("start_date", "Start Date", "required");
				$this->form_validation->set_rules("end_date", "End Date", "required");
				$this->form_validation->set_rules("start_time", "Start Time", "required");
				$this->form_validation->set_rules("end_time", "End Time", "required");
				$this->form_validation->set_rules("available_until", "Available Until", "required");

				if($this->form_validation->run() != FALSE) {
					$start_time = strtotime($post_data["start_date"].", ".$post_data["start_time"]);
					$end_time = strtotime($post_data["end_date"].", ".$post_data["end_time"]);
					$until = strtotime($post_data["available_until"]);

					$update_data = array(
						"start_time" => $start_time,
						"end_time" => $end_time,
						"available_until" => $until,
						"live_smil" => $post_data["live_smil"],
						"archive_smil" => $post_data["archive_smil"],
						"live_smil_mobile" => $post_data["live_smil_mobile"],
						"archive_smil_mobile" => $post_data["archive_smil_mobile"],
						"description" => $post_data["description"],
						"title" => $post_data["title"],
						"slug" => $post_data["slug"]
					);

					try {
						$this->Sessions->update($id, $update_data);
					} catch(Exception $e) {
						$ex = $e->getMessage();
					}

					if(isset($ex)) {
						$message = $ex;
					} else {
						$message = "Session has been updated!";
					}
				}
			}

			try {
				$session = $this->Sessions->get($id);
			} catch(Exception $e) {
				$err = $e->getMessage();
			}

			if(isset($session)) {
				$raw_start_time = $session->start_time;
				$raw_end_time = $session->end_time;
				$session->start_date_display = date($this->start_end_date, $raw_start_time);
				$session->start_time_display = date($this->start_end_time, $raw_start_time);
				$session->end_date_display = date($this->start_end_date, $raw_end_time);
				$session->end_time_display = date($this->start_end_time, $raw_end_time);
				$session->until = date($this->start_end_date, $session->available_until);

				$data["message"] = (isset($message)) ? $message : false;
				$data["session"] = $session;
				$data["page_title"] = "Edit Session";

				$this->load->view("admin/header", $data);
				$this->load->view("admin/edit_session", $data);
				$this->load->view("admin/footer", $data);
			} elseif(isset($err)) {
				echo $err;
			}
		} else {
			echo "Bad id";
		}

	}

	public function manage_sessions() {

		$this->load->model("Sessions");
		$sessions = $this->Sessions->get_all();
		$data["sessions"] = $sessions;

		$this->load->library("session");
		$message = $this->session->flashdata("admin_msg");
		$data["message"] = ($message) ? $message : false;

		$data["page_title"] = "Admin - Manage Sessions";

		$this->load->view("admin/header", $data);
		$this->load->view("admin/manage_sessions", $data);
		$this->load->view("admin/footer", $data);

	}

	public function change_session_state() {

		$post_data = $this->input->post();
		if(!empty($post_data)) {
			$this->load->model("Sessions");
			echo $this->Sessions->change_state($post_data["id"], $post_data["state"]);
		}

	}

}