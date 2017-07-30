<?php
defined("BASEPATH") or exit();

Class Mutasi extends CI_Controller{

	public function index(){
		redirect("mutasi/penerimaan");
	}

	public function penerimaan(){
		$curr = shortcode_login();
		$data['title'] = "Rekap Stok Inventory";
		$data['menu'] = 3;
		$data['curr'] = $curr;

		$this->load->model("mdmutasi");

		$data['list'] = $this->mdmutasi->load_cc();
		$data['mutasi'] = $this->mdmutasi->get_current_mutasi($data['list']);

		$this->load->view("header",$data);
		$this->load->view("terima");
		$this->load->view("footer");
	}

	public function view($idmaster, $iddivisi=0){
		$curr = shortcode_login();
		$data['curr'] = $curr;

		$this->load->model("mdmutasi");
		$row = $this->cms->get_page("cc_master",$idmaster);
		if($row){
			$data['title'] = "Rekam Mutasi Item : $row[nama]";
		}

		$data['row'] = $row;

		if($iddivisi == 0){
			$data['item_mutasi'] = $this->mdmutasi->item_mutasi($idmaster);
			$vname = "rekam";
		}
		else{
			$data['item_mutasi'] = $this->mdmutasi->item_mutasi_divisi($idmaster, $iddivisi);
			$vname = "rekam2";
		}

		$this->load->view("header_box",$data);
		$this->load->view($vname,$data);
		$this->load->view("footer");
	}

	public function add($idmaster){
		$curr = shortcode_login();
		$this->load->model("mdmutasi");


		$row = $this->cms->get_page("cc_master",$idmaster);
		$data['title'] = "Tambah Data Terima Inventory ".$row['nama'];
		$data['tgl'] = date("Y-m-d");


		$data['row'] = $row;
		$this->load->view("header_box",$data);
		$this->load->view("add_terima");
		$this->load->view("footer");
	}

	public function addproses($idmaster){
		$curr = shortcode_login();
		$this->load->model("mdmutasi");

		$list_post = array("cc_tgl","cc_jml","cc_ket");
		$post = $_POST;
		if(empty($post['cc_tgl']) or empty($post['cc_jml'])){
			post_session($post, $list_post);
			create_alert("error","Mohon mengisi data di kolom yang sudah disediakan dengan lengkap.","mutasi/add/$idmaster");
		}
		else{
			//langsung proses
			$arr = array(
				"id" => null,
				"id_master" => $idmaster,
				"tgl" => date("Y-m-d",strtotime($post['cc_tgl'])),
				"jml" => $post['cc_jml'],
				"ket" => $post['cc_ket'],
				"stat" => 1
			);
			$this->db->insert("cc_terima",$arr);
			create_alert("success","Berhasil menyimpan data pemesanan inventory","mutasi/add/$idmaster");
		}
	}





	public function kirim($idmaster,$iddiv=0){
		$curr = shortcode_login();
		$this->load->model("mdmutasi");

		$row = $this->cms->get_page("cc_master",$idmaster);
		$data['title'] = "Tambah Data Kirim Inventory ".$row['nama'];
		$data['tgl'] = date("Y-m-d");

		$data['row'] = $row;
		$data['def'] = $iddiv;
		$this->load->view("header_box",$data);
		$this->load->view("add_kirim");
		$this->load->view("footer");
	}

	public function kirimproses($idmaster){
		$curr = shortcode_login();
		$this->load->model("mdmutasi");

		$listdiv = $this->mdmutasi->list_divisi();

		$list_post = array("cc_tgl","cc_jml","cc_divisi","cc_ket");
		$post = $_POST;
		if(empty($post['cc_tgl']) or empty($post['cc_divisi']) or empty($post['cc_jml'])){
			post_session($post, $list_post);
			create_alert("error","Mohon mengisi data di kolom yang sudah disediakan dengan lengkap.","mutasi/kirim/$idmaster/$post[cc_divisi]");
		}
		else{
			//sebelum kirim, cek dulu stok yang ada di master berapa
			$stokmaster = $this->mdmutasi->real_stok($idmaster);
			if($post['cc_jml'] > $stokmaster){
				post_session($post, $list_post);
				create_alert("error","Stok data master tidak mencukupi untuk melakukan pengiriman dengan jumlah sekian. (Stok master : $stokmaster, dikirim : $post[cc_jml])","mutasi/kirim/$idmaster/$post[cc_divisi]");
			}


			$ket = $post['cc_ket'];
			if(empty($post['cc_ket'])){
				$ket = "Dikirim ke ".$listdiv[$post['cc_divisi']];
			}


			$arr = array(
				"id" => null,
				"id_master" => $idmaster,
				"id_divisi" => $post['cc_divisi'],
				"tgl" => date("Y-m-d",strtotime($post['cc_tgl'])),
				"jml" => $post['cc_jml'],
				"ket" => $ket,
				"stat" => 1
			);
			$this->db->insert("cc_kirim",$arr);
			create_alert("success","Berhasil menyimpan data pengiriman inventory","mutasi/kirim/$idmaster/$post[cc_divisi]");
		}
	}















	public function pengiriman(){
		$curr = shortcode_login();
		$data['title'] = "Rekap Stok Inventory per Divisi";
		$data['menu'] = 4;
		$data['curr'] = $curr;

		$this->load->model("mdmutasi");

		$data['list'] = $this->mdmutasi->list_divisi();

		$this->load->view("header",$data);
		$this->load->view("rekap_divisi");
		$this->load->view("footer");
	}

	public function detaildivisi($iddivisi){
		$curr = shortcode_login();
		$this->load->model("mdmutasi");
		$list = $this->mdmutasi->list_divisi();

		$data['title'] = "Detail Rekap Stok Inventory di ".$list[$iddivisi];
		$data['curr'] = $curr;
		$data['list_cc'] = $this->mdmutasi->load_cc();
		$data['mutasi'] = $this->mdmutasi->get_current_mutasi($data['list_cc'], $iddivisi);
		$data['iddiv'] = $iddivisi;

		$this->load->view("header_box",$data);
		$this->load->view("detail_divisi");
		$this->load->view("footer");
	}

	public function terjual($idmaster, $iddivisi){
		$curr = shortcode_login();
		$this->load->model("mdmutasi");
		$list = $this->mdmutasi->list_divisi();

		$row = $this->cms->get_page("cc_master",$idmaster);

		$data['title'] = "Stok Inventory \"$row[nama]\" Terpakai di ".$list[$iddivisi];
		$data['curr'] = $curr;
		$data['real_stok'] = $this->mdmutasi->real_stok_div($idmaster, $iddivisi);
		$data['iddiv'] = $iddivisi;
		$data['tgl'] = date("Y-m-d");
		$data['idmaster'] = $idmaster;
		$data['iddivisi'] = $iddivisi;

		$this->load->view("header_box",$data);
		$this->load->view("terjual");
		$this->load->view("footer");
	}

	public function addterjual(){
		$curr = shortcode_login();
		dump($_POST);
		$post = $_POST;
		$list_post = array("cc_tgl","cc_jml","cc_ket");
		if($post['cc_jml'] > $post['cc_terjual']){
			post_session($post, $list_post);
			create_alert("error","Jumlah yang dimasukkan melebihi stok yang ada di divisi. (Stok : $post[cc_terjual])","mutasi/terjual/$post[idmaster]/$post[iddivisi]");
		}
		else{
			if(empty($post['cc_jml']) or empty($post['cc_tgl'])){
				post_session($post, $list_post);
				create_alert("error","Mohon mengisi data di kolom yang sudah disediakan dengan tepat","mutasi/terjual/$post[idmaster]/$post[iddivisi]");

			}
			else{
				//input ke db
				$arr = array(
					"id" => null, 
					"id_master" => $post['idmaster'],
					"id_divisi" => $post['iddivisi'],
					"jml" => $post['cc_jml'],
					"tgl" => $post['cc_tgl'],
					"ket" => $post['cc_ket'],
					"stat" => 1
				);
				$this->db->insert("cc_terjual",$arr);
				create_alert("success","Berhasil menyimpan data pemakaian inventory","mutasi/terjual/$post[idmaster]/$post[iddivisi]");
			}
		}
	}





}