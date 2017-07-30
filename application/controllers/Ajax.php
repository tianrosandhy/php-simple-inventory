<?php
defined("BASEPATH") or exit();

Class Ajax extends CI_Controller{

	public function index(){

	}

	public function get($identifier, $id){
		$data = array();
		if($identifier=="master"){
			$sql = query("SELECT * FROM cc_master WHERE id = ".quote($id)." AND stat <> 9");
			if($sql->num_rows() == 0){
				//data ada
				$data['error'] = 0;
				$row = $sql->row_array();
				$data['id'] = $id;
				$data['nama'] = $row['nama'];
				$data['tag'] = $row['tag'];
				$data['tgl'] = $row['tgl'];
			}
			else{
				//data tidak ada
				$data['error'] = 1;
				$data['message'] = "Data tidak ditemukan. Mohon merefresh halaman untuk memperbaiki hal tersebut";
			}
		}
		echo json_encode($data);
	}

	public function master(){
		$curr = shortcode_login();
		$data = array();
		$this->load->model("mdmaster");

		if(isset($_POST['cc_nama']) and isset($_POST['cc_tag']) and isset($_POST['cc_tgl'])){
			if(empty($_POST['cc_nama'])){
				$data['error'] = 1;
				$data['message'] = "Kolom nama belum diisi";
			}
			else if(empty($_POST['cc_tgl'])){
				$data['error'] = 1;
				$data['message'] = "Kolom tanggal belum diisi";
			}
			else{
				//kelihatannya sudah oke
				$cek = $this->mdmaster->cek_exists($_POST['cc_nama']);
				if($cek){

					$data['nama'] = $_POST['cc_nama'];
					$data['tag'] = $_POST['cc_tag'];
					$data['tgl'] = indo_date($_POST['cc_tgl'],"half");
					$datedb = date("Y-m-d H:i:s",strtotime($_POST['cc_tgl']));

					$arr = array(
						"id" => null,
						"nama" => $data['nama'],
						"tag" => $data['tag'],
						"tgl" => $datedb,
						"stat" => 1
					);
					$this->db->insert("cc_master",$arr);
					$data['id'] = $this->db->insert_id();

					//langsung simpan di tabel terima
					$arr2 = array(
						"id" => null,
						"id_master" => $data['id'],
						"tgl" => $datedb,
						"jml" => 0,
						"ket" => "Data awal",
						"stat" => 1
					);
					$this->db->insert("cc_terima",$arr2);

					$data['error'] = 0;
					$data['message'] = "Berhasil menyimpan data master inventory";

				}
				else{
					$data['error'] = 1;
					$data['message'] = "Data master inventory tersebut sudah ada";					
				}


			}
		}
		else{
			$data['error'] = 1;
			$data['message'] = "Mohon masukkan data di field yang sudah disediakan";
		}

		echo json_encode($data);
	}

	public function edit_master($id){
		$curr = shortcode_login();
		$data = array();
		$this->load->model("mdmaster");

		if(isset($_POST['cc_nama']) and isset($_POST['cc_tag']) and isset($_POST['cc_tgl'])){
			if(empty($_POST['cc_nama'])){
				$data['error'] = 1;
				$data['message'] = "Kolom nama belum diisi";
			}
			else if(empty($_POST['cc_tgl'])){
				$data['error'] = 1;
				$data['message'] = "Kolom tanggal belum diisi";
			}
			else{
				//kelihatannya sudah oke
				$cek = $this->mdmaster->cek_exists($_POST['cc_nama'], $id);
				if($cek){
					$data['nama'] = $_POST['cc_nama'];
					$data['tag'] = $_POST['cc_tag'];
					$data['tgl'] = indo_date($_POST['cc_tgl'],"half");
					$datedb = date("Y-m-d H:i:s",strtotime($_POST['cc_tgl']));

					$arr = array(
						"nama" => $data['nama'],
						"tag" => $data['tag'],
						"tgl" => $datedb,
					);
					$this->db->where("id",$id);
					$this->db->update("cc_master",$arr);

					$data['error'] = 0;
					$data['message'] = "Berhasil mengupdate data master inventory";

				}
				else{
					$data['error'] = 1;
					$data['message'] = "Data master inventory tersebut sudah ada";					
				}
			}
		}
		else{
			$data['error'] = 1;
			$data['message'] = "Mohon masukkan data di field yang sudah disediakan";
		}

		echo json_encode($data);
	}















	public function divisi(){
		$curr = shortcode_login();
		$data = array();
		$this->load->model("mdmaster");

		if(isset($_POST['cc_nama'])){
			if(empty($_POST['cc_nama'])){
				$data['error'] = 1;
				$data['message'] = "Kolom nama belum diisi";
			}
			else{
				//kelihatannya sudah oke
				$cek = $this->mdmaster->cek_dv_exists($_POST['cc_nama'], 0, "cc_divisi");
				if($cek){

					$data['nama'] = $_POST['cc_nama'];

					$arr = array(
						"id" => null,
						"nama_divisi" => $data['nama'],
						"stat" => 1
					);
					$this->db->insert("cc_divisi",$arr);
					$data['id'] = $this->db->insert_id();

					$data['error'] = 0;
					$data['message'] = "Berhasil menyimpan data master divisi";

				}
				else{
					$data['error'] = 1;
					$data['message'] = "Data master divisi tersebut sudah ada";					
				}


			}
		}
		else{
			$data['error'] = 1;
			$data['message'] = "Mohon masukkan data di field yang sudah disediakan";
		}

		echo json_encode($data);
	}

	public function edit_divisi($id){
		$curr = shortcode_login();
		$data = array();
		$this->load->model("mdmaster");

		if(isset($_POST['cc_nama'])){
			if(empty($_POST['cc_nama'])){
				$data['error'] = 1;
				$data['message'] = "Kolom nama belum diisi";
			}
			else{
				//kelihatannya sudah oke
				$cek = $this->mdmaster->cek_dv_exists($_POST['cc_nama'], $id, "cc_divisi");
				if($cek){

					$data['nama'] = $_POST['cc_nama'];

					$arr = array(
						"nama_divisi" => $data['nama'],
					);
					$this->db->where("id",$id);
					$this->db->update("cc_divisi",$arr);

					$data['error'] = 0;
					$data['message'] = "Berhasil menyimpan data master divisi";

				}
				else{
					$data['error'] = 1;
					$data['message'] = "Data master divisi tersebut sudah ada";					
				}


			}
		}
		else{
			$data['error'] = 1;
			$data['message'] = "Mohon masukkan data di field yang sudah disediakan";
		}

		echo json_encode($data);
	}
}