<?php

class Mdl_admin extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function _verify_credentials($username, $password){
		$condition = [
					'username' => $username
				];
	
		$result = $this->db->get_where('tbl_admin', $condition);
		if($result->num_rows() == 1){
			$user = $result->row_array();
			if (password_verify($password, $user['password'])) {
				unset($user['password']);
				return $user;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}