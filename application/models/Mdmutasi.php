<?php
defined("BASEPATH") or exit();

Class Mdmutasi extends CI_Model{

	public function load_cc($ord = "tag, nama"){
		$sql = query("SELECT * FROM cc_master WHERE stat <> 9 ORDER BY $ord");
		return $sql->result_array();
	}

	public function get_current_mutasi($list, $iddiv=0){
		$save = array();
		foreach($list as $r){
			array_push($save, $r['id']);
		}
		$imp = "";
		if(count($save) > 0){
			$imp = "WHERE id_master IN (".implode(",",$save).")";
			if($iddiv > 0){
				$imp .= " AND id_divisi = ".quote($iddiv);
			}
		}

		$arr = array();
		if($iddiv == 0){
			$sql = query("SELECT id_master, SUM(jml) AS jml_terima FROM cc_terima $imp GROUP BY id_master");
			foreach($sql->result_array() as $row){
				$arr[$row['id_master']] = $row['jml_terima'];
			}			
		}



		$sql2 = query("SELECT id_master, id_divisi, SUM(jml) AS jml_kirim FROM cc_kirim $imp GROUP BY id_master");
		foreach($sql2->result_array() as $row){
			if($iddiv == 0){
				if(isset($arr[$row['id_master']])){
					$arr[$row['id_master']] -= $row['jml_kirim'];
				}
			}
			else{
				$arr[$row['id_master']] = $row['jml_kirim'];
			}

		}

		if($iddiv <> 0){
			//tweak
			$tj = query("SELECT id_master, id_divisi, SUM(jml) AS jml_terjual FROM cc_terjual $imp GROUP BY id_master");
			foreach($tj->result_array() as $r3){
				$n = $r3['jml_terjual'];
				if(isset($arr[$r3['id_master']]))
					$arr[$r3['id_master']] -= $n;
				else
					$arr[$r3['id_master']] = 0 - $n;
			}

		}

		return $arr;
	}

	public function real_stok($idmaster, $tgl=null){
		if(empty($tgl))
			$tgl = date("Y-m-d");

		$dapat = query("SELECT SUM(jml) AS total_terima FROM cc_terima WHERE tgl <= ".quote($tgl)." AND id_master = ".quote($idmaster));
		$row = $dapat->row_array();
		$a = $row['total_terima'];

		$kirim = query("SELECT SUM(jml) AS total_kirim FROM cc_kirim WHERE tgl <= ".quote($tgl)." AND id_master = ".quote($idmaster));
		$row2 = $kirim->row_array();
		$b = $row2['total_kirim'];

		$real_stok = $a - $b;
		return $real_stok;
	}

	public function real_stok_div($idmaster, $iddiv, $tgl=null){
		if(empty($tgl))
			$tgl = date("Y-m-d");
		$sql = query("SELECT SUM(jml) AS total_kirim FROM cc_kirim WHERE id_master = ".quote($idmaster)." AND id_divisi = ".quote($iddiv)." AND tgl <= ".quote($tgl));
		$row = $sql->row_array();
		$a = $row['total_kirim'];

		$sql2 = query("SELECT SUM(jml) AS total_penyesuaian FROM cc_terjual WHERE id_master = ".quote($idmaster)." AND id_divisi = ".quote($iddiv)." AND tgl <= ".quote($tgl));
		$row2 = $sql2->row_array();
		$b = $row2['total_penyesuaian'];

		$real_stok = $a - $b;
		return $real_stok;
	}



	public function item_mutasi($id){
		$save = array();
		$sql = query("SELECT * FROM cc_terima WHERE id_master = ".quote($id)." AND stat <> 9");
		$n = 0;
		foreach($sql->result_array() as $row){
			$tgl = strtotime($row['tgl']) + $n; //tweak untuk menampilkan data dengan tanggal yg sama. limit = 86399 data.
			$save[$tgl]['terima'] = $row['jml'];
			$save[$tgl]['ket'] = $row['ket'];
			$n++;
		}

		$sql2 = query("SELECT * FROM cc_kirim WHERE id_master = ".quote($id)." AND stat <> 9");
		foreach($sql2->result_array() as $row){
			$tgl = strtotime($row['tgl']) + $n; 

			$save[$tgl]['kirim'] = $row['jml'];
			$save[$tgl]['ket'] = $row['ket'];
			$n++;
		}

		ksort($save);
		return $save;
	}

	public function item_mutasi_divisi($idmaster, $iddivisi){
		$save = array();
		$sql2 = query("SELECT * FROM cc_kirim WHERE id_master = ".quote($idmaster)." AND id_divisi = ".quote($iddivisi)." AND stat <> 9");
		$n = 0;
		foreach($sql2->result_array() as $row){
			$tgl = strtotime($row['tgl']) + $n; 

			$save[$tgl]['kirim'] = $row['jml'];
			$save[$tgl]['ket'] = $row['ket'];
			$n++;
		}

		$sql3 = query("SELECT * FROM cc_terjual WHERE id_master = ".quote($idmaster)." AND id_divisi = ".quote($iddivisi)." AND stat <> 9");
		foreach($sql3->result_array() as $row2){
			$tgl = strtotime($row2['tgl']) + $n;
			$save[$tgl]['terjual'] = $row2['jml'];
			$save[$tgl]['ket'] = $row2['ket'];
			$n++;
		}

		ksort($save);
		return $save;
	}

	public function list_divisi(){
		$sql = query("SELECT * FROM cc_divisi WHERE stat <> 9 ORDER BY nama_divisi");
		$arr = array();
		foreach($sql->result_array() as $row){
			$arr[$row['id']] = $row['nama_divisi'];
		}
		return $arr;
	}


	public function cek_stok_cc($idmaster, $tgl){

	}



}