<?php
defined("BASEPATH") or exit();

Class Login extends CI_Model{

	public function login_process($username, $password){
		$sql = query("SELECT * FROM cms_admin WHERE username = ".quote($username));
		if($sql->num_rows() > 0){
			$row = $sql->row_array();
			if(password_verify($password, $row['password'])){
				return true;
			}
			else{
				return false;
			}
		}
		return false;
	}

	public function validate_session(){
		$cek = query("SELECT * FROM cms_admin_fail WHERE stat = 0 AND ip = ".quote($_SERVER['REMOTE_ADDR']));
		$max_try = get_setting("max_login_try");
		if($cek->num_rows() >= $max_try)
			return false;
		else
			return true;
	}

	public function login_record($username){
		$s = $_SERVER;
		$tgl = date("Y-m-d H:i:s");
		$expired = date("Y-m-d H:i:s",strtotime($tgl) + 12 * 60 * 60);

		$token = $this->cms->random_hash();

		//save data to database
		if(query("INSERT INTO cms_admin_log VALUES (NULL, ".quote($username).", ".quote($tgl).", ".quote($expired).", ".quote($token).", ".quote($s['REMOTE_ADDR']).", ".quote($s['HTTP_USER_AGENT']).")")){
	
			$_SESSION['current_token'] = $token;

		}
		return true;
	}

	public function fail_record($username){
		$s = $_SERVER;
		$tgl = date("Y-m-d H:i:s");

		query("INSERT INTO cms_admin_fail VALUES (NULL, ".quote($username).", ".quote($tgl).", ".quote($s['REMOTE_ADDR']).", ".quote($s['HTTP_USER_AGENT']).", 0)");

		return true;
	}

}