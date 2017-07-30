<?php
defined("BASEPATH") or exit();

Class Mdreport extends CI_Model{

	public function listdiv($ret="obj"){
		$sql = query("SELECT * FROM cc_divisi WHERE stat <> 9 ORDER BY nama_divisi");
		if($ret == "array"){
			$r = array();
			foreach($sql->result_array() as $row){
				$r[$row['id']] = $row['nama_divisi'];
			}
			return $r;
		}
		else{
			return $sql->result_array();
		}
	}

	public function list_cc(){
		$sql = query("SELECT * FROM cc_master WHERE stat <> 9");
		$arr = array();
		foreach($sql->result_array() as $row){
			$arr[$row['id']] = $row['nama'];
		}
		return $arr;
	}



	public function report_master($detail=0){
		$arr = array();
		$sql = query("SELECT * FROM cc_master WHERE stat <> 9 ORDER BY tag, nama");
		foreach($sql->result_array() as $row){
			$arr[$row['id']] = array();
		}

		$sql2 = query("SELECT * FROM cc_terima WHERE stat <> 9 ORDER BY tgl");
		$n = 0;
		foreach($sql2->result_array() as $row2){
			$tgl = strtotime($row2['tgl']) + $n;
			$arr[$row2['id_master']][$tgl]["terima"] = $row2['jml'];
			$arr[$row2['id_master']][$tgl]["ket"] = $row2['ket'];
			$n++;
		}

		$sql3 = query("SELECT * FROM cc_kirim WHERE stat <> 9 ORDER BY tgl");
		foreach($sql3->result_array() as $row3){
			$tgl = strtotime($row3['tgl'] + $n);
			$arr[$row3['id_master']][$tgl]["kirim"] = $row3['jml'];
			$arr[$row3['id_master']][$tgl]["ket"] = $row3['ket'];
			$n++;
		}

		return $arr;
	}






	public function report_divisi($detail=0, $filter=""){
		$arr = array();

		$addq = "";
		if(strlen($filter) > 0){
			$addq = " AND id = ".quote($filter);
		}
		$dv = query("SELECT * FROM cc_divisi WHERE stat <> 9 $addq");
		$n = 0;
		foreach($dv->result_array() as $row){

			$sql = query("SELECT * FROM cc_kirim WHERE id_divisi = ".quote($row['id'])." AND stat <> 9 ORDER BY tgl");
			foreach($sql->result_array() as $r){
				$tgll = strtotime($r['tgl']) + $n;
				$arr[$row['id']][$r['id_master']][$tgll] = array(
					"kirim" => $r['jml'],
					"ket" => $r['ket']
				);
				$n++;
			}

			$sql2 = query("SELECT * FROM cc_terjual WHERE id_divisi = ".quote($row['id'])." AND stat <> 9 ORDER BY tgl");
			foreach($sql2->result_array() as $r2){
				$tgll = strtotime($r2['tgl']) + $n;
				$arr[$row['id']][$r2['id_master']][$tgll] = array(
					"jual" => $r2['jml'],
					"ket" => $r2['ket']
				);
				$n++;
			}


		}


		return $arr;

	}

}