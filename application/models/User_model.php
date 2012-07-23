<?php

class User_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_user($id){
		$query = $this->db->get_where('USER', array('id' => $id));
		return $query->result_array();
	}
}