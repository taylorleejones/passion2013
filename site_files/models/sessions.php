<?php if(!defined('BASEPATH')) exit(file_get_contents("404.php"));

class Sessions extends CI_Model {

	private $db_table = "sessions";

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/**
	* Admin Create Session
	*
	* @param array 		Data to insert ex. array("field"=>"value") (Required)
	* @return boolean
	*
	*/
	function create($data = array()) {
		if(!empty($data)) {
			extract($data, EXTR_OVERWRITE);
			if(!$this->db->query("INSERT INTO {$this->db_table}(start_time,end_time,available_until,live_smil,archive_smil,live_smil_mobile,archive_smil_mobile,description,title,slug,create_time,visible,image)
										VALUES('$start_time','$end_time','$available_until','$live_smil','$archive_smil','$live_smil_mobile','$archive_smil_mobile','$description','$title','$slug','$create_time','$visible','$image')")) {
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
	* Grab Single Session (by id)
	*
	* @param int 		Session id (Required)
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
	* Grab Single Session (by slug)
	*
	* @param string 	Session slug (Required)
	* @return mixed 	Object on success, boolean(FALSE) on fail
	*
	*/
	function get_by_slug($slug = false) {
		if($slug) {
			$slug = $this->db->escape($slug);
			$rsp = $this->db->query("SELECT * FROM {$this->db_table} WHERE slug={$slug} LIMIT 1");
			if($rsp->num_rows() == 1) {
				foreach($rsp->result() as $row)
					$session = $row;
			} else {
				$err = "Bad url";
			}
		} else {
			$err = "Bad url";
		}

		if(isset($err) || !isset($session)) {
			if(!isset($err)) $err = "An error has occurred";
			throw new Exception($err);
			return false;
		} else {
			return $session;
		}
	}

	/**
	* Get All Sessions
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
	* Update A Session
	*
	* @param int 		Session id (Required)
	* @param array 		Data to update ex. array("field"=>"value") (Required)
	* @return boolean
	*
	*/
	function update($id = false, $data = array()) {
		if(!empty($data) && $id) {
			extract($data, EXTR_OVERWRITE);
			if(!$this->db->query("UPDATE {$this->db_table} SET title='{$title}', description='{$description}', live_smil='{$live_smil}', archive_smil='{$archive_smil}', live_smil_mobile='{$live_smil_mobile}', archive_smil_mobile='{$archive_smil_mobile}', slug='{$slug}', start_time='{$start_time}', end_time='{$end_time}', available_until='{$available_until}' WHERE id={$id} LIMIT 1")) {
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
	* Update Session State
	*
	* @param int 		Session ID
	* @param int 		New State (0,1,2,or 3)
	* @return mixed 	New state on success, FALSE on fail
	*
	*/
	function change_state($id, $state) {
		$id = $this->db->escape($id);
		$state = $this->db->escape($state);
		if($this->db->query("UPDATE {$this->db_table} SET visible={$state} WHERE id={$id} LIMIT 1")) {
			if($this->db->affected_rows() == 1)
				return $state;
			else
				return false;
		} else {
			return false;
		}
	}

	/**
	* Pull Currently Active Session
	*
	* @return mixed 	Session object on success, FALSE if no active sessions
	*
	*/
	function get_live_session() {
		$rsp = $this->db->query("SELECT slug FROM {$this->db_table} WHERE visible=2 LIMIT 1");
		if($rsp->num_rows() == 1) {
			foreach($rsp->result() as $row)
				$live = $row;
			return $live->slug;
		} else {
			return false;
		}
	}

}