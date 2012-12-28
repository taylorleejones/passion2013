<?php

class Pages extends CI_Model {

	private $db_table = "pages";

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/**
	* Admin Create Page
	*
	* @param array 		Data to insert ex. array("field"=>"value") (Required)
	* @return boolean
	*
	*/
	function create($data = array()) {
		if(!empty($data)) {
			extract($data, EXTR_OVERWRITE);
			if(!$this->db->query("INSERT INTO {$this->db_table}(author,title,slug,content,publish_date,in_menu,as_post,image)
										VALUES('$author','$title','$slug','$content','$publish_date','$in_menu','$as_post','$image')")) {
				$err = "Database error";
			}
		} else {
			$err = "No data submitted";
		}
		if(isset($err)) {
			throw new Exception($err);
			return false;
		} else {
			return true;
		}
	}

	/**
	* Grab Singe Page (by id)
	*
	* @param int 		Post id (Required)
	* @return mixed 	Object on success, boolean(FALSE) on fail
	*
	*/
	function get($id = false) {
		if($id) {
			$id = $this->db->escape($id);
			$rsp = $this->db->query("SELECT * FROM {$this->db_table} WHERE id={$id} LIMIT 1");
			if($rsp->num_rows() == 1) {
				foreach($rsp->result() as $row)
					$post = $row;
			} else {
				$err = "Bad id";
			}
		} else {
			$err = "Bad id";
		}

		if(isset($err) || !isset($post)) {
			if(!isset($err)) $err = "An error has occurred";
			throw new Exception($err);
			return false;
		} else {
			return $post;
		}
	}

	/**
	* Grab Single Page (by slug)
	*
	* @param string 	Post slug (Required)
	* @return mixed 	Object on success, boolean(FALSE) on fail
	*
	*/
	function get_by_slug($slug = false) {
		if($slug) {
			$slug = $this->db->escape($slug);
			$rsp = $this->db->query("SELECT author,title,slug,content,publish_date,image FROM {$this->db_table} WHERE slug={$slug} LIMIT 1");
			if($rsp->num_rows() == 1) {
				foreach($rsp->result() as $row)
					$post = $row;
			} else {
				$err = "Bad url";
			}
		} else {
			$err = "Bad url";
		}

		if(isset($err) || !isset($post)) {
			if(!isset($err)) $err = "An error has occurred";
			throw new Exception($err);
			return false;
		} else {
			return $post;
		}
	}

	/**
	* Get All Pages
	*
	* @param string 	DESC or ASC (Default: ASC)
	* @param int 		Result limit
	* @return object 	Empty array if no results
	*
	*/
	function get_all($order = "ASC", $limit = false) {
		$order_by = " ORDER BY id ".$order;
		$add_limit = ($limit) ? " LIMIT ".$limit : "";

		$rsp = $this->db->query("SELECT * FROM {$this->db_table}{$order_by}{$add_limit}");
		return $rsp->result();
	}

	/**
	* Update A Page
	*
	* @param int 		Page id (Required)
	* @param array 		Data to update ex. array("field"=>"value") (Required)
	* @return boolean
	*
	*/
	function update($id = false, $data = array()) {
		if(!empty($data) && $id) {
			extract($data, EXTR_OVERWRITE);
			if(!$this->db->query("UPDATE {$this->db_table} SET author='{$author}', title='{$title}', slug='{$slug}', content='{$content}', in_menu='{$in_menu}', as_post='{$as_post}' WHERE id={$id} LIMIT 1")) {
				$err = "Database error";
			}
		} else {
			$err = "No data submitted";
		}
		if(isset($err)) {
			throw new Exception($err);
			return false;
		} else {
			return true;
		}
	}

}