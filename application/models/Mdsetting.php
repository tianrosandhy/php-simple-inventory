<?php
defined("BASEPATH") or exit();

Class Mdsetting extends CI_Model{

	public function get_last_id($nm){
		$arr = array(
			"id" => null,
			"nama_project" => $nm,
			"tgl" => date("Y-m-d H:i:s"),
			"stat" => 1
			);
		$this->db->insert("cc_project",$arr);
		$id = $this->db->insert_id();


		return $id;
	}

	public function load_project(){
		$sql = query("SELECT * FROM cc_project WHERE stat <> 9 ");
		return $sql->result_array();
	}

	public function project_detail($id){
		$sql = query("SELECT * FROM cc_project WHERE id = ".quote(intval($id)));
		$row = $sql->row_array();
		return $row;
	}




	public function report_master($idproj, $detail=0){
		$arr = array();
		$sql = query("SELECT * FROM cc_master WHERE stat <> 9 ORDER BY tag, nama");
		foreach($sql->result_array() as $row){
			$arr[$row['id']] = array();
		}

		$sql2 = query("SELECT * FROM cc_temp WHERE tb = 'cc_terima' AND id_project = ".quote($idproj)." AND stat <> 9 ORDER BY tgl");
		$n = 0;
		foreach($sql2->result_array() as $row2){
			$tgl = strtotime($row2['tgl']) + $n;
			$arr[$row2['id_master']][$tgl]["terima"] = $row2['jml'];
			$arr[$row2['id_master']][$tgl]["ket"] = $row2['ket'];
			$n++;
		}

		$sql3 = query("SELECT * FROM cc_temp WHERE tb = 'cc_kirim' AND id_project = ".quote($idproj)." AND stat <> 9 ORDER BY tgl");
		foreach($sql3->result_array() as $row3){
			$tgl = strtotime($row3['tgl'] + $n);
			$arr[$row3['id_master']][$tgl]["kirim"] = $row3['jml'];
			$arr[$row3['id_master']][$tgl]["ket"] = $row3['ket'];
			$n++;
		}

		return $arr;
	}


	public function report_divisi($idproj, $detail=0, $filter=""){
		$arr = array();

		$addq = "";
		if(strlen($filter) > 0){
			$addq = " AND id = ".quote($filter);
		}
		$dv = query("SELECT * FROM cc_divisi WHERE stat <> 9 $addq");
		$n = 0;
		foreach($dv->result_array() as $row){

			$sql = query("SELECT * FROM cc_temp WHERE tb = 'cc_kirim' AND id_divisi = ".quote($row['id'])." AND stat <> 9 ORDER BY tgl");
			foreach($sql->result_array() as $r){
				$tgll = strtotime($r['tgl']) + $n;
				$arr[$row['id']][$r['id_master']][$tgll] = array(
					"kirim" => $r['jml'],
					"ket" => $r['ket']
				);
				$n++;
			}

			$sql2 = query("SELECT * FROM cc_temp WHERE tb = 'cc_terjual' AND id_divisi = ".quote($row['id'])." AND stat <> 9 ORDER BY tgl");
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