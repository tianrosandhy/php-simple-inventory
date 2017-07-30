<?php
defined("BASEPATH") or exit();

Class MdPage extends CI_Model{
	var $tb_structure;
	var $tb_content;

	public function __construct(){
		parent::__construct();

		//default_category list
		$def_cat = query("SELECT * FROM cms_category WHERE stat = 1");
		foreach($def_cat->result_array() as $dc){
			$dfc[$dc['id']] = $dc['name'];
		}

		$this->tb_content = array();
		$this->tb_structure = array(
			array(
				"field" => "#",
				"show" => 0,
				"type" => "text",
				"attr" => ""
			),
			array(
				"field" => "image",
				"show" => 1,
				"type" => "file",
				"attr" => ""
			),
			array(
				"field" => "title",
				"show" => 1,
				"type" => "text",
				"attr" => "",
				"class" => "slug-toggle"
			),
			array(
				"field" => "slug",
				"show" => 1,
				"type" => "text",
				"attr" => "hide",
				"class" => "slug-target"
			),

			array(
				"field" => "category",
				"show" => 1,
				"type" => "select_multiple",
				"attr" => "",
				"value" => $dfc
			),
			array(
				"field" => "description",
				"show" => 1,
				"type" => "textarea",
				"attr" => ""
			),
			array(
				"field" => "content",
				"show" => 1,
				"type" => "editor",
				"attr" => "hide"
			),
			array(
				"field" => "status",
				"show" => 0,
				"type" => "editor",
				"attr" => ""
			),
			array(
				"field" => "",
				"show" => 0
			)

		);
	}






	public function show_query($current_page=1, $addQuery="", $limit=0, $order_by="id", $ord="DESC"){

		//manage default value
		if($limit == 0)
			$limit = get_setting("backend_paging");

		$offset = ($current_page - 1) * $limit;

		$sql = "SELECT * FROM cms_page WHERE stat <= 1 $addQuery ORDER BY $order_by $ord LIMIT $offset,$limit";

		$run = query($sql);
		if($run->num_rows() > 0){
			$kat = $this->get_list_category();
			$return = array();
			$no = 0;
			foreach($run->result_array() as $row){
				//category diexplode dulu
				$exp = explode(",",$row['category']);
				$inc = "";
				foreach($exp as $ex){
					if(strlen($ex) > 0)
					$inc .= "<span class='label label-default'>".$kat[$ex]."</span> ";
				}

				if($row['stat'] == 0){
					$hd = "
						<a href='backend/page/show/$row[id]/page' class='show-button btn btn-sm btn-success'><span class='fa fa-eye'></span> Show</a> ";
				}
				else{
					$hd = "
						<a href='backend/page/hide/$row[id]/page' class='hide-button btn btn-sm btn-warning'><span class='fa fa-eye-slash'></span> Hide</a> ";
				}

				$img_loc = "upload/page/small/$row[image]";
				if(!is_file($img_loc)){
					$img_loc = "upload/default.jpg";
				}

				if($row['stat'] == 1){
					$stt = "Active";
				}
				else
					$stt = "Hidden";

				$return[$no] = array(
					"#" 
						=> $no+1,
					"image" 
						=> "<img src='$img_loc' height=40>",
					"title" 
						=> $row['title'],
					"category" 
						=> $inc,
					"description" 
						=> cut_text($row['description']),
					"stat" => $stt,
					"action" 
						=> "

						<a href='backend/page/edit/$row[id]/page' class='btn btn-sm btn-info'><span class='fa fa-pencil'></span> Update</a> 
						$hd
						<a href='backend/page/delete/$row[id]/page' class='delete-button btn btn-sm btn-danger'><span class='fa fa-trash'></span> Delete</a> "
				);
				$no++;
			}

			$this->tb_content = $return;
		}

	}









	public function get_list_category(){
		$sql = "SELECT id,name FROM cms_category WHERE stat = 1";
		$run = query($sql);
		$return = array();
		foreach($run->result_array() as $row){
			$return[$row['id']] = $row['name'];
		}
		return $return;
	}

	public function cek_exists($title, $slug, $except=null){
		$addQ = "";
		if(strlen($except)>0)
			$addQ = "AND id <> ".intval($except);

		$sql = query("SELECT id FROM cms_page WHERE (title = ".quote($title)." OR slug = ".quote($slug).") $addQ AND stat <> 9");
		if($sql->num_rows() > 0)
			return false;
		return true;
	}









	public function post_process($post, $files, $type="add", $id=null){
		$tgl = date("Y-m-d H:i:s");
		$imp = implode(",",$post['category']);
		$desc = htmlentities($post['description']);
		$content = htmlentities($post['content']);
		$show = 0;
		if(isset($post['show']))
			$show = 1;
		$filename = "";

		if($files['error'] == 0){
			if($files['size'] < 3000000){
				//kalau ada gambar lama, hapus dulu
				if($id > 0){
					$pg = $this->get_page($id);
					$filename = $pg['image'];
					$this->cms->rollback_upload($filename,"upload/page/");
				}

				$filename = $this->cms->upload($files['name'], $files['tmp_name'], "upload/page/");
			}
			else{
				echo "Hmm";
			}
		}

		$data = array(
			"id" => null,
			"title" => $post['title'],
			"slug" => $post['slug'],
			"tgl_post" => $tgl,
			"category" => $imp,
			"description" => $desc,
			"content" => $content,
			"image" => $filename,
			"stat" => $show
		);

		if($type=="add")
			$this->db->insert("cms_page",$data);
		else if($type=="edit"){
			unset($data['id']);
			if(strlen($filename) == 0)
				unset($data['image']);
			$this->db->update("cms_page",$data, array("id"=>$id));
		}

		return true;
	}



}