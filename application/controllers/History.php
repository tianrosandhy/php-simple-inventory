<?php
defined("BASEPATH") or exit();

Class History extends CI_Controller{

	public function index(){
		$curr = shortcode_login();
		$data['title'] = "Periode History";
		$data['menu'] = 6;
		$data['curr'] = $curr;

		$this->load->model("mdsetting");

		$data['date'] = date("Y-m-d");
		$data['query'] = $this->mdsetting->load_project();

		$this->load->view("header",$data);
		$this->load->view("setting");
		$this->load->view("footer");
	}

	public function view($id_project){
		$curr = shortcode_login();
		$this->load->model("mdreport");
		$this->load->model("mdsetting");
		$data['row'] = $this->mdsetting->project_detail($id_project);
		$data['list_cc'] = $this->mdreport->list_cc();
		$data['listdiv'] = $this->mdreport->listdiv("array");

		$data['title'] = "History Laporan";
		$data['menu'] = 6;
		$data['curr'] = $curr;



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
				$data['query'] = $this->mdsetting->report_master($id_project, $dtl);
				$data['show'] = 1;
				$data['title'] .= " Stok CC Master";
			}
			else if($show == 2){
				$data['show'] = 2;
				$data['title'] .= " Stok CC Divisi";
				$data['query'] = $this->mdsetting->report_divisi($id_project, $dtl, $filter);

				if(strlen($filter) > 0){
					$data['title'] .= " ".$data['listdiv'][$filter];
				}
			}
		}


		$this->load->view("header",$data);
		$this->load->view("laporan");
		$this->load->view("footer");
	}









	public function new_periode(){
		$curr = shortcode_login();
		$this->load->model("mdsetting");
		$this->load->model("mdmutasi");
		$skrg = date("Y-m-d");
		//sebelum ke transaksi perpindahan data, lakukan perhitungan jumlah data awal untuk periode baru.
		$list = $this->mdmutasi->load_cc();
		$ldiv = $this->mdmutasi->list_divisi();

		$plus = array();
		$arr_kirim = array();
		$arr_terima = array();
		foreach($ldiv as $iddiv=>$nmdiv){
			$x = $this->mdmutasi->get_current_mutasi($list, $iddiv);
			foreach($x as $idm=>$stk){
				$arr_kirim[] = array(
					"id" => null,
					"id_master" => $idm,
					"id_divisi" => $iddiv,
					"tgl" => $skrg,
					"jml" => $stk, 
					"ket" => "Data sisa periode",
					"stat" => 1
				);
			}
		}


		//hasil array diatas direpeat ulang utk penambahan bobot pengeluaran
		$plus = array();
		foreach($arr_kirim as $tes){
			if(!isset($plus[$tes['id_master']])){
				$plus[$tes['id_master']] = $tes['jml'];
			}
			else{
				$plus[$tes['id_master']] += $tes['jml'];
			}
		}


		$a = $this->mdmutasi->get_current_mutasi($list);
		foreach($a as $idmaster=>$stok){
			$pls = 0;
			if(isset($plus[$idmaster])){
				$pls = $plus[$idmaster];
			}

			$stok_akhir = $stok + $pls;

			$arr_terima[] = array(
				"id" => null,
				"id_master" => $idmaster,
				"tgl" => $skrg, 
				"jml" => $stok_akhir,
				"ket" => "Data awal periode",
				"stat" => 1
			);
		}



		//data array hasil pemroresan sudah siap disimpan dalam array $arr_terima dan $arr_kirim.

		//proses truncating data
		$nm = "Untitled";
		if(isset($_GET['nm'])){
			if(strlen($_GET['nm']) > 0)
			$nm = $_GET['nm'];
		}
		$id_project = $this->mdsetting->get_last_id($nm);


		//tabel translate : cc_terima, cc_kirim, cc_terjual
		$sql = query("INSERT INTO cc_temp 
			SELECT NULL, $id_project, 'cc_terima', id_master, NULL, tgl, jml, ket, stat FROM cc_terima");
		$sql = query("INSERT INTO cc_temp 
			SELECT NULL, $id_project, 'cc_kirim', id_master, id_divisi, tgl, jml, ket, stat FROM cc_kirim");
		$sql = query("INSERT INTO cc_temp 
			SELECT NULL, $id_project, 'cc_terjual', id_master, id_divisi, tgl, jml, ket, stat FROM cc_terjual");

		$this->db->truncate("cc_terima");
		$this->db->truncate("cc_kirim");
		$this->db->truncate("cc_terjual");

		//proses penyimpanan ulang data hasil olah periode baru
		$this->db->insert_batch("cc_terima",$arr_terima);
		$this->db->insert_batch("cc_kirim",$arr_kirim);


		create_alert("Success","Berhasil pindah ke periode baru","history");
	}

}