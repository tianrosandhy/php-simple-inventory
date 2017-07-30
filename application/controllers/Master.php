<?php
defined("BASEPATH") or exit();

Class Master extends CI_Controller{

	public function index(){
		redirect("master/cc");
	}

	public function cc(){
		$curr = shortcode_login();
		$data['title'] = "Data Master Inventory";
		$data['menu'] = 2;
		$data['submenu'] = 21;
		$data['curr'] = $curr;
		$data['tb'] = "master";

		$this->load->model("mdmaster");

		$data['date'] = date("Y-m-d");
		$data['query'] = $this->mdmaster->load_cc();

		$this->load->view("header",$data);
		$this->load->view("master");
		$this->load->view("footer");
	}

	public function divisi(){
		$curr = shortcode_login();
		$data['title'] = "Data Master Divisi";
		$data['menu'] = 2;
		$data['submenu'] = 22;
		$data['curr'] = $curr;
		$data['tb'] = "master";

		$this->load->model("mdmaster");

		$data['date'] = date("Y-m-d");
		$data['query'] = $this->mdmaster->load_divisi();

		$this->load->view("header",$data);
		$this->load->view("divisi");
		$this->load->view("footer");
	}


	public function delete($id,$type="master"){
		$curr = shortcode_login();

		if($type=="master"){
			$tb = "cc_master";
			$target = "cc";
		}
		else if($type=="divisi"){
			$tb = "cc_divisi";
			$target = "divisi";
		}

		$sql = query("UPDATE $tb SET stat = 9 WHERE id = ".quote($id));
		create_alert("Success","Berhasil menghapus data $type","master/$target");
	}

	public function edit($inf,$id=0){
		$curr = shortcode_login();
		$data['title'] = "Edit Data";
		$data['curr'] = $curr;

		if($inf == "master"){
			$data['menu'] = 2;
			$data['submenu'] = 21;
			$data['tb'] = "master";
			$data['row'] = $this->cms->get_page("cc_master",$id);
			$load = "crud_master";
		}
		else if($inf == "divisi"){
			$data['menu'] = 2;
			$data['submenu'] = 22;
			$data['tb'] = "divisi";
			$data['row'] = $this->cms->get_page("cc_divisi",$id);
			$load = "crud_divisi";
		}

		$this->load->model("mdmaster");

		$this->load->view("header_box",$data);
		$this->load->view($load);
		$this->load->view("footer");
	}

	

}