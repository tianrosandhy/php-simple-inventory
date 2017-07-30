<?php
defined("BASEPATH") or exit();

Class Structure extends CI_Model{

	public function structure_karyawan(){
		$listdiv = $this->mdmaster->get_list("cms_divisi","nama_divisi");
		$listjob = $this->mdmaster->get_list("cms_jabatan","nama_jabatan");


		$arr = array(
			array(
				"show" => 1,
				"label" => "Kode Karyawan",
				"name" => "kode_karyawan",
				"type" => "text",
				"default" => "",
				"class" => "form-control",
				"attr" => " required ",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Nama Lengkap",
				"name" => "nama",
				"type" => "text",
				"default" => "",
				"class" => "form-control",
				"attr" => " required ",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Tempat Tgl Lahir",
				"name" => "ttl",
				"type" => "text",
				"default" => "",
				"class" => "form-control",
				"attr" => "",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Jenis Kelamin",
				"name" => "jk",
				"type" => "radio",
				"default" => "",
				"class" => "form-control",
				"attr" => "",
				"list" => array(
					1 => "Laki-laki",
					2 => "Perempuan"
					)
			),
			array(
				"show" => 1,
				"label" => "Alamat",
				"name" => "alamat",
				"type" => "textarea",
				"default" => "",
				"class" => "form-control",
				"attr" => "",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Telepon",
				"name" => "telp",
				"type" => "tel",
				"default" => "",
				"class" => "form-control",
				"attr" => "",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Pas Foto",
				"name" => "foto",
				"type" => "file",
				"default" => "",
				"class" => "form-control",
				"attr" => " accept='image/*' ",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Divisi Penempatan",
				"name" => "divisi",
				"type" => "select",
				"default" => "",
				"class" => "form-control",
				"attr" => "",
				"list" => $listdiv
			),
			array(
				"show" => 1,
				"label" => "Jabatan Penempatan",
				"name" => "jabatan",
				"type" => "select",
				"default" => "",
				"class" => "form-control",
				"attr" => "",
				"list" => $listjob
			),
			array(
				"show" => 1,
				"label" => "Tanggal Masuk",
				"name" => "tgl_masuk",
				"type" => "date",
				"default" => date("Y-m-d"),
				"class" => "form-control",
				"attr" => "",
				"list" => array()
			)

		);
		return $arr;
	}











	public function structure_divisi(){
		$arr = array(
			array(
				"show" => 1,
				"label" => "Nama Divisi",
				"name" => "nama_divisi",
				"type" => "text",
				"default" => "",
				"class" => "form-control",
				"attr" => " required ",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Kapasitas",
				"name" => "capacity",
				"type" => "number",
				"default" => "2",
				"class" => "form-control",
				"attr" => "",
				"list" => array()
			)

		);
		return $arr;
	}










	public function structure_jabatan(){
		$arr = array(
			array(
				"show" => 1,
				"label" => "Nama Jabatan",
				"name" => "nama_jabatan",
				"type" => "text",
				"default" => "",
				"class" => "form-control",
				"attr" => " required ",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Tunjangan",
				"name" => "tunjangan",
				"type" => "number",
				"default" => "0",
				"class" => "form-control",
				"attr" => "",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Job Deskripsi",
				"name" => "deskripsi",
				"type" => "textarea",
				"default" => "",
				"class" => "form-control",
				"attr" => "",
				"list" => array()
			)

		);
		return $arr;
	}










	public function structure_shift(){
		$arr = array(
			array(
				"show" => 1,
				"label" => "Nama Shift",
				"name" => "nama_shift",
				"type" => "text",
				"default" => "",
				"class" => "form-control",
				"attr" => " required maxlength=4 style='width:70px;'",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Jam Masuk",
				"name" => "jam_masuk",
				"type" => "text",
				"default" => "",
				"class" => "form-control timepicker",
				"attr" => "",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Jam Pulang",
				"name" => "jam_pulang",
				"type" => "text",
				"default" => "",
				"class" => "form-control timepicker",
				"attr" => "",
				"list" => array()
			)
		);
		return $arr;
	}

	public function structure_hr(){
		$arr = array(
			array(
				"show" => 1,
				"label" => "Nama Hari Raya",
				"name" => "nama",
				"type" => "text",
				"default" => "",
				"class" => "form-control",
				"attr" => " required ",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Keterangan",
				"name" => "keterangan",
				"type" => "textarea",
				"default" => "",
				"class" => "form-control",
				"attr" => "",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Tanggal",
				"name" => "tgl",
				"type" => "date",
				"default" => date("Y-m-d"),
				"class" => "form-control",
				"attr" => "",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Perulangan",
				"name" => "repeatance",
				"type" => "select",
				"default" => "",
				"class" => "form-control",
				"attr" => "",
				"list" => array("One Time Event","Every Year")
			)
		);
		return $arr;
	}


	public function structure_kode(){
		$arr = array(
			array(
				"show" => 1,
				"label" => "Kode",
				"name" => "flag",
				"type" => "text",
				"default" => "",
				"class" => "form-control",
				"attr" => " required maxlength='5'",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Keterangan",
				"name" => "flag_description",
				"type" => "text",
				"default" => "",
				"class" => "form-control",
				"attr" => "",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Absen",
				"name" => "nilai",
				"type" => "select",
				"default" => "",
				"class" => "form-control",
				"attr" => "",
				"list" => array("FALSE - Hitung Alpa", "TRUE - Hitung Hadir")
			),
			array(
				"show" => 1,
				"label" => "Background",
				"name" => "bg",
				"type" => "color",
				"default" => "",
				"class" => "form-control",
				"attr" => "",
				"list" => array()
			)
		);
		return $arr;
	}





















	public function structure_lembur($def=array()){
		$arr = array(
			array(
				"show" => 1,
				"label" => "Nama Karyawan",
				"name" => "name",
				"type" => "text",
				"default" => $def['nama'],
				"class" => "form-control",
				"attr" => " readonly ",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Divisi",
				"name" => "divisi",
				"type" => "text",
				"default" => $def['nama_divisi'],
				"class" => "form-control",
				"attr" => " readonly ",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Tanggal",
				"name" => "tgl",
				"type" => "date",
				"default" => $def['tgl'],
				"class" => "form-control",
				"attr" => " readonly ",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Jam Pulang",
				"name" => "jam_pulang",
				"type" => "text",
				"default" => date("H:i",strtotime($def['jam_pulang'])),
				"class" => "form-control timepicker",
				"attr" => " readonly ",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Absen Pulang",
				"name" => "real_pulang",
				"type" => "text",
				"default" => date("H:i",strtotime($def['real_pulang'])),
				"class" => "form-control timepicker",
				"attr" => " readonly ",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Lama Lembur (jam)",
				"name" => "durasi",
				"type" => "number",
				"default" => intval(floor($def['selisih'] / 10000)),
				"class" => "form-control",
				"attr" => "",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Type",
				"name" => "type",
				"type" => "select",
				"default" => "",
				"class" => "form-control",
				"attr" => "",
				"list" => array(
					0=>"Lembur Tak Berbayar",
					1=>"Lembur Berbayar"
				)
			),

		);
		return $arr;
	}











	public function structure_setting(){
		$arr = array(
			array(
				"show" => 1,
				"label" => "Username",
				"name" => "username",
				"type" => "text",
				"default" => "",
				"class" => "form-control",
				"attr" => " required ",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Nama",
				"name" => "name",
				"type" => "text",
				"default" => "",
				"class" => "form-control",
				"attr" => " required ",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Password",
				"name" => "pswd1",
				"type" => "password",
				"default" => "",
				"class" => "form-control",
				"attr" => "",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Ulangi Password",
				"name" => "pswd2",
				"type" => "password",
				"default" => "",
				"class" => "form-control",
				"attr" => "",
				"list" => array()
			),
			
			array(
				"show" => 1,
				"label" => "Email",
				"name" => "email",
				"type" => "email",
				"default" => "",
				"class" => "form-control",
				"attr" => "",
				"list" => array()
			),
			array(
				"show" => 1,
				"label" => "Level",
				"name" => "priviledge",
				"type" => "select",
				"default" => "",
				"class" => "form-control",
				"attr" => " required ",
				"list" => $this->mdsetting->list_level()
			)
			

		);
		return $arr;
	}

}