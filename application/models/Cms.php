<?php
defined("BASEPATH") or exit();

Class Cms extends CI_Model{
	
	public function cek_login(){
		//logic : cari di cms_admin_log yang sessionnya sama
		if(isset($_SESSION['current_token'])){
			$cek = query("
				SELECT username, name, email, priviledge FROM cms_admin WHERE username IN
				(
					SELECT username FROM cms_admin_log WHERE token = ".quote($_SESSION['current_token'])." AND expired > ".quote(date("Y-m-d H:i:s"))."
				)
				");
			if($cek->num_rows() > 0){
				$row = $cek->row_array();
				$return = array(
					"username" => $row['username'],
					"name" => $row['name'],
					"email" => $row['email'],
					"priviledge" => $row['priviledge']
				);
				return $return;
			}
		}

		return false;
	}

	public function create_alert($type, $pesan, $header=""){
		$_SESSION['adm-type'] = $type;
		$_SESSION['adm-message'] = $pesan;

		if(strlen($header) > 0){
			redirect($header);
			exit();
		}
	}

	public function show_alert(){
		if(isset($_SESSION['adm-type'])){
			$type = ucfirst($_SESSION['adm-type']);
			unset($_SESSION['adm-type']);
			$message = $_SESSION['adm-message'];
			unset($_SESSION['adm-message']);

			return "
			alertify.alert(\"<strong>$type</strong>\", \"$message\");
			";
		}
	}

	public function random_hash(){
		$a = rand(1,100000);
		$b = rand(100000,999999);
		$timestamp = sha1(date("YmdHis"));
		$first = sha1($a) . sha1($b);
		return sha1($first.$timestamp);
	}

	public function output_input($name, $type, $class="", $value=null, $def=null){
		$ret = "";
		if(isset($_SESSION["form-".$name])){
			$def = $_SESSION["form-".$name];
			unset($_SESSION["form-".$name]);
		}

		if($type == "select"){
			$ret .= "<select name='$name' class='chosen $class' id='form-$name'>";
			if(!is_array($def))
				$def = array();
			foreach($value as $key=>$val){
				$sel = "";
				if(in_array($key, $def)){
					$sel = "selected";
				}
				$ret .= "<option $sel value='$key'>$val</option>
				";
			}

			$ret .= "</select>";
		}
		else if($type == "select_multiple"){
			$ret .= "<select name='".$name."[]' class='chosen $class' id='form-$name' multiple='multiple'>";
			if(!is_array($def))
				$def = array();
			foreach($value as $key=>$val){
				$sel = "";
				if(in_array($key, $def)){
					$sel = "selected";
				}
				$ret .= "<option $sel value='$key'>$val</option>
				";
			}

			$ret .= "</select>";
		}

		else if($type == "textarea"){
			$ret .= "<textarea name='$name' id='form-$name' class='form-control $class'>$def</textarea>";
		}
		else if($type == "editor"){
			$ret .= "<textarea name='$name' class='ckeditor $class' id='form-$name'>$def</textarea>";
		}
		else if($type == "file"){
			$ret .= "<input type='$type' name='$name' class='form-control $class' id='form-$name' value='$def' accept='image/*'>";
		}
		else{
			$ret .= "<input type='$type' name='$name' class='form-control $class' id='form-$name' value='$def'>";
		}

		return $ret;
	}
	










	public function get_extension($fnm){
		$exp = explode(".",$fnm);
		$n = count($exp) - 1;
		$ext = $exp[$n];
		return $ext;
	}

	public function upload($filename, $tmp, $dir="upload/"){
		$this->load->helper("resize_helper");

		$hash = substr(sha1(rand(1,10000)),8,8);
		$nmfile = $hash.".".$this->get_extension($filename);
		$loc = $dir.$nmfile;
		$loc_sm = $dir."small/".$nmfile;
		$loc_md = $dir."medium/".$nmfile;

		if (is_dir($dir) && is_writable($dir)) {
			move_uploaded_file($tmp, $loc);	
		} else {
		    $this->cms->create_alert("Upload Error","Upload directory is not writeable or doesn't exist.");
		}	

		$img = new abeautifulsite\SimpleImage($loc);
		$img->fit_to_height(500)
			->save($loc_md);
		$img->fit_to_height(150)
			->save($loc_sm);

		return $nmfile;
	}

	public function rollback_upload($filename, $dir="upload/"){
		if(is_file($dir.$filename)){
			echo "unlink : ".$dir.$filename;
			unlink($dir.$filename);
		}
		if(is_file($dir."medium/".$filename)){
			unlink($dir."medium/".$filename);
			echo "unlink : ".$dir."medium/".$filename;
		}
		if(is_file($dir."small/".$filename)){
			unlink($dir."small/".$filename);
			echo "unlink : ".$dir."small/".$filename;
		}
		return true;
	}












	public function get_page($tb, $id){
		$sql = $this->db->query("SELECT * FROM $tb WHERE id = ".intval($id));
		if($sql->num_rows() > 0)
			return $sql->row_array();
		return false;
	}

	public function toggle_post($tbname, $id, $toggle){
		if($toggle < 0 or $toggle > 9)
			return false;

		$this->db->update(
			$tbname,
			array(
				"stat" => intval($toggle)
			),
			array(
				"id" => intval($id)
			)
		);
		return true;
	}


	public function cek_exists($tb, $id, $pk="id"){
		$sql = query("SELECT * FROM $tb WHERE $pk = ".quote($id));
		if($sql->num_rows() == 1)
			return $sql->row_array();
		else
			return false;
	}

}