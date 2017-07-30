<?php
defined("BASEPATH") or exit();

Class Mdmaster extends CI_Model{

	public function load_cc($ord="nama"){
		$sql = query("SELECT * FROM cc_master WHERE stat <> 9 ORDER BY $ord ASC");
		return $sql;
	}

	public function load_divisi($ord="nama_divisi"){
		$sql = query("SELECT * FROM cc_divisi WHERE stat <> 9 ORDER BY $ord ASC");
		return $sql;
	}

	public function cek_exists($nm,$except=0){
		$add="";
		if($except <> 0){
			$add = "AND id <> ".$except;
		}

		$qry = "SELECT * FROM cc_master WHERE nama = ".quote($nm)." $add AND stat <> 9";
		$sql = query($qry);
		if($sql->num_rows() == 0){
			return true;
		}
		else{
			return false;
		}
	}

	public function cek_dv_exists($nm,$except=0){
		$add="";
		if($except <> 0){
			$add = "AND id <> ".$except;
		}

		$qry = "SELECT * FROM cc_divisi WHERE nama_divisi = ".quote($nm)." $add AND stat <> 9";
		$sql = query($qry);
		if($sql->num_rows() == 0){
			return true;
		}
		else{
			return false;
		}
	}


}