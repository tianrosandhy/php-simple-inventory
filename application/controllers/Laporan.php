<?php
defined("BASEPATH") or exit();

Class Laporan extends CI_Controller{

	public function index(){
		$curr = shortcode_login();
		$data['title'] = "Laporan";
		$data['menu'] = 5;
		$data['submenu'] = 51;
		$data['curr'] = $curr;

		$this->load->model("mdreport");
		$data['list_cc'] = $this->mdreport->list_cc();
		$data['listdiv'] = $this->mdreport->listdiv("array");

		$dtl = 0;
		$filter = "";
		if(isset($_GET['dtl'])){
			$dtl = intval($_GET['dtl']);
		}
		if(isset($_GET['filter'])){
			$filter = $_GET['filter'];
		}

		$data['detail'] = $dtl;

		if(isset($_GET['show'])){
			$show = intval($_GET['show']);
			if($show == 1){
				$data['query'] = $this->mdreport->report_master($dtl);
				$data['show'] = 1;
				$data['title'] .= " Stok CC Master";
			}
			else if($show == 2){
				$data['show'] = 2;
				$data['title'] .= " Stok CC Divisi";
				$data['query'] = $this->mdreport->report_divisi($dtl, $filter);

				if(strlen($filter) > 0){
					$data['title'] .= " ".$data['listdiv'][$filter];
				}
			}


		}


		$data['date'] = date("Y-m-d");

		$this->load->view("header",$data);
		$this->load->view("laporan");
		$this->load->view("footer");

	}

}