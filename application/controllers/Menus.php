<?php
defined("BASEPATH") or exit();

Class Menus extends CI_Controller{

	public function index(){
		$curr = shortcode_login();
		$data['title'] = "Menu & Navigation";
		$data['menu'] = 3;
		$data['submenu'] = 31;
		$data['curr'] = $curr;
		$data['addURL'] = "/page/add";

		$this->load->model("mdnav");

		$data['table'] = $this->mdnav->show_menus();


		$this->load->view("/header",$data);
		$this->load->view("/menus");
		$this->load->view("/footer");
	}



}