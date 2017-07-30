<?php
defined("BASEPATH") or exit();

Class Home extends CI_Controller{
	
	public function index(){
		$curr = $this->cms->cek_login();
		if($curr){
			header("location:master/cc");
		}
		else{
			$this->load->view("/login");
		}
	}

	public function login(){
		$this->load->model("login");
		if(isset($_POST['username']) and isset($_POST['password'])){

			//cek apakah IP dalam keadaan block atau tidak
			if($this->login->validate_session()){
				if($this->login->login_process($_POST['username'], $_POST['password'])){
					//login success
					$this->login->login_record($_POST['username']);
					redirect("");
				}
				else{
					$this->login->fail_record($_POST['username']);
					$this->cms->create_alert("error","Username atau password yang Anda masukkan salah.");
				}
			}
			else{
				$this->cms->create_alert("Fatal Error","Mohon maaf anda tidak dapat login ke sistem. Segera hubungi Admin / Webmaster untuk informasi lebih lanjut");
			}
		}

		$this->load->view("/login");
	}

	public function logout(){
		//hapus session bersangkutan
		unset($_SESSION['current_token']);
		create_alert("Information","Anda sudah berhasil log out dari sistem","");
	}

}